<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 */

App::uses('AppController', 'Controller');

//  Override this controller by placing a copy in controllers directory of an application

class AdminController extends AppController {

// This controller does not use a model

	public $uses = array(
		'Photos',
		'Settings',
		'Sliders',
		'Galleries',
		'Folders',
		'Slider_photos',
		'Folder_photos',
		'User'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'cms';
		$this->Auth->allow('index');					// funkcja index jest dostępna dla niezalogowanych
		//pobieram obecną stronę
		$action=$this->action;
		//tworze zmienną która przechowuje id nowej galerii

		//pobieramy liczbę i nazwy galerii
		$galleries=$this->get_galleries();
		$this->set('galleries',$galleries);

			//zapisujemy nową galerie
			if(isset($_POST['popup'])){
				if(trim($_POST['name'])==null){
					$this->Session->setFlash('Podaj nazwę galerii');
					$this->redirect(array('action'=>$action));
				}else{
				$gallery=array(
					'id'	=>	0,
					'name'=>	$_POST['name']
				);
			$this->Galleries->save($gallery);
			$new_id=$this->Galleries->id;
			$new_gallery='gallery_edit?id='.$new_id;
			$this->Session->setFlash('Utworzono Galerie');
			$this->redirect(array('action'=>$new_gallery));
			}
		}
	}

	public function index(){
		$this->layout='login';
		if($this->request->is('post')){
			if($this->Auth->login()){					// przeprowadza autentykacje
				$check_user=$this->Auth->user();
				$this->redirect(array(				// po pomyślnym zalogawniu przenosi na admin/dashboard
					'controller'=>'admin',
					'action'=>'dashboard'
				));
			}else{
				$this->Session->setFlash('Nieprawidłowy login','bad');		// wypisuje wiadomość z elementem bad.ctp
			}
		}
		// DODAWNIE NOWEGO USERA //
		/*if($this->request->is('post')){
			$data = $this->data;
			$User=array(
				'id' => '0',
				'email' => $data['User']['email'],
				'password' => $data['User']['password'],
			);
			$this->User->save($User);
			$this->Session->setFlash('Dodano użytkownika');
			$this->redirect(array('action'=>'index'));
			die();
		}*/
}

	public function dashboard(){
		if (isset($_POST['menu'])) {
			$data=$this->data;
			$settings=$data['settings'];
			foreach ($settings as $k => $v) {
				if($v!=null){
					$setting=array(
						'id' => $k+7,
						'name' => 'menu option '.$k,
						'value' => $v
					);
				$this->Settings->save($setting);
				}
			}
			$this->Session->setFlash('Dane zapisano');
		}
		$tmp['Slider_id']=$this->Sliders->find(
			'all',
			array(
				'conditions'=>array(
					'Sliders.name'=>'index'
				),
				array(
					'Sliders.id'
				)));
		$tmp['Slider_count']=count($tmp['Slider_id']);



		for ($j=1; $j<=$tmp['Slider_count'] ; $j++) {
			$tmp['Slider_id'][$j-1]=$tmp['Slider_id'][$j-1]['Sliders']['id'];

			$tmp['Photo_id']=$this->Slider_photos->find(
				//wszystkie...
				'all',
				//dla których...
				array(
					//warunki [WHERE]
					'conditions'=>array(
						'Slider_photos.slider_id'=>$tmp['Slider_id'][$j-1],
						'Slider_photos.active'=>1
					),
					//wybiera pola:
					'fields'=>array(
						'Slider_photos.id',
						'Slider_photos.photo_id'
					)));
					$element['Slider'][$j-1]['number']=$slides_number=count($tmp['Photo_id']);

			for ($i=1; $i <=$slides_number ; $i++) {
				$element['Photo'][$j-1][$i]['1']=$this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
				$element['Photo'][$j-1][$i]['2']=$tmp['Photo_id'][$i-1]['Slider_photos']['photo_id'];
				$element['Photo'][$j-1][$i]['3']=$tmp['Photo_id'][$i-1]['Slider_photos']['id'];

			}
		}
			//END SLIDER1! ---------------------------------------------------------------------------------------

//START UPLOAD_PHOTOS ------------------------------------------------------------------------
		if((isset($_POST['photo'])) || (isset($_POST['delete']))){

			$data=$this->data;
			if(isset($_POST['delete'])){
				$data['Photo']=array(
					'id'=>$data['Slider_photos.id'],
					'slider_id'=>$data['Slider_id'],
					'active'=>0
				);
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('usunięto slajd');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'dashboard'));
			}else{
				$photo=$_FILES['Photo'];
				//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
				$ret=$this->upload_photo($photo);
				if($ret['0']==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia');
					//i wysyła nas do dashboard...
					$this->redirect(array('action'=>'dashboard'));
				}else{
					$data['Slider_photos']['photo_id']=$ret;
				}
				//zapisujemy naszego photosa do tablicy slider_photos.
				if($data['id']>0){
					$data['Photo']=array(
						'id'=>$data['Slider_photos.id'],
						'photo_id'=>$ret[0],
						'slider_id'=>$data['Slider_id']
					);
				}else{
					$data['Photo']=array(
						'id'=>0,
						'photo_id'=>$ret[0],
						'slider_id'=>$data['Slider_id']
					);
				}
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('Dane zapisane');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'dashboard'));
			}
		}
//END UPLOAD_PHOTOS ------------------------------------------------------------------------
		$element['Settings']=$this->get_settings();
		//$this->dupcia($element['Settings']);
		$this->set('element',$element);
	}
	public function logout()
	{
		$this->layout=null;
		$this->request=null;
		$this->redirect($this->Auth->logout());
	}
	public function about(){
		$element=$tmp=array();

		//START SLIDER1!  ---------------------------------------------------------------
			$tmp['Slider_id']=$this->Sliders->find(
				'all',
				array(
					'conditions'=>array(
						'Sliders.name'=>'about'
					),
					array(
						'Sliders.id'
					)));
			$tmp['Slider_count']=count($tmp['Slider_id']);



			for ($j=1; $j<=$tmp['Slider_count'] ; $j++) {
				$tmp['Slider_id'][$j-1]=$tmp['Slider_id'][$j-1]['Sliders']['id'];

				$tmp['Photo_id']=$this->Slider_photos->find(
					//wszystkie...
					'all',
					//dla których...
					array(
						//warunki [WHERE]
						'conditions'=>array(
							'Slider_photos.slider_id'=>$tmp['Slider_id'][$j-1],
							'Slider_photos.active'=>1
						),
						//wybiera pola:
						'fields'=>array(
							'Slider_photos.id',
							'Slider_photos.photo_id'
						)));
						$element['Slider'][$j-1]['number']=$slides_number=count($tmp['Photo_id']);

				for ($i=1; $i <=$slides_number ; $i++) {
					$element['Photo'][$j-1][$i]['1']=$this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
					$element['Photo'][$j-1][$i]['2']=$tmp['Photo_id'][$i-1]['Slider_photos']['photo_id'];
					$element['Photo'][$j-1][$i]['3']=$tmp['Photo_id'][$i-1]['Slider_photos']['id'];

				}
			}
				//END SLIDER1! ---------------------------------------------------------------------------------------

 	//START UPLOAD_PHOTOS ------------------------------------------------------------------------
		if((isset($_POST['photo'])) || (isset($_POST['delete']))){

			$data=$this->data;
			if(isset($_POST['delete'])){
				$data['Photo']=array(
					'id'=>$data['Slider_photos.id'],
					'slider_id'=>$data['Slider_id'],
					'active'=>0
				);
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('usunięto slajd');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'about'));
			}else{
				$photo=$_FILES['Photo'];
				//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
				$ret=$this->upload_photo($photo);
				if($ret['0']==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia');
					//i wysyła nas do about...
					$this->redirect(array('action'=>'about'));
				}else{
					$data['Slider_photos']['photo_id']=$ret;
				}
				//zapisujemy naszego photosa do tablicy slider_photos.
				if($data['id']>0){
					$data['Photo']=array(
						'id'=>$data['Slider_photos.id'],
						'photo_id'=>$ret[0],
						'slider_id'=>$data['Slider_id']
					);
				}else{
					$data['Photo']=array(
						'id'=>0,
						'photo_id'=>$ret[0],
						'slider_id'=>$data['Slider_id']
					);
				}
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('Dane zapisane');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'about'));
			}
		}
	//END UPLOAD_PHOTOS ------------------------------------------------------------------------

	//START UPLOAD_TEXT
		if(isset($_POST['text'])){
			$this->upload_text('about');
		}
	//END UPLOAD_TEXT
		$element['Settings']=$this->get_settings();
		$this->set('element',$element);
	}
	public function gallery_edit(){
		if(isset($_POST['Folder'])){
			if(trim($_POST['name']==null)){
				$this->Session->setFlash('Podaj nazwę folderu');
			}else{
				$thumbnail=$this->upload_photo($_FILES['thumbnail']);
				if(!(isset($thumbnail['hash']))){$thumbnail['hash']='';}
				$folder=array(
					'id' 					=>	0,
					'name'				=>	$_POST['name'],
					'gallery_id'	=>	$_GET['id'],
					'thumbnail'		=>	$thumbnail['hash']
				);
				$this->Folders->save($folder);
				$this->Session->setFlash('Utworzono folder');
			}
	}
		//unikam problemów od strony klienta przy złym id galerii
		$element=array();
		if (isset($_POST['delete_folder'])) {
			$folder=array(
				'id'=>$_POST['folder_id'],
				'active'=>0
			);
			$this->Folders->save($folder);
			$this->Session->setFlash('Usunieto Folder');
		}
		//pobieram dane o folderach z odpowiednim gallery_id
		$folders=$this->Folders->find(
			'all',
			array(
				'conditions'=>array(
					'Folders.gallery_id'=>$_GET['id'],
					'Folders.active'=>1
				),
				'fields'=>array(
					'Folders.id',
					'Folders.name',
					'Folders.thumbnail'
				)));
				// zapisuje dane o folderach do tablicy element
				for ($i=0; $i<count($folders) ; $i++) {
					$element['Folders'][$i+1]['id']=$folders[$i]['Folders']['id'];
					$element['Folders'][$i+1]['name']=$folders[$i]['Folders']['name'];
					$element['Folders'][$i+1]['thumbnail']=$folders[$i]['Folders']['thumbnail'];
				}
		if(isset($_POST['Gallery_name'])){
			if(trim($_POST['name']==null)){
				$this->Session->setFlash('Podaj nazwę galerii');
			}else{
				$gallery=array(
					'id' 		=>	$_GET['id'],
					'name'	=>	$_POST['name']
				);
				$this->Galleries->save($gallery);
			}
		}
		//znajduję aktywne galerie
		$galleries=$this->get_galleries();
		//tworzę tablice poprawnych id galerii
		$valid_id=array();
		// w pętli dodaję poprawne idki do tablicy
		for ($i=1; $i<=count($galleries) ; $i++) {
			array_push($valid_id,$galleries[$i]['id']);
		}
		// jeśli istnieje id galerii w GETCIE i czy jest poprawne
	if($_GET==null){
			$this->Session->setFlash('Taka galeria nie istnieje');
			$this->redirect(array('action'=>'dashboard'));
		}else{
			// Jeżeli id z GET-a nie ma w tablicy poprawnych id to wywala na dashboard
			if(!(in_array($_GET['id'],$valid_id))){
				$this->Session->setFlash('Taka galeria nie istnieje');
				$this->redirect(array('action'=>'dashboard'));
				//po zwalidowaniu ID zapisuje nazwę galerii
			}else{
				//pętla szukająca nazwy galerii odpowiadającej id
				for ($i=1; $i<=count($galleries) ; $i++) {
					if ($galleries[$i]['id']==$_GET['id']) {
						$element['gallery']['name']=$galleries[$i]['name'];
						break;
					}
				}
			}
		}
		$this->set('element',$element);
	}

	public function folder_edit(){
		$tmp=$this->Folders->find(
			'first',
			array(
				'conditions'=>array(
					'Folders.id'=>$_GET['id']
				),
				'fields'=>array(
					'Folders.thumbnail'
				)));
				$hash=$tmp['Folders']['thumbnail'];
		if(isset($_POST['folder_form'])){
			if(trim($_POST['name']==null)){
				$this->Session->setFlash('Podaj nazwę folderu');
			}else{
				if ($_FILES['thumbnail']['type']!=''){
					$thumbnail=$this->upload_photo($_FILES['thumbnail']);
				}
				if(!(isset($thumbnail['hash']))){$thumbnail['hash']=$hash;}
				$folder=array(
					'id' 					=>	$_GET['id'],
					'name'				=>	$_POST['name'],
					'description'	=>	$_POST['description'],
					'thumbnail'		=>	$thumbnail['hash']
				);
				$this->Folders->save($folder);
				$this->Session->setFlash('Zapisano zmiany');
			}
		}
		$folders=array();
		$tmp=$this->Folders->find(
			'first',
			array(
				'fields'=>array(
					'Folders.id',
				),
				'order' =>array(
					'id'=>'DESC',
				)));
		$folder='folder_edit?id='.$tmp['Folders']['id'];
		 $element=$this->upload_gallery($_GET['id'],'folder_edit?id='.$_GET['id']);
		 //znajduję aktywne foldery
		$folders=$this->get_folders();
		//tworzę tablice poprawnych id folderu
		$valid_id=array();
		// w pętli dodaję poprawne idki do tablicy
		for ($i=1; $i<=count($folders) ; $i++) {
			array_push($valid_id,$folders[$i]['id']);
		}
		// jeśli istnieje id folderu w GETCIE i czy jest poprawne
	if($_GET==null){
			$this->Session->setFlash('Taki folder nie istnieje');
			$this->redirect(array('action'=>'dashboard'));
		}else{
			// Jeżeli id z GET-a nie ma w tablicy poprawnych id to wywala na dashboard
			if(!(in_array($_GET['id'],$valid_id))){
				$this->Session->setFlash('Taki folder nie istnieje');
				$this->redirect(array('action'=>'dashboard'));
			}else{
				//pętla szukająca nazwy folderu odpowiadającej id
				for ($i=1; $i<=count($folders) ; $i++) {
					if ($folders[$i]['id']==$_GET['id']) {
						$element['folder']['name']=$folders[$i]['name'];
						$element['folder']['description']=$folders[$i]['description'];
						$element['folder']['thumbnail']=$folders[$i]['thumbnail'];
						break;
					}
				}
			}
		}
		$this->set('element',$element);
	}

	public function gallery() {

	 $this->set("element",$element);
 }
	public function contact() {
	 $element = $tmp_element = array();
	 // zapisywsanie tekstu do kontaktu
	 if(isset($_POST['text'])){
		 $this->upload_text('contact');
	 }
	 // ukrywanie telefonu
	 if(isset($_POST['toggle_tel'])){
		 switch(trim($_POST['toggle_tel'])){
			 case 'Ukryj':
			 	$setting=array('id' => '6', 'value' => 'off');
			 	break;
			case 'Pokaż':
				$setting=array('id' => '6', 'value' => 'on');
				break;
		 }
		 $this->Settings->save($setting);
	 }
	 // ukrywanie maila
	 if(isset($_POST['toggle_mail'])){
		 switch(trim($_POST['toggle_mail'])){
			 case 'Ukryj':
			 	$setting=array('id' => '7', 'value' => 'off');
			 	break;
			case 'Pokaż':
				$setting=array('id' => '7', 'value' => 'on');
				break;
		 }
		 $this->Settings->save($setting);
	 }
	 $element['Settings']=$this->get_settings();
	 $this->set("element",$element);
	 }
	public function recommend() {
	 $element = $tmp_element = array();

	 $this->set("element",$element);
	 }


	 // wykorzystuje $tmp_arr, które trzyma nasz plik, który wysłaliśmy
	private function upload_photo($tmp_arr){
		$count=count($tmp_arr['name']);
		for($i=0;$i<$count;$i++){
			//tutaj mamy tymczasowe miejsce przechowywania pliku.
			$tmp_file= $tmp_arr['tmp_name'][$i];
			//defautowo $return jest puste, służy nam to walidacji.
			$return[$i]=null;
			//tu są dozwolone typy uploadowanych plików. Jeśli był by to plik np .php, albo gdyby podszywał się pod .jpg to nie został by wstawiony. Typ pliku można sprawdzić używając dupci.
			$upload_valid_ext=array('image/jpeg','image/bmp','image/png');
			//proces walidacji... jeśli typ się nie zgadza z $upload_valid_ext to nie przechodzi walidacji.
			if(in_array($tmp_arr['type'][$i],$upload_valid_ext)){
				//proces walidacji... jeśli istnieje plik $tmp_file, czyli istnieje plik, który przenosimy.
				if(is_uploaded_file($tmp_file)){
					//rozbijamy nazwę pliku.rozszerzenie na nazwę pliku + rozszerzenie.
					$explode_arr = explode('.',$tmp_arr['name'][$i]);
					//ostatnie rozbite będzie rozszerzenie. Ktoś mogł nazwać plik: p.l.i.k.rozszerzenie, więc nie chcemy się pojebać
					$ext=count($explode_arr)-1;
					//otrzymujemy tutaj rozszerzenie, zmniejszamy je, żeby był lowercasem. rozszerzenie to ostatnia wartość tabeli $explode_arr
					$ext=strtolower($explode_arr[$ext]);
					//nadajemy plikowi nazwę, którą będzie mieć w folderze upload. Musi byc niepowtarzalna.
					$hash=time().rand(1,999999999).'_'.rand(1,999999999);
					//całkowita nazwa pliku to $hash + . + $ext.
					$file=$hash.'.'.$ext;
					//a dokładna ścieżka to $path, czyli ścieżka do Controller/upload/$file.
					$path=WWW_ROOT.'upload/'.$file;

					//teraz przenosimy nasz plik z miejsca tymczasowego pobytu do ścieżki, którą stworzyliśmy.
					move_uploaded_file($tmp_file,$path);
					//tutaj zapisujemy wszystkie informacje w bazie danych `photos`:
						//tworzymy arraya ze wszystkimi danymi
					$photo=array(
						'id'=>0,
						'hash'=>$hash,
						'ext'=>$ext,
						'org'=>$tmp_arr['name'][$i],
						'size'=>$tmp_arr['size'][$i]
					);
						//zapisujemy w bazie danych (metoda Photos)
					$this->Photos->save($photo);
						//zwracamy id, żeby zapisać photo_id później.
					$return[$i]=$this->Photos->id;
					$return['hash']=$hash.'.'.$ext;
				}
			}
		}
		return $return;
	}
	private function upload_text($action=''){
		$data=$this->data;
		$setting=array(
			'id'=>$data['id'],
			'name'=>$data['name'],
			'value'=>trim($data['settings'])
		);
		$element['Settings'][$data['name']]=$setting['value'];
		$this->Settings->save($setting);
		$this->Session->setFlash('Dane zapisane');
		$this->redirect(array('action'=>$action));
	}

	private function upload_gallery($folder_id,$folder){
		$tmp=$this->Folder_photos->find(
			//wszystkie...
			'all',
			//dla których...
			array(
				//warunki [WHERE]
				'conditions'=>array(
					'Folder_photos.folder_id'=>$folder_id,
					'Folder_photos.active'=>1
				),
				//wybiera pola:
				'fields'=>array(
					'Folder_photos.id',
					'Folder_photos.photo_id'
				)));
				// liczymy ile zdjęć znaleziono
				$folder_photos_count=count($tmp);
				$element['count']=$folder_photos_count;
				// pętla która w zależności od ilości zdjęć zapisuje potrzebne dane
				for ($i=0; $i<$folder_photos_count; $i++) {
				 $src=$this->get_photo($tmp[$i]['Folder_photos']['photo_id']);
				 $element['src'][$i]=$src;
				 $element['id'][$i]=$tmp[$i]['Folder_photos']['photo_id'];
				 $element['Folder_photos.id'][$i]=$tmp[$i]['Folder_photos']['id'];
				}
		//upload zdjęć do bazy
		if(isset($_FILES['Photos'])){
			$photos=$_FILES['Photos'];
			$ret=$this->upload_photo($photos);
			for ($i=0; $i<count($photos['name']) ; $i++){
				if($ret[$i]==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia nr '.($i+1));
				}else{
					$data['Folder_photo']['photo_id'][$i]=$ret[$i];
					$data['Photo']=array(
						'id'=>0,
						'folder_id'=>$folder_id,
						'photo_id'=>$ret[$i],
					);
					$this->Folder_photos->save($data['Photo']);
					$this->Session->setFlash('Zdjęcie nr '.($i+1).' zostało zapisane.');
				}
			}
			$this->redirect(array('action'=>$folder));
		}
		//zmiana zdjęcia lub ukrywanie go
		if((isset($_POST['photo'])) || (isset($_POST['delete']))){
			$data=$this->data;
			if(isset($_POST['delete'])){
				$data['Photo']=array(
					'id'=>$data['Folder_photos.id'],
					'active'=>0
				);
				$this->Folder_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('usunięto slajd');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>$folder));
			}else{
				$photo=$_FILES['Photo'];
				//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
				$ret=$this->upload_photo($photo);
				if($ret['0']==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia');
					//i wysyła nas do about...
					$this->redirect(array('action'=>$folder));
				}else{
					$data['Folder_photos']['photo_id']=$ret;
				}
				//zapisujemy naszego photosa do tablicy slider_photos.
				if($data['id']>0){
					$data['Photo']=array(
						'id'=>$data['Folder_photos.id'],
						'photo_id'=>$ret[0],
						'folder_id'=>$data['Folder_id']
					);
				}else{
					$data['Photo']=array(
						'id'=>0,
						'photo_id'=>$ret[0],
						'folder_id'=>$data['Gallery_id']
					);
				}
				$this->Folder_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('Dane zapisane');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>$folder));
			}
		}
		return $element;
	}
	//funkcja do znajdywania aktywnych galerii
	private function get_galleries(){
		$galleries=array();
		$tmp=$this->Galleries->find(
			'all',
			array(
				'conditions'=>array(
					'Galleries.active'=>1
				),
				'fields'=>array(
					'Galleries.id',
					'Galleries.name'
				)));

				for ($i=0; $i<count($tmp); $i++) {
					$galleries[$i+1]['id']=$tmp[$i]['Galleries']['id'];
					$galleries[$i+1]['name']=$tmp[$i]['Galleries']['name'];
				}
			return $galleries;
	}
	//funkcja do znajdywania aktywnych folderów
	private function get_folders(){
		$folders=array();
		$tmp=$this->Folders->find(
			'all',
			array(
				'conditions'=>array(
					'Folders.active'=>1
				),
				'fields'=>array(
					'Folders.id',
					'Folders.name',
					'Folders.description',
					'Folders.thumbnail'
				)));

				for ($i=0; $i<count($tmp); $i++) {
					$folders[$i+1]['id']=$tmp[$i]['Folders']['id'];
					$folders[$i+1]['name']=$tmp[$i]['Folders']['name'];
					$folders[$i+1]['description']=$tmp[$i]['Folders']['description'];
					$folders[$i+1]['thumbnail']=$tmp[$i]['Folders']['thumbnail'];
				}
			return $folders;
	}
}

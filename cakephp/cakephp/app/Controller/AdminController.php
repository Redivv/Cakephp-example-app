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
		'Slider_photos',
		'Gallery_photos',
		'User'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'cms';
		$this->Auth->allow('index');					// funkcja index jest dostępna dla niezalogowanych
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
		/*if($this->request->is('post'))​​{
			$data​​=​​$this->data;
			$this->User->save($data['User']);
			echo​​’Dodano’;
			die();
		*/
}

	public function dashboard(){

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
			$photo=$_FILES['Photo'];
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
	public function gallery() {
	 $element = $tmp_element = array();
	 $element=$this->upload_gallery(1,'gallery');

	 $this->set("element",$element);
 }
	public function contact() {
	 $element = $tmp_element = array();
	 if(isset($_POST['text'])){
		 $this->upload_text('contact');
	 }
	 $element['Settings']=$this->get_settings();
	 $this->set("element",$element);
	 }
	public function meh() {
	 $element = $tmp_element = array();

	 $this->set("element",$element);
	 }


	 //upload_photo wykorzystuje $tmp_arr, które trzyma nasz plik, który wysłaliśmy
	private function upload_photo($tmp_arr){
		$count=count($tmp_arr['name']);
		for($i=0;$i<$count;$i++){
			//używając dupci wyświetlają nam się informacje o tym zdjęciu.
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

	private function upload_gallery($gallery_id,$gallery){
		$tmp=$this->Gallery_photos->find(
			//wszystkie...
			'all',
			//dla których...
			array(
				//warunki [WHERE]
				'conditions'=>array(
					'Gallery_photos.gallery_id'=>$gallery_id,
					'Gallery_photos.active'=>1
				),
				//wybiera pola:
				'fields'=>array(
					'Gallery_photos.id',
					'Gallery_photos.photo_id'
				)));
				$gallery_photos_count=count($tmp);
				$element['count']=$gallery_photos_count;
				for ($i=0; $i<$gallery_photos_count; $i++) {
				 $src=$this->get_photo($tmp[$i]['Gallery_photos']['photo_id']);
				 $element['src'][$i]=$src;
				 $element['id'][$i]=$tmp[$i]['Gallery_photos']['photo_id'];
				 $element['Gallery_photos.id'][$i]=$tmp[$i]['Gallery_photos']['id'];
				}
		if(isset($_FILES['Photos'])){
			$photos=$_FILES['Photos'];
			$ret=$this->upload_photo($photos);
			for ($i=0; $i<count($photos['name']) ; $i++){
				if($ret[$i]==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia nr '.($i+1));
				}else{
					$data['Gallery_photo']['photo_id'][$i]=$ret[$i];
					$data['Photo']=array(
						'id'=>0,
						'gallery_id'=>$gallery_id,
						'photo_id'=>$ret[$i],
					);
					$this->Gallery_photos->save($data['Photo']);
					$this->Session->setFlash('Zdjęcie nr '.($i+1).' zostało zapisane.');
				}
			}
			$this->redirect(array('action'=>$gallery));
		}
		if((isset($_POST['photo'])) || (isset($_POST['delete']))){
			$data=$this->data;
			$photo=$_FILES['Photo'];
			if(isset($_POST['delete'])){
				$data['Photo']=array(
					'id'=>$data['Gallery_photos.id'],
					'slider_id'=>$data['Gallery_id'],
					'active'=>0
				);
				$this->Gallery_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('usunięto slajd');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'gallery'));
			}else{
				//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
				$ret=$this->upload_photo($photo);
				if($ret['0']==0){
					//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
					$this->Session->setFlash('Błąd przy dodawaniu zdjęcia');
					//i wysyła nas do about...
					$this->redirect(array('action'=>$gallery));
				}else{
					$data['Gallery_photos']['photo_id']=$ret;
				}
				//zapisujemy naszego photosa do tablicy slider_photos.
				if($data['id']>0){
					$data['Photo']=array(
						'id'=>$data['Gallery_photos.id'],
						'photo_id'=>$ret[0],
						'gallery_id'=>$data['Gallery_id']
					);
				}else{
					$data['Photo']=array(
						'id'=>0,
						'photo_id'=>$ret[0],
						'gallery_id'=>$data['Gallery_id']
					);
				}
				$this->Gallery_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('Dane zapisane');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>$gallery_id));
			}
		}
		return $element;
	}
}

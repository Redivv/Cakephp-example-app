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
		'Slider_photos'
	);

	private function dupcia($dataaa=''){
	 echo '<pre>';
	 var_dump($dataaa);
	 echo '</pre>';
	 die();
 }
	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'cms';
	}
	public function index(){
		$element=$tmp=array();

		$this->layout = 'login';
		$this->set('element',$element);
	}
	public function dashboard(){
		$element=$tmp=array();


		$this->set('element',$element);
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
			$tmp['Slider_id']=$tmp['Slider_id'][0]['Sliders']['id'];


			$tmp['Photo_id']=$this->Slider_photos->find(
				//wszystkie...
				'all',
				//dla których...
				array(
					//warunki [WHERE]
					'conditions'=>array(
						'Slider_photos.slider_id'=>$tmp['Slider_id'],
						'Slider_photos.active'=>1
					),
					//wybiera pola:
					'fields'=>array(
						'Slider_photos.id',
						'Slider_photos.photo_id'
					)));
					$element['Slider']['number']=$slides_number=count($tmp['Photo_id']);

			for ($i=1; $i <=$slides_number ; $i++) {
				$element['Photo'][$i]['1']=$this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
				$element['Photo'][$i]['2']=$tmp['Photo_id'][$i-1]['Slider_photos']['photo_id'];
				$element['Photo'][$i]['3']=$tmp['Photo_id'][$i-1]['Slider_photos']['id'];

			}
			//$this->dupcia($element['Photo']);
				//END SLIDER1! ---------------------------------------------------------------------------------------

 	//START UPLOAD_PHOTOS ------------------------------------------------------------------------
		if($this->request->is('post')){


			$data=$this->data;
			if(isset($data['delete'])){
				$data['Photo']=array(
					'id'=>$data['Slider_photos.id'],
					'slider_id'=>$tmp['Slider_id'],
					'active'=>0
				);
				//$this->dupcia($data['Slider_photos.id']);
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('usunięto slajd');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'about'));
			}else{
				//$this->dupcia($data);
				//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
				$ret=$this->upload_photo($data['Photo']);
				if(!$ret){
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
						'photo_id'=>$ret,
						'slider_id'=>$tmp['Slider_id']
					);
				}else{
					$data['Photo']=array(
						'id'=>0,
						'photo_id'=>$ret,
						'slider_id'=>$tmp['Slider_id']
					);
				}
				//$this->dupcia($data['Photo']);
				$this->Slider_photos->save($data['Photo']);
				//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
				$this->Session->setFlash('Dane zapisane');
				//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
				$this->redirect(array('action'=>'about'));
			}
		}
	//END UPLOAD_PHOTOS ------------------------------------------------------------------------



		$this->set('element',$element);
	}
	public function gallery() {
	 $element = $tmp_element = array();

	 $this->set("element",$element);
	 }
	public function contact() {
	 $element = $tmp_element = array();

	 $this->set("element",$element);
	 }
	public function meh() {
	 $element = $tmp_element = array();

	 $this->set("element",$element);
	 }


	 //upload_photo wykorzystuje $tmp_arr, które trzyma nasz plik, który wysłaliśmy
	public function upload_photo($tmp_arr){
		//używając dupci wyświetlają nam się informacje o tym zdjęciu.
		//$this->dupcia($tmp_arr);
		//tutaj mamy tymczasowe miejsce przechowywania pliku.
		$tmp_file= $tmp_arr['tmp_name'];
		//defautowo $returm jest puste, służy nam to walidacji.
		$return=null;
		//tu są dozwolone typy uploadowanych plików. Jeśli był by to plik np .php, albo gdyby podszywał się pod .jpg to nie został by wstawiony. Typ pliku można sprawdzić używając dupci.
		$upload_valid_ext=array('image/jpeg','image/bmp','image/png');
		//proces walidacji... jeśli typ się nie zgadza z $upload_valid_ext to nie przechodzi walidacji.
		if(in_array($tmp_arr['type'],$upload_valid_ext)){
			//proces walidacji... jeśli istnieje plik $tmp_file, czyli istnieje plik, który przenosimy.
			if(is_uploaded_file($tmp_file)){
				//rozbijamy nazwę pliku.rozszerzenie na nazwę pliku + rozszerzenie.
				$explode_arr = explode('.',$tmp_arr['name']);
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
					'org'=>$tmp_arr['name'],
					'size'=>$tmp_arr['size']
				);
					//zapisujemy w bazie danych (metoda Photos)
				$this->Photos->save($photo);
					//zwracamy id, żeby zapisać photo_id później.
				return $this->Photos->id;
			}
		}

		return $return;
	}

	public function news_edit($id=0){
		$element=$tmp=array();

		if($this->request->is('post')){
			$data=$this->data;

			//bawimy się zdjęciem PATRZ: UPLOAD_PHOTO. zabieramy id od Photo z tablicy photos.
			$ret=$this->upload_photo($data['News']['Photo']);
			if($ret){
				//dodajemy photo_id to naszych danych z formularza edycji newsa.
				$data['News']['photo_id']=$ret;
			}else{
				//jeśli się nie uda dodanie id od zdjęcia, czytaj zdjęcie się nie dodało dostajemy info, że zdjęcie się nie dodało
				$this->Session->setFlash('Błąd przy dodawaniu zdjęcia');
				//i wysyła nas do tablicy newsów...
				$this->redirect(array('action'=>'news'));
			}
			//zapisujemy naszego newsa do tablicy news.
			$this->News->save($data['News']);
			//setFlash to jednorazowy komunikat, można ostylować w flash.ctp
			$this->Session->setFlash('Dane zapisane');
			//redirect wykonuje akcje, wysyłając nas tam, gdzie akcja kazała
			$this->redirect(array('action'=>'news'));
		}
		//tworzymy defaultową tablicę $element['News'], do której będą pobierane dane z tablicy news
		$element['News']=array(
			'id'=>$id,
			'title'=>'',
			'description'=>'',
			'Photo'=>''
		);
		//jeśli id jest większe od zera to pobiera nam dane, jeśli jest równe 0 to powstanie nowy news
		if($id>0){
			$tmp['News']=$this->News->find('first',array(
				'conditions'=>array(
					'News.id'=>$id,
					'News.active'=>1
				)
			));

			//jeśli nie ma newsa, którego szukamy (np na 3 newsy ktoś własnoręcnie wpisał 2319748791249523358458328487):
			if(!$tmp['News']){
				//wywala komunikat o błędzie
				$this->Session->setFlash('Nie znaleziono newsa');
				//i odsyła nas do newsów.
				$this->redirect(array('action'=>'news'));
			}else{
				$element['News']['title'] = $tmp['News']['News']['title'];
				$element['News']['description'] = $tmp['News']['News']['description'];
				$element['News']['Photo'] = $this->get_photo($tmp['News']['News']['photo_id']);
			}
		}
		$this->set('element',$element);
	}



}

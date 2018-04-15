<?php
  App::uses('AppController', 'Controller');

  class SitesController extends AppController {
    public $uses = array(
      'Photos',
      'Settings',
      'Sliders',
      'Galleries',
      'Folders',
      'Slider_photos',
      'Folder_photos'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();       // wszystkie funkcje są dostępne dla niezalogowanych
    //pobieramy liczbę i nazwy galerii
		$galleries=$this->get_galleries();
		$this->set('galleries',$galleries);
  }


  public function index(){
    $element = $tmp = array();
    $element['helper']['menu']='index';
    $this->layout='home';

    $this->set("element",$element);
    }

    public function about() {
      $element = $tmp = array();
      $element['helper']['menu']='about';
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
  						$element['Slider'][$j-1]['number']=$slides_number=count($tmp['Photo_id']);;

  				for ($i=1; $i <=$slides_number ; $i++) {
  					$element['Photo'][$j-1][$i]['1']=$this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
  				}
  			}
  				//END SLIDER1! ---------------------------------------------------------------------------------------

      $element['Settings']=$this->get_settings();
      $this->set("element",$element);
    }


    public function Gallery(){
      $element=array();
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
      				$this->redirect(array('action'=>'index'));
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
    public function Folder(){
      $tmp=$this->Folder_photos->find(
  			//wszystkie...
  			'all',
  			//dla których...
  			array(
  				//warunki [WHERE]
  				'conditions'=>array(
  					'Folder_photos.folder_id'=>$_GET['id'],
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
       $this->redirect(array('action'=>'index'));
      }else{
       // Jeżeli id z GET-a nie ma w tablicy poprawnych id to wywala na dashboard
       if(!(in_array($_GET['id'],$valid_id))){
         $this->Session->setFlash('Taki folder nie istnieje');
         $this->redirect(array('action'=>'index'));
       }
      }
      $this->set('element',$element);
    }

    public function meh(){
      $element = $tmp = array();
      $element['helper']['menu']='meh';

      $this->set("element",$element);
    }

    public function contact(){

      $element['Settings']=$this->get_settings();
      $this->set("element",$element);
  }

  private function get_gallery_photos($gallery_id=''){
    $gallery=null;
    $photo_id=$this->Gallery_photos->find(
      'all',
      array(
        'conditions'=>array(
          'Gallery_photos.gallery_id'=>$gallery_id,
          'Gallery_photos.active'=>1
        ),
        'fields'=>array(
          'Gallery_photos.photo_id'
        )
      )
    );
    for ($i=0; $i<count($photo_id) ; $i++) {
      $gallery[$i]=$this->get_photo($photo_id[$i]['Gallery_photos']['photo_id']);
    }
    return $gallery;
  }
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
?>

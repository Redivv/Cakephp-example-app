<?php
  App::uses('AppController', 'Controller');

  class StronyController extends AppController {
    public $uses = array(
      'Photos',
      'Settings',
      'Sliders',
      'Galleries',
      'Slider_photos'
  );

  // private function dupcia($data=''){
  // 	 echo '<pre>';
  // 	 var_dump($data);
  // 	 echo '</pre>';
  // 	 die();
  // }

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();       // wszystkie funkcje są dostępne dla niezalogowanych 
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
  						$element['Slider'][$j-1]['number']=$slides_number=count($tmp['Photo_id']);
  						//$this->dupcia($tmp['Photo_id'][0]['Slider_photos']['photo_id']);

  				for ($i=1; $i <=$slides_number ; $i++) {
  					$element['Photo'][$j-1][$i]['1']=$this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
  				}
  			}
  				//END SLIDER1! ---------------------------------------------------------------------------------------

      $element['Settings']=$this->get_settings();
      $this->set("element",$element);
    }


    public function wesela(){
      $element = $tmp = array();
      $element['helper']['menu']='gallery';

      $this->set("element",$element);
    }

    public function sesje(){
      $element = $tmp = array();
      $element['helper']['menu']='gallery';

      $this->set("element",$element);
    }

    public function plenery(){
      $element = $tmp = array();
      $element['helper']['menu']='gallery';

      $this->set("element",$element);
    }

    public function meh(){
      $element = $tmp = array();
      $element['helper']['menu']='meh';

      $this->set("element",$element);
    }

    public function contact(){
      $element = $tmp = array();
      $element['helper']['menu']='contact';

      $this->set("element",$element);
    }

  }
?>

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
      //START SLIDER1!
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
  					'Slider_photos.photo_id'
  				)));
          $element['Slider']['number']=$slides_number=count($tmp['Photo_id']);

      for ($i=1; $i <=$slides_number ; $i++) {
  			$element['Photo'][$i] = $this->get_photo($tmp['Photo_id'][$i-1]['Slider_photos']['photo_id']);
  		}
        //END SLIDER1!

      $element['Settings']=$this->get_settings();
      $this->set("element",$element);
    }


    public function gallery(){
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

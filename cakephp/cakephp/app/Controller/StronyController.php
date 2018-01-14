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

   private function dupcia($data=''){
   	 echo '<pre>';
   	 var_dump($data);
   	 echo '</pre>';
   	 die();
   }


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
  						$element['Slider'][$j-1]['number']=$slides_number=count($tmp['Photo_id']);;

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
      if($this->request->is('post')){
      function validateTypes($type='', $text='') {
      	if($type=='email'){
      		$v = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
      		return preg_match($v, $text)===1;
      	}elseif($type=='txt'){
      		if(trim($text)){
      			return true;
      		}else{
      			return false;
      		}
      	}elseif($type=='country'){
      		if(($text>1&&$text<=250)){
      			return true;
      		}else{
      			return false;
      		}
      	}else{
      		return false;
      	}
      }

      function mailsend($txt='', $header='' , $mail='j.rajca45@gmail.com'){
              // Naglowki mozna sformatowac tez w ten sposob.
              $naglowki = "From: Portfolio <info@jakubrajca.pl>".PHP_EOL;
              $naglowki .= "MIME-Version: 1.0".PHP_EOL;
              $naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL;

              //Wiadomość najczęściej jest generowana przed wywołaniem funkcji
              $wiadomosc = '<html>
              <head>
                 <title>'.$header.'</title>
              </head>
              <body>
                 '.$txt.'
              </body>
              </html>';
              if(!$header){
                  $header='No title';
              }

              return mail($mail, $header, $wiadomosc, $naglowki, 'info@jakubrajca.pl');

      }

      	$errors = array();

      	$name = trim($_POST['name']);
      	$email = trim($_POST['email']);
      	$text  = trim($_POST['text']);


      	if(!validateTypes('txt', $name)){
      		$errors['name'] = 'Prosze podać imię';
      	}
      	if(!validateTypes('email', $email)){
      		$errors['email'] = 'Nieprawidłowy format adresu email';
      	}
      	if(!validateTypes('txt', $text)){
      		$errors['text'] = 'Prosze podać treść wiadomości';
      	}
      	if(count($errors)>0){
      		$result = array( 'type' => 'error', 'code' => $errors);
      	}else{
      		$result = array( 'type' => 'success', 'code' => 'Dziękujemy za wysłanie wiadomości');

      		$txt  = '<b>name:</b> '.$name.'<br>';
      		$txt .= '<b>email:</b> '.$email.'<br>';
      		$txt .= '<b>text:</b> '.$text.'<br>';
      		mailsend($txt, "Wiadomość ze strony Portfolio Marek");
      	}

      	$result = json_encode($result);
      	echo $result;
      }
    }

  }
?>

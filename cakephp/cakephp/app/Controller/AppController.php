<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
  public $uses = array(
    'Photos',
    'Settings'
  );
  public $components = array(
    'Session',          // sesja
    'Auth' => array(        // autentykacja, metoda
      'authenticate' => array(  // autentykcja
        'Form' => array(            // formularz
          'userModel' => 'User',        // model z którego korzystam
          'fields' => array(      // wymagane pola z modelu
            'username' => 'email',          // username to email
            'password' => 'password'        // password to password
          )
        )
      ),
    'loginRedirect' => array('controller' => 'admin', 'action' => 'index'),       // brak sesji użytkownika = wysłanie na index
    'loginAction'   => array('controller' => 'admin', 'action' => 'index'),
    'logoutRedirect'=> array('controller' => 'admin', 'action' => 'index'),       // wylogowanie = wysłanie na index
    'sessionKey'    => 'User'
  ));
  /*public function beforeFilter(){
    $app=array();
    $app['Settings']=$this->get_settings();
    $this->set('app',$app);
  }
  public function get_settings() {
    $tmp = $this->Settings->find('all');
    $return=array();
    foreach($tmp as $k=>$v){
      $return[$v['Settings']['id']]=$v['Settings']['value'];
    }
    return $return;
  }*/
  public function get_photo($id=1) {
    $tmp=$this->Photos->find('first',array(
      'conditions'=>array(
        'Photos.id'=>$id
      )));
    if($tmp){
      return '/cakephp/upload/'.$tmp['Photos']['hash'].'.'.$tmp['Photos']['ext'];
    }else{return '';}
  }
  public function get_settings(){
    $tmp=$this->Settings->find('all',array(
      'fields'=>array(
        'Settings.name',
        'Settings.value'
      )
    ));
    return $tmp;
  }


}

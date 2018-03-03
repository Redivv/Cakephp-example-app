<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 */
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
  public function dupcia($data=''){
	 echo '<pre>';
	 var_dump($data);
	 echo '</pre>';
	 die();
 }
}

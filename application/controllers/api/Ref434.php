<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref434 extends MY_Controller {

  public function  __construct() {
    parent::__construct();
    $this->table = "ref434";
    $this->nameId = "Id";
  }

  public function get($Id = '', $date = ''){
    parent::get($Id,$date);
  }
  
  public function setDefaultValue(){
  }

  public function create(){
  }
  
  public function update($Id){
  }

  public function delete($Id){
  }
}

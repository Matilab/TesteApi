<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref713 extends MY_Controller {

  public function  __construct() {
    parent::__construct();
    $this->table = "ref713";
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

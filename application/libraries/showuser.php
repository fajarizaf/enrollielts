<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Showuser  {

    
    function  __construct() {
        $CI =& get_instance();
	      $this->instan = $CI;
    }
   


    
  function getAddr($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAddrs($param);
        foreach ($query as $row ) {
          echo $row->branchaddr;
        }

  }


  function getnameaditionalinfo($table,$code) {
      $CI =& get_instance();
      $CI->load->model('app_model');

        $data['code'] = $code;
        $query =  $CI->app_model->getSelectedData($table, $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->name;
          }
        } else {
          echo '-';
        }

  }


  function getStatusUser($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idroles'] = $code;
        $query =  $CI->app_model->getSelectedData('roles', $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->rolesname;
          }
        } else {
          echo '-';
        }
  }


  function getNameUser($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->userfirstname;
          }
        } else {
          echo '-';
        }
  }


  




}
?>
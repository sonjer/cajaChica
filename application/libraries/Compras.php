<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras {

	var $info=array();
  var $idPartida;

 public function __construct(){
		$CI =& get_instance();
		$data = $CI->db->select("*")
		->where("idPartida", 62)
		->get("datosCompra");

  		if($data->num_rows() == 0) {
  			$CI->template->error("You are missing the site settings database row.");
  		} else {
  			$this->info = $data->row();
  		}
	}

  public function setIdPartida($id){
    return $id;
  }

}
?>

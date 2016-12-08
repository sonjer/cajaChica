<?php
class Ordenes_Model extends CI_Model {
  /*
  Seleccionar Todos los elementos de una tabla
  */

  /********************************************** SELECCION ********************************************************************/

  /************************** CECO **************************************************************************/
  public function jsonGetOrdenCompra($OrdenComp) {
    //$this->output->enable_profiler(TRUE);
    if($OrdenComp == 'chavelo') :
      $q = $this -> db -> query("SELECT * FROM Ocompras");
      else :
        $q = $this -> db -> query("SELECT * FROM Ocompras where OrdenComp = ?", $OrdenComp);
      endif;

      if ($q -> num_rows() > 0) {
        foreach ($q->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
    }
    /********************************************** AUTORIZACION DE ORDEN DE  COMPRA ********************************************************************/

    function autorizarbyID($idCompra){
     $this->output->enable_profiler(true);
      if($this -> db -> query("update ordenescompra SET NomUser = ". $this->user->info->ID .", statusAut = 'Autorizada', FechHoraAut = now() WHERE idCompra = ?;", $idCompra)){
        return 'actualizado';
      }
    }
    /********************************************** DESAUTORIZAR ORDEN DE  COMPRA ********************************************************************/
    function desautorizarbyID($idCompra){
     $this->output->enable_profiler(false);
      if($this -> db -> query("UPDATE ORDENESCOMPRA SET NomUser = NULL, statusAut =NULL, FechHoraAut =NULL WHERE  idCompra = ?;", $idCompra)){
        return 'actualizado';
      }
    }


  }
  ?>

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
      $q = $this -> db -> query("SELECT * FROM ORDENESCOMPRA");
      else :
        $q = $this -> db -> query("SELECT * FROM ORDENESCOMPRA where OrdenComp = ?", $OrdenComp);
      endif;

      if ($q -> num_rows() > 0) {
        foreach ($q->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
    }

    /*Get DATA*/
    public function getClientes(){
      return $this->db->query("SELECT * FROM clientes;");
    }

    /* GET 1 ROW */
    public function jsonGetIdCompra($idCompra) {
      //  $this->output->enable_profiler(TRUE);
      $q = $this -> db -> query("select * FROM ORDENESCOMPRA where idCompra = ?", $idCompra);
      if ($q -> num_rows() > 0) {
        foreach ($q->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
    }

    function autorizar($obj){
     $this->output->enable_profiler(TRUE);
      extract($this->compras->arrayCastRecursive($obj));
      if($this -> db -> query("UPDATE ordenescompra SET NomUser = ?, statusAut = 'false' WHERE idCompra = ?;", $this->user->info->ID, $idCompra)){
        return 'actualizado';
      }
    }

    function autorizarbyID($idCompra){
     $this->output->enable_profiler(TRUE);
      if($this -> db -> query("update ordenescompra SET NomUser = ". $this->user->info->ID .", statusAut = 'false', FechHoraAut = now() WHERE idCompra = ?;", $idCompra)){
        return 'actualizado';
      }
    }

  }
  ?>

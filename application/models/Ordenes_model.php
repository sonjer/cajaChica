<?php
class Ordenes_Model extends CI_Model {
    /*
     Seleccionar Todos los elementos de una tabla
     */

     /********************************************** SELECCION ********************************************************************/

     /************************** CECO **************************************************************************/
     public function jsonGetCentroCostos($idCentroCostos) {
         if($idCentroCostos == 'idCentroCostos') :
            $q = $this -> db -> query("SELECT * FROM centroCostos;");
         else :
            $q = $this -> db -> query("SELECT * FROM centroCostos where idCentroCostos = ?", $idCentroCostos);
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
     public function jsonGetRowCentroCostos($idCentroCostos) {
        $q = $this -> db -> query("SELECT * FROM centroCostos WHERE idCentroCostos = ?", $idCentroCostos);
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
     }



       }
    ?>

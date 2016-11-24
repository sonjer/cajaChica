<?php
class Catalogo_Model extends CI_Model {
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
     /************************** INSUMOS **************************************************************************/





   /********************************************** INSERCION ********************************************************************/
     
    function insertCentroCostos($obj){
       // $this->output->enable_profiler(TRUE);
        if($this->db->insert('centroCostos', $obj)) {
            return 'insertado';
        }
    }

     /********************************************** ACTUALIZACION ********************************************************************/
    function updateCentroCostos($obj){
       // $this->output->enable_profiler(TRUE);
        extract($this->compras->arrayCastRecursive($obj));
        $this->db->where('idCentroCostos', $idCentroCostos);
        if($this->db->update('centroCostos', $obj)){
            return 'actualizado';
        }
    }

     /********************************************** ELIMINAR ********************************************************************/
    public function deleteCentroCostos($id){
     //   $this->output->enable_profiler(TRUE);
        $this->db->where("idCentroCostos", $id)->delete("centroCostos");
    }

     /********************************************** Fin Controller ********************************************************************/
    }
    ?>

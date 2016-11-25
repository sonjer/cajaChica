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
     public function jsonGetInsumos($idInsumo) {
         if($idInsumo == 'idInsumos') :
            $q = $this -> db -> query("SELECT * FROM insumos;");
         else :
            $q = $this -> db -> query("SELECT * FROM insumos where idInsumo = ?", $idInsumo);
         endif;
        
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
     }

     /*Get DATA*/
     public function jsonGetInsumos($idInsumo) {
         if($idCentroCostos == 'idInsumo') :
            $q = $this -> db -> query("SELECT * FROM insumos;");
         else :
            $q = $this -> db -> query("SELECT * FROM insumos where idInsumo = ?", $idInsumo);
         endif;
        
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
     }

    /* GET 1 ROW */
     public function jsonGetRowInsumos($idInsumo) {
        $q = $this -> db -> query("SELECT * FROM insumos WHERE idInsumo = ?", $idInsumo);
        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
     }




   /********************************************** INSERCION ********************************************************************/
     
    function insertCentroCostos($obj){
       // $this->output->enable_profiler(TRUE);
        if($this->db->insert('centroCostos', $obj)) {
            return 'insertado';
        }
    }

    function insertInsumos($obj){
       // $this->output->enable_profiler(TRUE);
        if($this->db->insert('insumos', $obj)) {
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
        function updateInsumos($obj){
       // $this->output->enable_profiler(TRUE);
        extract($this->compras->arrayCastRecursive($obj));
        $this->db->where('idInsumo', $idInsumo);
        if($this->db->update('insumos', $obj)){
            return 'actualizado';
        }
    }

     /********************************************** ELIMINAR ********************************************************************/
    public function deleteCentroCostos($id){
     //   $this->output->enable_profiler(TRUE);
        $this->db->where("idCentroCostos", $id)->delete("centroCostos");
    }
        public function deleteInsumos($id){
     //   $this->output->enable_profiler(TRUE);
        $this->db->where("idinsumo", $id)->delete("insumos");
    }

     /********************************************** Fin Controller ********************************************************************/
    }
    ?>

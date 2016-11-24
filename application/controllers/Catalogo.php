<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this -> load -> model("catalogo_model");

        if (!$this -> user -> loggedin) {
        //    redirect(site_url("login"));
        }

        if ($this->user->info->user_level == 6 || $this->user->info->user_level == 7) {
            $this -> template -> error(lang("error_2"));
        }
    }

    public function centroCostos() {
        $this -> template -> loadData("activeLink", array("catalogo" => array("centroCostos" => 1)));
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/catalogo/ceco-angular.js" /></script>'.
                                      '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/angular-ui-router.min.js" /></script>');
        $data['clientes'] = $this->catalogo_model->getClientes();
        $this->template->loadContent("catalogo/centroCostos.php", $data);
    } 

    /********************************************** SELECCION ********************************************************************/
    function getCentroCostos($idCentroCostos){  
        $data['data'] = $this->catalogo_model->jsonGetCentroCostos($idCentroCostos);
         $this->output->set_content_type('application/json');
         $this->output->set_output(json_encode($data));          
    }

    public function getRowCentroCostos($idCentroCostos) {
        $data = $this -> catalogo_model -> jsonGetRowCentroCostos($idCentroCostos);
        return $data['0'];
     //  $this -> output -> set_content_type('application/json');
      //  $this -> output -> set_output(json_encode($data['0'], JSON_FORCE_OBJECT));
    }

    /********************************************** INSERCION / ACTUALIZACION  ********************************************************************/
    public function saveAcceso(){
        if ($this->user->info->user_level == 5){
            $obj = json_decode(file_get_contents("php://input"));
            $data = $this->getRowCentroCostos($obj->idCentroCostos);
            //print_r($obj);
       if (empty($data)) {
             echo $this->catalogo_model->insertCentroCostos($obj);
         } else {
             echo $this->catalogo_model->updateCentroCostos($obj);
         } 
     }
     else{
        $this->template->error(lang("error_2"));
    }
}

/************************* INSUO **********************************/




/********************************************** ELIMINAR ********************************************************************/

public function eliminaCentroCostos(){
    if ($this->user->info->user_level == 5){
        $entry_id = urldecode($this -> uri -> segment(3));
        echo $this->catalogo_model->deleteCentroCostos($entry_id);
    }
    else{
        $this->template->error(lang("error_2"));
    }        
}



/*  GET DATA JSON */
function getvistaRequisiciones($where) {
    switch ($where) {
        case 1 :
        $where = 'ORDER BY idCentroCostos, consecutivo;';
        break;
        default :
        $where = 'LIMIT 0;';
    }

    $data['data'] = $this -> requisiciones_model -> getJsonvistaRequisiciones($where);
    $this -> output -> set_content_type('application/json');
    $this -> output -> set_output(json_encode($data));
}



}
?>

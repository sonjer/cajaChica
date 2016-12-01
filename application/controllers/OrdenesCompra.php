<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class OrdenesCompra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this -> load -> model("Ordenes_model");

        if (!$this -> user -> loggedin) {
        //    redirect(site_url("login"));
        }

        if ($this->user->info->user_level == 6 || $this->user->info->user_level == 7) {
            $this -> template -> error(lang("error_2"));
        }
    }
        public function ordenes() {
        $this -> template -> loadData("activeLink", array("catalogo" => array("ordenes" => 1)));
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/catalogo/ceco-angular.js" /></script>'.
                                      '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/angular-ui-router.min.js" /></script>');
        $data['clientes'] = $this->Ordenes_model->getClientes();
        $this->template->loadContent("catalogo/ordenes.php", $data);
    } 
}
?>

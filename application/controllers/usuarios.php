<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 06/02/2015
 * Time: 2:35
 */

class Usuarios extends CI_Controller{


    public function __construct()
    {
        parent::__construct();
        // Su propio código de constructor
        $this->load->model('shop_model');
        $this->datos['categorias']=$this->shop_model->getCategorias();
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(FCPATH.'application/views/templates');
    }

    public function index()
    {
        $this->smarty->assign($this->datos);
        $this->smarty->display('login.tpl');
    }
    public function login()
    {
        $this->smarty->assign($this->datos);
        $this->smarty->display('login.tpl');
    }
    public function registro()
    {
        $this->datos['provincias']=$this->shop_model->getProvincias();
        $this->smarty->assign($this->datos);
        $this->smarty->display('registro.tpl');
    }


}
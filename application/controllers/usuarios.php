<?php

/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 06/02/2015
 * Time: 2:35
 */
class Usuarios extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
        $this->load->library('form_validation');
        $this->datos['categorias'] = $this->shop_model->getCategorias();

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

        $this->datos['provincias'] = $this->shop_model->getProvincias()->result_array();


        if ($this->form_validation->run() == FALSE)
        {
            $this->datos['errores_validacion']=validation_errors();
            $this->smarty->assign($this->datos);
            $this->smarty->display('registro.tpl');
        }
        else
        {
            $this->smarty->assign($this->datos);
            $this->smarty->display('form_correcto.tpl');
        }

    }


}
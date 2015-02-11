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
        $this->load->model('Modelo_usuarios');
        $this->load->library('form_validation');
        $this->load->library('input');
        $this->smarty->assign($this->datos);
    }

    public function index()
    {
        $this->smarty->display('login.tpl');
    }

    public function login()
    {
        $this->smarty->display('login.tpl');
    }

    public function registro()
    {
        $this->datos['provincias'] = $this->Modelo_tienda->getProvincias()->result_array();

        if ($this->form_validation->run() == FALSE)
        {
            $this->datos['errores_validacion']=validation_errors();
            $this->smarty->assign($this->datos);
            $this->smarty->display('registro.tpl');
        }
        else
        {
            $this->Modelo_usuarios->addUser($this->input->post());
            $this->smarty->assign($this->datos);
            $this->smarty->display('form_correcto.tpl');
        }

    }


}
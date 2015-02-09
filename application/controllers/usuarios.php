<?php

/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 06/02/2015
 * Time: 2:35
 */
class Usuarios extends CI_Controller
{

    private $validacion = array(
        array(
            'field' => 'usuario',
            'label' => 'Usuario',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Contaseña',
            'rules' => 'required'
        ),
        array(
            'field' => 'mail',
            'label' => 'Email',
            'rules' => 'required'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'Apellidos',
            'rules' => 'required'
        ),
        array(
            'field' => 'direccion',
            'label' => 'Direccion',
            'rules' => 'required'
        ),
        array(
            'field' => 'provincia',
            'label' => 'Provincia',
            'rules' => 'required'
        ),
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'required'
        ),
        array(
            'field' => 'dni',
            'label' => 'Dni',
            'rules' => 'required'
        ),
        array(
            'field' => 'cp',
            'label' => 'Codigo postal',
            'rules' => 'required'
        )
    );

    public function __construct()
    {
        parent::__construct();
        // Su propio código de constructor
        $this->load->model('shop_model');
        $this->load->library('form_validation');
        $this->datos['categorias'] = $this->shop_model->getCategorias();
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(FCPATH . 'application/views/templates');
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
        $this->form_validation->set_rules($this->validacion);
        $this->datos['errores_validacion']=validation_errors();
        $this->datos['provincias'] = $this->shop_model->getProvincias();
        $this->datos['post']= $_POST;
        if ($this->form_validation->run() == FALSE)
        {
            $this->smarty->assign($this->datos);
            $this->smarty->display('registro.tpl');
        }
        else
        {
            $this->load->view('formsuccess');
        }

    }


}
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
        $this->smarty->assign($this->datos);
    }

    public function index()
    {
        $this->smarty->display('login.tpl');
    }

    public function login()
    {

        if ($this->form_validation->run('login') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
            $this->smarty->assign($this->datos);
            $this->smarty->display('login.tpl');
        }
        else if( !$this->Modelo_usuarios->login($this->input->post()))
        {
            $this->datos['mensaje']='El nombre de usuario y/o la contraseña son incorrectos';
            $this->smarty->assign($this->datos);
            $this->smarty->display('login.tpl');
        }
        else
        {
            $this->datos['mensaje']='Estas dentro hijo puta';
            $this->smarty->assign($this->datos);
            $this->smarty->display('login.tpl');
        }
    }

    public function registro()
    {
        $this->datos['provincias'] = $this->Modelo_tienda->getProvincias()->result_array();

        if ($this->form_validation->run('registro') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
            $this->smarty->assign($this->datos);
            $this->smarty->display('registro.tpl');
        }
        else if($this->Modelo_usuarios->userExist($this->input->post('usuario')))
        {
            $this->datos['mensaje']="Ya existe un usuario con el nombre de usuario ".$this->input->post('usuario').'.';
            $this->smarty->assign($this->datos);
            $this->smarty->display('registro.tpl');
        }
        else
        {
            $this->datos['mensaje']=$this->Modelo_usuarios->addUser($this->input->post());
            $this->smarty->assign($this->datos);
            $this->smarty->display('form_correcto.tpl');
        }


    }


}
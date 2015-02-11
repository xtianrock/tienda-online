<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 11/02/2015
 * Time: 3:06
 */

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(FCPATH . 'application/views/templates');
        // other common stuff; for example you may want a global cart, login/logout, etc.
    }


    function  validarUsuario($input)
    {
        if (preg_match('/^[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ]+[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ@_-]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarUsuario','El campo %s solo puede contener letras, numeros y los caracteres (_ @ - . ª )');
            return FALSE;
        }
    }
    function  validarNombre($input)
    {
        if (preg_match('/^[a-zA-ZüÜáéíóúÁÉÍÓÚñÑ ]+[a-zA-ZüÜáéíóúÁÉÍÓÚñÑª\. ]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarNombre','El campo %s solo puede contener letras, numeros y los caracteres (ª .)');
            return FALSE;
        }
    }
    function  validarDireccion($input)
    {
        if (preg_match('/^[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ ]+[a-zA-Z0-9 üÜáéíóúÁÉÍÓÚñÑºª\/.-]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarDireccion','El campo %s solo puede contener letras, numeros y los caracteres (º ª / . -)');
            return FALSE;
        }
    }
    function  validarCp($input)
    {
        if (preg_match('/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarCp','El campo %s no es valido');
            return FALSE;
        }
    }
    function  validarDni($input)
    {
        if (preg_match('/^\d{8}[-]?[A-Za-z]{1}$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarDni','El campo %s no es valido');
            return FALSE;
        }
    }
    function  validarPassword($input)
    {
        if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ ]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarPassword','El campo %s debe contener al menos una letra y un numero');
            return FALSE;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 11/02/2015
 * Time: 2:36
 */

 $config = array(
    array(
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => 'required|min_length[6]|callback_validarUsuario'
    ),
    array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'required|min_length[6]|callback_validarPassword'
    ),
    array(
        'field' => 'mail',
        'label' => 'Email',
        'rules' => 'valid_email'
    ),
    array(
        'field' => 'apellidos',
        'label' => 'Apellidos',
        'rules' => 'required|callback_validarNombre'
    ),
    array(
        'field' => 'direccion',
        'label' => 'Direccion',
        'rules' => 'required|callback_validarDireccion'
    ),
    array(
        'field' => 'provincia',
        'label' => 'Provincia',
        'rules' => 'required|numeric|less_than[53]|graeter_than[0]'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required|callback_validarNombre'
    ),
    array(
        'field' => 'dni',
        'label' => 'Dni',
        'rules' => 'required|callback_validarDni'
    ),
    array(
        'field' => 'cp',
        'label' => 'Codigo postal',
        'rules' => 'required|numeric|exact_length[5]|callback_validarCp'
    )
);

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
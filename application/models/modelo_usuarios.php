<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 27/01/2015
 * Time: 18:22
 */

class Modelo_usuarios extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function addUser($datos)
    {
        $this->db->set($datos);
        $this->db->set('password',password_hash($datos['password'],PASSWORD_DEFAULT));
        $this->db->set('rol','Usuario');
        $this->db->set('activo','1');
        $this->db->insert('usuario');
        return "El usuario ".$datos['usuario'].' ha sido creado con exito, ahora ya puede autentificarse usando su nombre de usuario y contraseña.';
    }

    public function userExist($user)
    {
        return $this->db->select('usuario')->from('usuario')->where('usuario',$user)->get()->row();
    }

    public function login($datos)
    {
        $datosUsuario=$this->db->select('usuario, password')->from('usuario')->where('usuario',$datos['usuario'])->get()->row();
        if($datosUsuario && password_verify($datos['password'],$datosUsuario->password))
            return TRUE;
        else
            return FALSE;
    }

} 
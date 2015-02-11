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
        if($this->db->select('usuario')->from('usuario')->where('usuario',$datos['usuario'])->get()->row())
        {
            echo 'ya existe ese usuario';
        }
        else
        {
            $this->db->set($datos);
            $this->db->set('rol','Usuario');
            $this->db->set('activo','1');
            $this->db->insert('usuario');
        }
    }

} 
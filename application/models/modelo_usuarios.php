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
    public function alterUser($datos,$usuario)
    {
        print_r($datos);
        $this->db->where('usuario',$usuario);
        $this->db->update('usuario',$datos);
        return "El usuario ".$usuario.' ha sido modificado con exito.';
    }

    public function getUserByName($name)
    {
        return $this->db->from('usuario')->where('usuario',$name)->get()->row();
    }
    public function getUserById($id)
    {
        return $this->db->from('usuario')->where('id_usuario',$id)->get()->row();
    }
    public function getUserByMail($mail)
    {
        return $this->db->from('usuario')->where('mail',$mail)->get()->row();
    }

    public function addReset($datos)
    {
        $this->db->set($datos);
        $this->db->insert('reset_password');
    }

    public function getReset($token)
    {
        return $this->db->from('reset_password')->where('token',$token)->get()->row();
    }

    public function login($datos)
    {
        $datosUsuario=$this->db->select('usuario, password')->from('usuario')->where('usuario',$datos['usuario'])->get()->row();
        if($datosUsuario && password_verify($datos['password'],$datosUsuario->password))
            return TRUE;
        else
            return FALSE;
    }
        public function getNombreProvincia($id)
    {
        return $this->db->from('provincias')->where('id_provincia',$id)->get()->row()->nombre_provincia;
    }

    public function resetPassword($idUsuario,$password)
    {
        /*
         * con este codigo creo el evento que se ejecutará cada 12 horas eliminando los links que tengan mas d eun dia de antiguaedad
         *
         CREATE EVENT eliminaLinks
         ON SCHEDULE EVERY 12 HOUR
         do
         DELETE FROM reset_password WHERE fecha <= DATE_SUB(CURTIME(), INTERVAL 1 DAY)
         */
        $data = array(
            'password' => password_hash($password,PASSWORD_DEFAULT)
        );

        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $data);
    }

} 
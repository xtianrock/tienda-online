<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 27/01/2015
 * Time: 18:22
 */
class Shop_model extends CI_Model{

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function obtenerDestacados()
    {
        $productos=array();
        $resultados=$this->db->get('destacado');
        foreach ($resultados->result() as $elemento)
        {
            $producto=$this->db->select('*')->from('productos')->where('id_producto',$elemento->productos_id_producto)->get();
            $productos[]=$producto->row();
        }
        return $productos;
    }

    public function obtenerProductos()
    {
        return $this->db->get('productos');
    }

    public function obtenerCategorias()
    {
      return $this->db->select('nombre_cat')->from('categoria')->get();

    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // por favor leer la nota de abajo
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id', $_POST['id']));
    }

}
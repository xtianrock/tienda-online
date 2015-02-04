<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 27/01/2015
 * Time: 18:22
 */
class Shop_model extends CI_Model{


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

    public function obtenerProductos($categoria=null)
    {
       return $this->db->from('productos')->where('categoria_id_cat',$categoria)->get();
    }

    public function nombreCategoria($categoria=null)
    {
        return $this->db->select('nombre_cat')->from('categoria')->where('id_cat',$categoria)->get()->row();
    }

    public function obtenerCategorias()
    {
      return $this->db->from('categoria')->get();

    }



}
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

    public function getDestacados()
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

    public function getProductos($categoria=null)
    {
       return $this->db->from('productos')->where('categoria_id_cat',$categoria)->get();
    }

    public function getNombreCategoria($categoria=null)
    {
        return $this->db->select('nombre_cat')->from('categoria')->where('id_cat',$categoria)->get()->row();
    }

    public function getCategorias()
    {
      return $this->db->from('categoria')->get();

    }
    public function getProvincias()
    {
        return $this->db->from('provincias')->get();
    }



}
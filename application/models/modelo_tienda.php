<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 27/01/2015
 * Time: 18:22
 */
class modelo_tienda extends CI_Model{


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

    public function getProducto($id_producto)
    {
        return $this->db->from('productos')->where('id_producto',$id_producto)->get()->row();
    }

    public function getProductos($categoria=null)
    {
        if($categoria)
        {
            return $this->db->from('productos')->where('categoria_id_cat',$categoria)->get();
        }
        else
        {
            return $this->db->from('productos')->get();
        }
    }

    public function getNombreCategoria($categoria)
    {
        return $this->db->select('nombre_cat')->from('categoria')->where('id_cat',$categoria)->get()->row()->nombre_cat;
    }

    public function getCatByName($categoria)
    {
        return $this->db->select('id_cat')->from('categoria')->where('nombre_cat',$categoria)->get()->row()->id_cat;
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
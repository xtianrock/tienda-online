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
        $this->db->from('productos');
        $this->db->join('destacado', 'productos_id_producto= id_producto');
        $this->db->join('categoria', 'id_cat= categoria_id_cat');
        return $this->db->get()->result();
    }
    public function countProductos($categoria)
    {
        if($categoria==0)
        {
            return $this->db->from('productos')->count_all_results();
        }
        else
        {
            return $this->db->from('productos')->where('categoria_id_cat',$categoria)->count_all_results();
        }

    }

    public function getProducto($id_producto)
    {
        return $this->db->from('productos')->where('id_producto',$id_producto)->get()->row();
    }

    public function getProductos($categoria,$inicio=0,$elementos=99999)
    {
        if($categoria==0)
        {
            return $this->db->from('productos')->limit($elementos,$inicio)->get()->result();
        }
        else
        {
            return $this->db->from('productos')->where('categoria_id_cat',$categoria)->limit($elementos,$inicio)->get()->result();         
        }
    }

    public function getNombreCategoria($categoria)
    {
        return $this->db->from('categoria')->where('id_cat',$categoria)->get()->row()->nombre_cat;
    }
    public function getCategoriaProducto($id_producto)
    {
        return $this->db->from('productos')->where('id_producto',$id_producto)->get()->row()->categoria_id_cat;
    }

    public function getCatByName($categoria)
    {
        return $this->db->from('categoria')->where('nombre_cat',$categoria)->get()->row();
    }
    public function getCategorias()
    {
      return $this->db->from('categoria')->get()->result();

    }
    public function getProvincias()
    {
        return $this->db->from('provincias')->get()->result_array();
    }
    public function getNombreProvincia($id)
    {
        return $this->db->from('provincias')->where('id_provincia',$id)->get()->row()->nombre_provincia;
    }

    public function actualizarStock($datos,$condicion)
    {
        $this->db->update_batch('productos', $datos, $condicion);
    }

    public function getStock()
    {
        return $this->db->select('id_producto,stock')->from('productos')->get()->result();
    }
    public function getStockById($id)
    {
        return $this->db->select('stock')->from('productos')->where('id_producto',$id)->get()->row()->stock;
    }

    public function addProducto($datos)
    {
        $this->db->insert('productos', $datos);
    }

    public function addCategoria($datos)
    {
        $this->db->insert('categoria', $datos);
    }



}
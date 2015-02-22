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
            return $this->db->from('productos')->where('categoria_id_cat',$categoria)->get()->result();
        }
        else
        {
            return $this->db->from('productos')->get();
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
        return $this->db->from('categoria')->where('nombre_cat',$categoria)->get()->row()->id_cat;
    }
    public function getCategorias()
    {
      return $this->db->from('categoria')->get();

    }
    public function getProvincias()
    {
        return $this->db->from('provincias')->get();
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



}
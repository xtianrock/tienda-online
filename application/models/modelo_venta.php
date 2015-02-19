<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 27/01/2015
 * Time: 18:22
 */
class modelo_venta extends CI_Model{


    function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

   public function getPedido($id)
   {
      return $this->db->from('pedido')->where('id_pedido',$id)->get()->row_array();
   }

    public function getLineaPedido($id)
    {
        return $this->db->from('linea_pedido')->where('pedido_id_pedido',$id)->get()->result();
    }

    public function addPedido($datos)
    {
        $this->db->set($datos);
        $this->db->set('estado','pendiente');
        $this->db->insert('pedido');
        return 'la compra se ha realizado con exito';
    }

    public function addLineaPedido($datos)
    {
        $this->db->insert_batch('linea_pedido', $datos);
        return 'la compra se ha realizado con exito';
    }



}
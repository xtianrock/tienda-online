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



}
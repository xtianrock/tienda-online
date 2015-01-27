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
        $resultados=$this->db->get('destacado');

      /*  echo '<table border="1">';
        foreach ($resultados->result() as $fila)
        {
            echo '<tr>';
            echo '<td>'.$fila->productos_id_producto.'</td>';
            echo '<td>'.$fila->productos_categoria_id_cat.'</td>';
            echo '</tr>';
        }
        echo '</table>';*/
        return $resultados;
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
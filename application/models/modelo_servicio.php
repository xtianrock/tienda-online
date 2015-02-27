<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 26/02/2015
 * Time: 3:05
 */

class Modelo_servicio extends CI_Model
{

    private $fileName;

    private $xmlProductos;

    public function __construct() {
        parent::__construct();
        $this->load->database('default');
    }

    /**
     * Carga los datos de la tienda seleccionada
     * @param type $nombreTienda
     */
    public function Load($nombreTienda)
    {
        // Guardaremos la información en un fichero en formato JSON
        $this->fileName=__DIR__.'/'.$nombreTienda.'.xml';

        $this->xmlProductos=
            new SimpleXMLElement(file_get_contents($this->fileName));

    }

    public function Total()
    {
        return $this->db->count_all_results('destacado');
    }

    /**
     * Devuelve la lista de productos, desde la posición indicada
     * @param type $offset  Desplazamiento desde el inicio
     * @param type $limit   Nº de productos a devolver
     * @return type
     */
    public function Lista($offset, $limit)
    {
       return $destacados = $this->db->from('destacado')->limit($limit, $offset)->get()->result();

    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(APPPATH.'/libraries/JSON_WebServer_Controller.php');
class Servicio extends JSON_WebServer_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Modelo_servicio');
		//$this->Modelo_servicio->Load('productos_tienda01');

		// Registramos funciones disponibles
		$this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
		$this->RegisterFunction('Lista(offset, limit)',
			'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
	}

	public function Total()
	{
		return $this->Modelo_servicio->Total();
	}

	public function Lista($offset, $limit)
	{
		$destacados=$this->Modelo_servicio->Lista($offset, $limit);
		foreach ($destacados as $destacado) {
			$producto = $this->db->select('id_producto,nombre_producto,descripcion,precio_producto,imagen_producto')->from('productos')->where('id_producto', $destacado->productos_id_producto)->get()->row();
			$categoria = $this->db->select('nombre_cat')->from('categoria')->where('id_cat', $destacado->productos_categoria_id_cat)->get()->row();
			$listaProductosDevolver[] = array(
				'nombre' => $producto->nombre_producto,
				'descripcion' => $producto->descripcion,
				'precio' => $producto->precio_producto,
				'img' => BASEURL.'/assets/img/'.$producto->imagen_producto,
				'url' => BASEURL . 'index.php/main/producto/'.$categoria->nombre_cat.'/'.$producto->id_producto
			);
		}
		return $listaProductosDevolver;
	}


	/**
	 * Función que se utilizará para hacer pruebas, sobre funicionamiento
	 */
	public function Prueba($offset, $limit)
	{
		echo "<pre>";
		print_r($this->Modelo_servicio->Lista((int)$offset,(int) $limit));
		echo "</pre>";
	}

	public function Producto($producto_id)
	{
		echo "<h1>Compra de producto ....</h1><p>Ha decidido comprar el producto $producto_id</p>";
	}
}

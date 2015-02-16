<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 21/01/2015
 * Time: 16:36
 */

class Main extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->datos['destacados']=$this->Modelo_tienda->getDestacados();
        $this->smarty->assign($this->datos);
    }

    public function index()
    {
        $this->datos['titulo'] ='Home';
        $this->smarty->assign($this->datos);
        $this->smarty->display('home.tpl');
    }
    public function productos($categoria,$idProducto=null)
    {
        if($idProducto)
        {
            $this->datos['producto'] = $this->Modelo_tienda->getProducto($idProducto);
            $this->datos['titulo'] =  $this->datos['producto']->nombre_producto;
            $this->smarty->assign($this->datos);
            $this->smarty->display('detalles.tpl');
        }
        else
        {
            $idCategoria=$this->Modelo_tienda->getCatByName($categoria);
            $this->datos['agregado_carrito']=$this->session->flashdata('agregado');
            $this->datos['uri']= $this->uri->uri_string();
            $this->datos['categoria']=$categoria;
            $this->datos['productos'] = $this->Modelo_tienda->getProductos($idCategoria);
            $this->datos['titulo'] =str_replace('_',' ',$categoria);
            $this->smarty->assign($this->datos);
            $this->smarty->display('productos.tpl');
        }
    }

    public function carrito()
    {
        $this->datos['titulo']='Carrito';
        $this->datos['articulos']=$this->cart->contents();
        echo '<pre>';
        print_r($this->session->userdata('usuario'));
        echo '</pre>';
        $this->datos['total']=$this->cart->total();
        $this->smarty->assign($this->datos);
        $this->smarty->display('carrito.tpl');
    }

    public function addProduct()
    {

        $id_producto = $this->input->post('id_producto');
        $producto = $this->Modelo_tienda->getProducto($id_producto);
        $cantidad = 1;
        //obtenemos el contenido del carrito
        $carrito = $this->cart->contents();

        foreach ($carrito as $item) {
            //si el id del producto es igual que uno que ya tengamos
            //en la cesta le sumamos uno a la cantidad
            if ($item['id'] == $id_producto) {
                $cantidad = 1 + $item['qty'];
            }
        }
        //cogemos los productos en un array para insertarlos en el carrito
        $datos = array(
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto->precio_producto,
            'name' => $producto->nombre_producto
        );

        //insertamos al carrito
        $this->cart->insert($datos);
        //redirigimos mostrando un mensaje con las sesiones flashdata
        //de codeigniter confirmando que hemos agregado el producto
        $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
        echo '<pre>';
        print_r($this->cart->contents());
        echo '</pre>';
        redirect( $_POST['uri'], 'refresh');

    }


} 
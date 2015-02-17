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
            $this->datos['titulo'] =$categoria;
            $this->smarty->assign($this->datos);
            $this->smarty->display('productos.tpl');
        }
    }

    public function carrito()
    {
        if($this->input->post())  //Modifico las cantidades de los articulos
        {
            foreach ($this->input->post() as $id=>$cantidad)
            {
                $data[]=array(
                    'rowid'=>$id,
                    'qty'=>$cantidad
                );
            }
            $this->cart->update($data);
        }
        $this->datos['titulo']='Carrito';
        $this->datos['articulos']=$this->cart->contents();
        $this->datos['total']=$this->cart->total();
        $this->smarty->assign($this->datos);
        $this->smarty->display('carrito.tpl');
    }

    public function addProduct()
    {
        $id_producto = $this->input->post('id_producto');
        $producto = $this->Modelo_tienda->getProducto($id_producto);
        $cantidad =  $this->input->post('cantidad');
        $carrito = $this->cart->contents();
        foreach ($carrito as $item) {           //si el id del producto es igual que uno que ya
            if ($item['id'] == $id_producto) {  //tengamos en la cesta le sumamos uno a la cantidad
                $cantidad = 1 + $item['qty'];
            }
        }
        //Meto los productos en un array para insertarlos en el carrito
        $datos = array(
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto->precio_producto,
            'name' => $producto->nombre_producto
        );
        $this->cart->insert($datos);
        $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
       // redirect( $_POST['uri'], 'refresh');
    }

    public function compra()
    {
        if(!$this->session->userdata('logueado'))
        {
            $this->session->set_flashdata('requiere_login','Es necesario que inicie sesión para continuar con el proceso de compra');
            redirect('usuarios/login');
        }
        else
        {
            $this->datos['cliente']=$this->Modelo_usuarios->obtenerUsuario($this->session->userdata('usuario'));
            $this->datos['provincia']=$this->Modelo_tienda->getNombreProvincia($this->datos['cliente']->provincias_id_provincia);
            $this->datos['articulos']=$this->cart->contents();
            $this->datos['total']=$this->cart->total();
            $this->datos['titulo']='Resumen de compra';
            $this->smarty->assign($this->datos);
            $this->smarty->display('resumen_compra.tpl');
        }
    }


} 
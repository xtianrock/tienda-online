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
        $this->load->helper('stock');
    }

    public function index()
    {
        $this->datos['titulo'] ='Home';
        $this->smarty->assign($this->datos);
        $this->smarty->display('home.tpl');
    }
    public function productos($categoria)
    {
            $this->datos['uri']= $this->uri->uri_string();
            $idCategoria=$this->Modelo_tienda->getCatByName($categoria)->id_cat;
            $this->datos['agregado_carrito']=$this->session->flashdata('agregado');
            $this->datos['categoria']=$categoria;
            //recupero los productos de la base de datos,
            // y actualizo su stock mediante el uso de la funcion muestraStock contenida en el stock_helper
            $this->datos['productos'] =stockUpdate($this->cart->contents(),$this->Modelo_tienda->getProductos($idCategoria));
            $this->datos['titulo'] =$categoria;

            $config['base_url'] = site_url('main/productos/'.$this->Modelo_tienda->getCatByName($categoria)->nombre_cat);
            $config['total_rows'] = sizeof($this->datos['productos']);
            $config['per_page'] =5;


            /* Initialize the pagination library with the config array */
            $this->pagination->initialize($config);

            $this->datos['paginador'] = $this->pagination->create_links();

            $this->smarty->assign($this->datos);
            $this->smarty->display('productos.tpl');
    }

    public function producto($categoria,$idProducto)
    {
        $this->datos['uri']= $this->uri->uri_string();
        $this->datos['producto'] =stockUpdate($this->cart->contents(),$this->Modelo_tienda->getProducto($idProducto));
        $this->datos['cantidad'] = $this->Modelo_tienda->getProducto($idProducto);
        $this->datos['titulo'] =  $this->datos['producto']->nombre_producto;
        $this->smarty->assign($this->datos);
        $this->smarty->display('detalles.tpl');
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
            if ($item['id'] == $id_producto) {  //tengamos en la cesta le sumamos la cantidad
               $cantidad+=$item['qty'];
                break;
            }
        }
        $datos = array(
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto->precio_producto,
            'name' => $producto->nombre_producto,
            'stock'=>$producto->stock
        );
        $this->cart->insert($datos);
        $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
        redirect( $_POST['uri'], 'refresh');
    }




} 
<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 21/01/2015
 * Time: 16:36
 */

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->datos['categorias'] = $this->Modelo_tienda->getCategorias();
        //Si el usuario no ha iniciado sesion sera tratado como invitado.
        if($this->session->userdata('usuario'))
        {
            $this->datos['session']=$this->session->userdata('usuario');
        }
        else
        {
            $this->datos['session']='Invitado';
        }
        $this->datos['contenido_carrito']=$this->cart->total_items();
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(FCPATH . 'application/views/templates');
        $this->smarty->assign($this->datos);
        $this->load->helper('stock');
    }

    public function index()
    {
        $this->datos['titulo'] ='Home';
        $this->datos['destacados']=$this->Modelo_tienda->getDestacados();
        $this->smarty->assign($this->datos);
        $this->smarty->display('home.tpl');
    }
    public function categorias($categoria,$inicio=0)
    {
            $articulosPagina=3;
            $this->datos['uri']= $this->uri->uri_string();
            $idCategoria=$this->Modelo_tienda->getCatByName($categoria)->id_cat;
            $this->datos['agregado_carrito']=$this->session->flashdata('agregado');
            $this->datos['categoria']=$categoria;
            //recupero los productos de la base de datos,
            // y actualizo su stock mediante el uso de la funcion muestraStock contenida en el stock_helper
            $totalProductos =$this->Modelo_tienda->countProductos($idCategoria);
            $this->datos['productos'] =stockUpdate($this->cart->contents(),$this->Modelo_tienda->getProductos($idCategoria,$inicio,$articulosPagina));
            $this->datos['titulo'] =$categoria;


            $config['base_url'] = BASEURL.'index.php/main/categorias/'.$this->Modelo_tienda->getCatByName($categoria)->nombre_cat;
            $config['total_rows'] = $totalProductos;
            $config['per_page'] =$articulosPagina;
            $config['uri_segment'] =4;


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
        redirect( BASEURL.'index.php/'.$_POST['uri'], 'refresh');
    }


    public function xml($accion)
    {
        if ($accion=='exportar')
        {

            $productos=$this->Modelo_tienda->getProductos(0);
            $categorias=$this->Modelo_tienda->getCategorias();
            //Con esto lo exportamos, basicamente creamos un string en lenguaje xml y lo guardamos en un fichero.
            $this->exportar('productos',$productos,'producto');
            $this->exportar('categoria',$categorias,'categoria');
            $this->datos['mensaje']='los productos y categorias han sido correctamente exportados';
            $this->datos['enlaces']=TRUE;
        }
        else if($accion=='importar')
        {
            //Con esto otro cargamos el fichero y lo convertimos en un objeto simpleXml
            $productos=simplexml_load_file("productos.xml");
            $categorias=simplexml_load_file("categoria.xml");
            foreach ($categorias as $categoria)
            {
                unset($categoria->id_cat);
                $this->Modelo_tienda->addCategoria($categoria);
            }
            foreach ($productos as $producto)
            {
                unset($producto->id_producto);
                $this->Modelo_tienda->addProducto($producto);
            }
            $this->datos['mensaje']='los productos y categorias han sido correctamente importados';
        }
        $this->datos['titulo']='XML';
        $this->smarty->assign($this->datos);
        $this->smarty->display('xml.tpl');
    }

    public function ver_xml($archivo)
    {
        header('Content-Type: text/xml');
        readfile($archivo);
    }


    private function exportar($tabla,$datos,$nombreElemento)
    {
        $xml= "<?xml version=\"1.0\" ?>";
        $xml.='<'.$tabla.'>';
        foreach ($datos as $dato)
        {
            $xml.='<'.$nombreElemento.'>';
            foreach ($dato as $campo=>$valorCampo)
            {
                $xml.='<'.$campo.'>'.utf8_encode($valorCampo).'</'.$campo.'>';
            }
            $xml.='</'.$nombreElemento.'>';
        }
        $xml.='</'.$tabla.'>';
        file_put_contents($tabla.".xml",$xml);
        //header('Content-Type: text/xml');
        //readfile($tabla.'.xml');


    }




} 
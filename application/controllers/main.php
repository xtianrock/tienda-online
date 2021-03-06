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

    /**
     * Será la entrada de nuestra tienda, en ella s emostraran los productos destacados
     */
    public function index()
    {
        $this->datos['titulo'] ='Home';
        $this->datos['destacados']=$this->Modelo_tienda->getDestacados();
        $this->smarty->assign($this->datos);
        $this->smarty->display('home.tpl');
    }

    /**
     * Muestra los productos ordenados por categorias y los pagina
     *
     * @param $categoria categoria a mostrar
     * @param int $inicio nº de elementos que debe mostrar el paginador
     */
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

            $this->pagination->initialize($config);
            $this->datos['paginador'] = $this->pagination->create_links();
            $this->smarty->assign($this->datos);
            $this->smarty->display('productos.tpl');
    }


    /**
     * Muestra los detalles del producto.
     *
     * @param $categoria No hace nada, solo muestra informacion en la url.
     * @param $idProducto producto amostrar
     */
    public function producto($categoria,$idProducto)
    {
        $this->datos['uri']= $this->uri->uri_string();
        $this->datos['producto'] =stockUpdate($this->cart->contents(),$this->Modelo_tienda->getProducto($idProducto));
        $this->datos['cantidad'] = $this->Modelo_tienda->getProducto($idProducto);
        $this->datos['titulo'] =  $this->datos['producto']->nombre_producto;
        $this->smarty->assign($this->datos);
        $this->smarty->display('detalles.tpl');
    }


    /**
     * Muestra el contenido del carrito
     */
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


    /**
     * Añade el producto recibido por post al carrito
     */
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


    /**
     * Permite exportar tanto las categorias como los productos a formato xml
     */
    public function exportar()
    {

        $productos=$this->Modelo_tienda->getProductos(0);
        $categorias=$this->Modelo_tienda->getCategorias();
        //Con esto lo exportamos, basicamente creamos un string en lenguaje xml y lo guardamos en un fichero.
        $this->exportarDatos('productos',$productos,'producto');
        $this->exportarDatos('categoria',$categorias,'categoria');
        $this->datos['mensaje']='los productos y categorias han sido correctamente exportados';
        $this->datos['enlaces']=TRUE;
        $this->datos['titulo']='XML';
        $this->datos['ruta']= FCPATH;
        $this->smarty->assign($this->datos);
        $this->smarty->display('xml-resultado.tpl');
    }

    /**
     * Permite la importacion de las categorias y los productos desde archivos en formato xml
     */
    public function importar()
    {
        $this->datos['productos_importados']=$this->session->flashdata('productos_importados');
        $this->datos['categorias_importadas']=$this->session->flashdata('categorias_importadas');
        $this->datos['enlaces']=FALSE;
        $this->datos['titulo']='XML';
        $this->smarty->assign($this->datos);
        $this->smarty->display('xml-resultado.tpl');
    }


    /**
     * permite ver un xml exportado.
     *
     * @param $archivo nombre del archivo que se abrir (productos o categorias)
     */
    public function ver_xml($archivo)
    {
        header('Content-Type: text/xml');
        readfile($archivo);
    }

    /**
     * Permite descargar el archivo xml
     *
     * @param $archivo  nombre del archivo que se abrir (productos o categorias)
     */
    public function descargar_xml($archivo)
    {
        header("Content-disposition: attachment; filename=$archivo");
        header("Content-type: application/octet-stream");
        readfile($archivo);
    }


    /**
     * Se encarga de exportar los datos de la base de datos a formato xml.
     *
     * @param $tabla tabla que se exporta
     * @param $datos  Conjuntos de datos devueltos por la consulta sql
     * @param $nombreElemento nombre que s ele dara al archivo
     */
    private function exportarDatos($tabla,$datos,$nombreElemento)
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
    }

    /**
     *Se encarga de realizar la importacion desde los ficheros subidos al servidor
     */
    public function importarDatos()
    {
        if(isset($_FILES['productos']))
        {
            if ( is_uploaded_file($_FILES['productos']['tmp_name']) )
            {
                echo 'El archivo se ha subido con éxito';
                $origen = $_FILES['productos']['tmp_name'];
                $destino = 'productos.xml';
                move_uploaded_file($origen, $destino);
                $productos=simplexml_load_file("productos.xml");
                foreach ($productos as $producto)
                {
                    unset($producto->id_producto);
                    $this->Modelo_tienda->addProducto($producto);
                }
                $this->session->set_flashdata('productos_importados', 'Los productos fueron correctamente imortados');
            }
        }
        if(isset($_FILES['categorias'])) {
            if (is_uploaded_file($_FILES['categorias']['tmp_name'])) {
                echo 'El archivo se ha subido con éxito';
                $origen = $_FILES['categorias']['tmp_name'];
                $destino = 'categoria.xml';
                move_uploaded_file($origen, $destino);
                $categorias=simplexml_load_file("categoria.xml");
                foreach ($categorias as $categoria)
                {
                    unset($categoria->id_cat);
                    $this->Modelo_tienda->addCategoria($categoria);
                }
                $this->session->set_flashdata('categorias_importadas', 'Las categorias fueron correctamente imortadas');

            }
        }
        redirect( BASEURL.'index.php/main/importar', 'refresh');
    }

} 
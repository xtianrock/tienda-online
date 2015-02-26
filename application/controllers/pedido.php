<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 17/02/2015
 * Time: 20:29
 */



class Pedido extends CI_Controller {

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
        $this->load->library('pdf');
        $this->load->helper('stock');
    }

    public function procesarCompra()
    {
        $datosStock=array();
        $datosLinea=array();
        if (!$this->cart->contents())
        {
           $this->session->set_flashdata('carrito_vacio','El carrito está vacio');
            redirect(BASEURL.'index.php/pedido/resumenCompra');
        }
        elseif($articulosSinStock=stockCheck($this->cart->contents(),$this->Modelo_tienda->getStock()))
        {
            $this->session->set_flashdata('sin_stock','Los siguientes articulos carecen de stock suficiente: '.implode(", ",$articulosSinStock));
            redirect(BASEURL.'index.php/pedido/resumenCompra');

        }
        else
        {
            //Genero el array con los datos que le pasaremos a la funcion insertar pedido.
            $usuario=$this->Modelo_usuarios->getUserByName($this->session->userdata('usuario'));
            $datosPedido=array(
                'cantidad'=> $this->cart->total_items(),
                'importe'=>$this->cart->total(),
                'fecha_pedido'=>date('Y-m-d'),
                'usuario_id_usuario'=>$usuario->id_usuario,
                'nombre'=>$usuario->nombre,
                'apellidos'=>$usuario->apellidos,
                'mail'=>$usuario->mail,
                'dni'=>$usuario->dni,
                'direccion'=>$usuario->direccion,
                'cp'=>$usuario->cp,
            );
            //añado el pedido
            $this->Modelo_venta->addPedido($datosPedido);
            $idPedido=$this->db->insert_id();
            foreach ($this->cart->contents() as $articulo)
            {
                //Guardo los datos en un array que usaré para insertar las lineas mediante insert_batch
                $datosLinea[]=array(
                    'productos_id_producto'=>$articulo['id'],
                    'productos_categoria_id_cat'=>$this->Modelo_tienda->getCategoriaProducto($articulo['id']),
                    'pedido_id_pedido'=>$idPedido,
                    'cantidad'=>$articulo['qty'],
                    'precio'=>$articulo['price'],
                    'subtotal'=>$articulo['subtotal']
                );
                $stock=$this->Modelo_tienda->getStockById($articulo['id']);
                $stock-=$articulo['qty'];
                //Guardo los datos en un array que usaré para actualizar el stock mediante update_batch
                $datosStock[] = array(
                    'id_producto' => $articulo['id'] ,
                    'stock' => $stock
                );
            }
            $this->Modelo_venta->addLineaPedido($datosLinea);
            $this->Modelo_tienda->actualizarStock($datosStock,'id_producto');
            $this->cart->destroy();
            redirect(BASEURL.'index.php/pedido/factura/'.$idPedido);
        }
    }

    public function correo($idPedido)
    {
        $datospedido=$this->Modelo_venta->getPedido($idPedido);
        $this->email->initialize();
        $this->email->from('xtianrock89@gmail.com', 'Prueba Autom�tica desde CI');
        $this->email->to($datospedido->mail);
        $this->email->attach('Factura_pedido_'.$datospedido->id_pedido.'.pdf');
        $this->email->cc('xtianrock89@gmail.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Factura');
        $this->email->message('Gracias por depositar su confianza en nosotros.');
        if ( $this->email->send() )
        {
            echo "<pre>\n\nENVIADO CON EXITO\n</pre>";
        }
        else
        {
            echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
        }
        echo $this->email->print_debugger();
    }

    public function factura($idPedido)
    {
        $datosEmpresa=Array(
            'nombre'=>'Mtg Store S.L.',
            'dni'=>'B-01234567',
            'mail'=>'MtgStore.com',
            'direccion'=>'Avd Francisco Rojas nº132',
            'cp'=>'21465'
        );
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        $pdf->SetLineWidth(0.5);
        $pdf->SetFillColor(192);
        $datospedido=$this->Modelo_venta->getPedido($idPedido);
        $lineaspedido=$this->Modelo_venta->getLineaPedido($idPedido);
        $pdf->datosVendedor(15,40,$datosEmpresa);
        $pdf->datoscliente(105,40,$datospedido);
        $pdf->datosfactura(15,100,$datospedido);
        $pdf->resumen(15,120,sizeof($lineaspedido),$datospedido->importe);


        $i=0;
        foreach ($lineaspedido as $linea)
        {
            $datosProducto=$this->Modelo_tienda->getProducto($linea->productos_id_producto);

            $pdf->lineapedido('130'+$i*10,$datosProducto,$linea);
            $i++;
        }

        $pdf->Output('Factura_pedido_'.$idPedido.'.pdf','F');
        redirect(BASEURL.'index.php/pedido/correo/'.$idPedido);
    }

    public function resumenCompra()
    {
        if(!$this->session->userdata('logueado'))
        {
            $this->session->set_flashdata('requiere_login','Es necesario que inicie sesión para continuar con el proceso de compra');
            redirect(BASEURL.'index.php/usuarios/login/compra');
        }
        else
        {
            if($this->session->flashdata('carrito_vacio'))
                $this->datos['mensaje']=$this->session->flashdata('carrito_vacio');
            else
                $this->datos['mensaje']=$this->session->flashdata('sin_stock');

            $this->datos['cliente']=$this->Modelo_usuarios->getUserByName($this->session->userdata('usuario'));
            $this->datos['provincia']=$this->Modelo_tienda->getNombreProvincia($this->datos['cliente']->provincias_id_provincia);
            $this->datos['articulos']=$this->cart->contents();
            $this->datos['total']=$this->cart->total();
            $this->datos['titulo']='Resumen de compra';
            $this->smarty->assign($this->datos);
            $this->smarty->display('resumen_compra.tpl');
        }
    }

}
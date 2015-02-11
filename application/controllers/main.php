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
        $this->smarty->display('home.tpl');
    }
    public function categoria($idCategoria)
    {
        $this->datos['productos']=$this->Modelo_tienda->getProductos($idCategoria);
        $this->datos['categoria']=$this->Modelo_tienda->getNombreCategoria($idCategoria);
        $this->smarty->assign($this->datos);
        $this->smarty->display('productos.tpl');
    }


} 
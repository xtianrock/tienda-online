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
        // Su propio código de constructor
        $this->load->model('shop_model');
        $this->datos['destacados']=$this->shop_model->getDestacados();
        $this->datos['categorias']=$this->shop_model->getCategorias();

    }

    public function index()
    {
        $this->smarty->assign($this->datos);
        $this->smarty->display('home.tpl');
    }
    public function categoria($idCategoria)
    {
        $this->datos['productos']=$this->shop_model->getProductos($idCategoria);
        $this->datos['categoria']=$this->shop_model->getNombreCategoria($idCategoria);
        $this->smarty->assign($this->datos);
        $this->smarty->display('productos.tpl');
    }
    public function login()
    {
        $this->smarty->assign($this->datos);
        $this->smarty->display('login.tpl');
    }

} 
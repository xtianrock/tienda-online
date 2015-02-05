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
        // Su propio código de constructor
        $this->load->model('shop_model');
        $this->datos['destacados']=$this->shop_model->obtenerDestacados();
        $this->datos['categorias']=$this->shop_model->obtenerCategorias();
    }

    public function index()
    {
        $smarty = new Smarty;
        $smarty->assign($this->datos);
        $smarty->setTemplateDir(FCPATH.'application/views/templates');

        $smarty->display('home.tpl');


       // $this->templates->load('template_tienda', 'home', $this->datos);
    }
    public function categoria($idCategoria)
    {

        $this->datos['productos']=$this->shop_model->obtenerProductos($idCategoria);
        $this->datos['categoria']=$this->shop_model->nombreCategoria($idCategoria);


        $smarty = new Smarty;
        $smarty->assign($this->datos);
        $smarty->setTemplateDir(FCPATH.'application/views/templates');
        $smarty->display('home.tpl');
        //$this->templates->load('template_tienda', 'productos', $this->datos);
    }

} 
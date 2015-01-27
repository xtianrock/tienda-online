<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 21/01/2015
 * Time: 16:36
 */

class ControladorFrontal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Su propio código de constructor
        $this->load->model('shop_model');
    }

    public function index()
    {
        $datos['destacados']=$this->shop_model->obtenerDestacados();

        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('content',$datos);
        $this->load->view('footer');
    }

} 
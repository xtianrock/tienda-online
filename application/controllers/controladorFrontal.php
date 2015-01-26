<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 21/01/2015
 * Time: 16:36
 */

class ControladorFrontal extends CI_Controller {


    public function index()
    {
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('content');
        $this->load->view('footer');
    }

} 
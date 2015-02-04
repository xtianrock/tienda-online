<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 04/02/2015
 * Time: 2:26
 */

$this->load->view('header');
$this->load->view('menu',$categorias);
$this->load->view('destacados',$destacados);
echo $body;
$this->load->view('footer');
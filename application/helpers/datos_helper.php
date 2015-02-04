<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 04/02/2015
 * Time: 2:02
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cargaDatos'))
{
    function cargaDatos()
    {
        $datos['destacados']=$this->shop_model->obtenerDestacados();
        $datos['categorias']=$this->shop_model->obtenerCategorias();
        return $datos;
    }
}


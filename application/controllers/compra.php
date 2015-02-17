<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 17/02/2015
 * Time: 20:29
 */



class Compra extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {

    }

    public function correo()
    {
        $this->load->library('email');
        $this->email->initialize();
        $this->email->from('xtianrock89@gmail.com', 'Prueba Autom�tica desde CI');
        $this->email->to('saraalamillo93@gmail.com');
        $this->email->cc('xtianrock89@gmail.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Factura');
        $this->email->message('Mensaje de prueba.');
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

}
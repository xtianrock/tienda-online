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
        $this->load->library('pdf');
        $this->load->library('email');
    }

    public function index()
    {

    }

    public function correo()
    {

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

    public function factura()
    {
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);

        $pdf->SetLineWidth(0.5);
        $pdf->SetFillColor(192);
        $pdf->RoundedRect(15, 40, 85, 50, 3.5, 'DF');
        $pdf->SetXY(20,30);
        $pdf->Cell(20,10,'Datos Vendedor:',0,1);
        $pdf->Line(21,37,49,37);
        $pdf->SetXY(20,40);
        $pdf->Cell(20,10,'Mtg Store S.L.',0,1);
        $pdf->SetXY(20,50);
        $pdf->Cell(20,10,'B-01234567',0,1);
        $pdf->SetXY(20,60);
        $pdf->Cell(20,10,'MtgStore.com',0,1);
        $pdf->SetXY(20,70);
        $pdf->Cell(20,10,'Avd Francisco Rojas nº132',0,1);
        $pdf->SetXY(20,80);
        $pdf->Cell(20,10,'21485 Huelva',0,1);
        $pdf->RoundedRect(110, 40, 85, 50, 3.5, 'DF');
        $pdf->SetXY(115,30);
        $pdf->Cell(20,10,'Datos Cliente:',0,1);
        $pdf->Line(116,37,140,37);
        $pdf->SetXY(115,40);
        $pdf->Cell(20,10,'Cristian Vizcaino Alvarez',0,1);
        $pdf->SetXY(115,50);
        $pdf->Cell(20,10,'49109707-s',0,1);
        $pdf->SetXY(115,60);
        $pdf->Cell(20,10,'xtianrock89@gmail.com',0,1);
        $pdf->SetXY(115,70);
        $pdf->Cell(20,10,'C/ Gorrion nº 38 Aljaraque',0,1);
        $pdf->SetXY(115,80);
        $pdf->Cell(20,10,'21110 Huelva',0,1);
        $pdf->RoundedRect(15, 110, 120, 30, 3.5, 'DF');
        $pdf->SetXY(20,100);
        $pdf->Cell(20,10,'Datos factura:',0,1);
        $pdf->Line(21,107,44,107);
        $pdf->Output();
    }

}
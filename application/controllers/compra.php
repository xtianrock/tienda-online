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
        $datosComprador=$this->Modelo_venta->getPedido(1);

        $pdf->datosVenta(15,40,$datosEmpresa);
        $pdf->datosVenta(105,40,$datosComprador);



        $pdf->RoundedRect(15, 105, 85, 10, 3.5, 'DF');
        $pdf->SetXY(20,95);
        $pdf->Cell(20,10,'Datos factura:',0,1);
        $pdf->Line(21,102,44,102);
        $pdf->SetXY(20,105);
        $pdf->Cell(20,10,'Id factura:  546218',0,1);
        $pdf->SetXY(60,105);
        $pdf->Cell(20,10,'Fecha: 21/02/2015',0,1);
        $pdf->RoundedRect(15, 120, 180, 150, 3.5, 'DF');
        $pdf->SetXY(20,120);
        $pdf->Cell(20,10,'Cod producto',0,1);
        $pdf->SetXY(50,120);
        $pdf->Cell(20,10,'Nombre',0,1);
        $pdf->SetXY(120,120);
        $pdf->Cell(20,10,'Precio',0,1);
        $pdf->SetXY(140,120);
        $pdf->Cell(20,10,'Cantidad',0,1);
        $pdf->SetXY(165,120);
        $pdf->Cell(20,10,'Subtotal',0,1);
        for ($i=0;$i<10;$i++)
        {
            $pdf->SetXY(20,130+($i*10));
            $pdf->Cell(20,10,'blackSleeves',0,1);
            $pdf->SetXY(50,130+($i*10));
            $pdf->Cell(20,10,'Fundas ultra pro black',0,1);
            $pdf->SetXY(120,130+($i*10));
            $pdf->Cell(20,10,'30e',0,1);
            $pdf->SetXY(145,130+($i*10));
            $pdf->Cell(20,10,'41',0,1);
            $pdf->SetXY(168,130+($i*10));
            $pdf->Cell(20,10,'4521',0,1);
        }
        $pdf->Output();
    }

}
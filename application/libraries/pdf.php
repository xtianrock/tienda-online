<?php
require('fpdf.php');

class Pdf extends FPDF
{
// Cabecera de página
    function Header()
    {
        // Logo
        $this->Image(BASEURL.'/assets/img/logo_tienda.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Factura',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    function datosVendedor($x,$y,$datos)
    {
        $this->RoundedRect($x, $y, 85, 50, 3.5, 'DF');
        $this->SetXY($x+5,$y-10);
        $this->Cell(20,10,'Datos Vendedor:',0,1);
        $this->Line($x+6,$y-3,$x+31,$y-3);
        $this->SetXY($x+5,$y);
        $this->Cell(20,10,$datos['nombre'],0,1);
        $this->SetXY($x+5,$y+10);
        $this->Cell(20,10,$datos['dni'],0,1);
        $this->SetXY($x+5,$y+20);
        $this->Cell(20,10,$datos['mail'],0,1);
        $this->SetXY($x+5,$y+30);
        $this->Cell(20,10,$datos['direccion'],0,1);
        $this->SetXY($x+5,$y+40);
        $this->Cell(20,10,$datos['cp'],0,1);
    }

    function datoscliente($x,$y,$datos)
    {
        $this->RoundedRect($x, $y, 85, 50, 3.5, 'DF');
        $this->SetXY($x+5,$y-10);
        $this->Cell(20,10,'Datos Cliente:',0,1);
        $this->Line($x+6,$y-3,$x+31,$y-3);
        $this->SetXY($x+5,$y);
        $this->Cell(20,10,$datos->nombre,0,1);
        $this->SetXY($x+5,$y+10);
        $this->Cell(20,10,$datos->dni,0,1);
        $this->SetXY($x+5,$y+20);
        $this->Cell(20,10,$datos->mail,0,1);
        $this->SetXY($x+5,$y+30);
        $this->Cell(20,10,$datos->direccion,0,1);
        $this->SetXY($x+5,$y+40);
        $this->Cell(20,10,$datos->cp,0,1);
    }

    function datosFactura($x,$y,$datos)
    {
        $this->RoundedRect($x, $y, 85, 10, 3.5, 'DF');
        $this->SetXY($x+5,$y-10);
        $this->Cell(20,10,'Datos Factura:',0,1);
        $this->Line($x+6,$y-3,$x+31,$y-3);
        $this->SetXY($x+5,$y);
        $this->Cell(20,10,'Id pedido: '.$datos->id_pedido,0,1);
        $this->SetXY($x+35,$y);
        $this->Cell(20,10,'Fecha: '.$datos->fecha_pedido,0,1);
    }

    function resumen($x,$y)
    {
        $this->RoundedRect($x, $y, 180, 150, 3.5, 'DF');
        $this->SetXY($x+5,$y);
        $this->Cell(20,10,'Cod producto',0,1);
        $this->SetXY($x+35,$y);
        $this->Cell(20,10,'Nombre',0,1);
        $this->SetXY($x+105,$y);
        $this->Cell(20,10,'Precio',0,1);
        $this->SetXY($x+125,$y);
        $this->Cell(20,10,'Cantidad',0,1);
        $this->SetXY($x+150,$y);
        $this->Cell(20,10,'Subtotal',0,1);
    }
    function lineapedido($x,$datos,$linea)
    {
        $this->SetXY(20,$x);
        $this->Cell(20,10,$datos->cod_producto,0,1);
        $this->SetXY(50,$x);
        $this->Cell(20,10,$datos->nombre_producto,0,1);
        $this->SetXY(120,$x);
        $this->Cell(20,10,$linea->precio,0,1);
        $this->SetXY(145,$x);
        $this->Cell(20,10,$linea->cantidad,0,1);
        $this->SetXY(168,$x);
        $this->Cell(20,10,$linea->subtotal,0,1);
    }
}


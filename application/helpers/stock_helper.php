<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 11/02/2015
 * Time: 2:40
 */

function stockCheck($carrito,$productos)
{
    $sinStock=[];
    foreach ($carrito as $articulo)
    {
        foreach($productos as $producto)
        {
            if($articulo['id']==$producto->id_producto)
            {
                if($producto->stock<$articulo['qty'])
                {
                    $sinStock[]=$articulo['name'];
                }
            }
        }
    }
    return $sinStock;
}


function StockUpdate($carrito,$productos)
{
    if(is_array($productos))
    {
        foreach ($carrito as $articulo)
        {
            foreach($productos as $producto)
            {
                if($articulo['id']==$producto->id_producto)
                {
                    $producto->stock-=$articulo['qty'];
                }
            }
        }
    }
    else
    {
        foreach ($carrito as $articulo)
        {
            if($articulo['id']==$productos->id_producto)
            {
                $productos->stock-=$articulo['qty'];
            }
        }
    }
    return $productos;
}

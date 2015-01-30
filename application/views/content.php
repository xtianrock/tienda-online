<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 26/01/2015
 * Time: 16:32
 */
?>
<nav id="content">
    <h3>Productos destacados</h3>
    <ul>
        <?php foreach($destacados as $item):?>
            <li><?php echo $item->id_producto;?></li>
            <li><?php echo $item->nombre_producto;?></li>
            <li><?php echo $item->precio_producto;?></li>
            <li><?php echo $item->descripcion;?></li>
            <img class="imagen_producto" src="<?=$this->config->item('base_url')?>/assets/img/byron.JPG" >
        <?php endforeach;?>
    </ul>
</nav>


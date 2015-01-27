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
        <?php foreach($destacados->result() as $item):?>
            <li><?php echo $item->productos_id_producto;?></li>
            <li><?php echo $item->productos_categoria_id_cat;?></li>
        <?php endforeach;?>
    </ul>
</nav>

<?php
/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 04/02/2015
 * Time: 2:45
 */
?>
<div class="col-sm-9">
        <div class="jumbotron">
            <h2>Productos destacados</h2>
            <div class="row">
                <?php foreach($destacados as $item):?>
    <div class="col-xs-4">
        <ul>
            <li><?php echo $item->id_producto;?></li>
            <li><?php echo $item->nombre_producto;?></li>
            <li><?php echo $item->precio_producto;?></li>
            <li><?php echo $item->descripcion;?></li>
            <img class="imagen_producto" src="<?=$this->config->item('base_url')?>/assets/img/<?php echo $item->imagen_producto;?>" >
        </ul>
    </div>
<?php endforeach;?>
</div>
<p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
</div>
</div>
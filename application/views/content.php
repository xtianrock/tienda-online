<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 26/01/2015
 * Time: 16:32
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


<div class="col-sm-12">
    <div class="jumbotron">
        <h2>Todos los productos</h2>

            <?php $num = 1;
            $breaker = 3;
            foreach($productos->result() as $item):
            if ($num == 1) echo '<div class="row row-margin">';?>
                <div class="col-xs-4">
                    <ul>
                        <li><?php echo $item->id_producto;?></li>
                        <li><?php echo $item->nombre_producto;?></li>
                        <li><?php echo $item->precio_producto;?></li>
                        <li><?php echo $item->descripcion;?></li>
                        <img class="imagen_producto" src="<?=$this->config->item('base_url')?>/assets/img/<?php echo $item->imagen_producto;?>" >
                    </ul>
                </div>
            <?php $num++;
                if ($num > $breaker)
            {
                echo '</div>';
                $num = 1;
            }
            endforeach;?>
        </div>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
    </div>
</div>






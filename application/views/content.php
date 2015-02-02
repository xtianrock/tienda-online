<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 26/01/2015
 * Time: 16:32
 */
?>
<div class="row">
    <div class="col-sm-2">
        <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible-xs navbar-brand">Sidebar menu</span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Menu Item 1</a></li>
                        <li><a href="#">Menu Item 2</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach($categorias->result() as $item):?>
                                    <li><a href="#"><?php echo $item->nombre_cat;?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <li><a href="#">Menu Item 4</a></li>
                        <li><a href="#">Reviews <span class="badge">1,118</span></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
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
                            <img class="imagen_producto" src="<?=$this->config->item('base_url')?>/assets/img/byron.JPG" >
                        </ul>
                    </div>
                <?php endforeach;?>
            </div>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
        </div>
    </div>
</div>







<?php
/**
 * Created by PhpStorm.
 * User: 2DAWT
 * Date: 26/01/2015
 * Time: 16:47
 */
$this->load->helper('url');
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach($categorias->result() as $item):?>
                                    <li><?= anchor('main/categoria/'.$item->id_cat,$item->nombre_cat);?></li>
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
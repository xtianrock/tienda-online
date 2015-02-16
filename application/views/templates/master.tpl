<html>
<head>
    <meta charset="UTF-8">
    <title>{block name=title}{$titulo}{/block}</title>
    {block name=head}
        <link rel="stylesheet" href="{$smarty.const.BASEURL}/assets/css/estilos.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    {/block}
</head>
<body>
{block name=header}
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <h1>Tienda Online</h1>
            </div>
            <div class="col-xs-7">
                <ul class="nav nav-pills">
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            Categorias <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            {foreach $categorias->result() as $item}
                                <li><a href="{$smarty.const.BASEURL}index.php/main/productos/{$item->nombre_cat}">{$item->nombre_cat}</a></li>
                            {/foreach}
                        </ul>
                    </li>
                    <li><a href="{$smarty.const.BASEURL}index.php/usuarios/login">Login</a></li>
                    <li><a href="{$smarty.const.BASEURL}index.php/main/carrito">Carrito</a></li>
                    <li><a href="#">Elemento3</a></li>
                    <li><a href="#">Elemento4</a></li>
                </ul>
            </div>
            <div class="col-xs-2">
                <p>{$session}</p>
                <a href="{$smarty.const.BASEURL}index.php/usuarios/logout">Salir</a>
            </div>
        </div>
    </div>
{/block}
{block name=menu}
<div class="row">
    <div class="col-sm-2">
        <div id="menu" class="sidebar-nav">
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
                                {foreach $categorias->result() as $item}
                                    <li><a href="{$smarty.const.BASEURL}index.php/main/categoria/{$item->id_cat}">{$item->nombre_cat}</a></li>
                                {/foreach}
                            </ul>
                        </li>
                        <li><a href="#">Menu item 4</a></li>
                        <li><a href="#">Reviews <span class="badge">1,118</span></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

    {/block}
{block name=destacados}
    <div class="col-sm-10 col-sm-offset-1">
        <div id="destacados" class="jumbotron">
            <h2>Productos destacados</h2>
            <div class="row">
                {foreach $destacados as $item}
                    <div class="col-xs-4">
                        <ul>
                            <li>{$item->id_producto}</li>
                            <li>{$item->nombre_producto}</li>
                            <li>{$item->precio_producto}</li>
                            <li>{$item->descripcion}</li>
                        </ul>
                        <img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$item->imagen_producto}" >
                    </div>
                {/foreach}
            </div>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
        </div>
    </div>
{/block}

{block name=contenido}

{/block}


{block name=footer}
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <h3>Acerca de:</h3>
                <p>Esta es una tienda online para el proyecto de programacion web entorno servidor.</p>
            </div>
            <div class="col-xs-5">
                <h3>Comparte esta tienda con tus amigos!</h3>
            </div>
        </div>
    </div>
{/block}
</body>
</html>


<html>
<head>
    <meta charset="UTF-8">
    <title>{block name=title}{$titulo}{/block}</title>
    {block name=head}
        <link rel="stylesheet" href="{$smarty.const.BASEURL}/assets/css/estilos.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{$smarty.const.BASEURL}/assets/css/bootstrap.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="{$smarty.const.BASEURL}/assets/css/bootstrap-theme-min.css">
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
                <a href="{$smarty.const.BASEURL}index.php">
                    <img id="logo_tienda" src="{$smarty.const.BASEURL}/assets/img/logo_tienda.png" alt=""/>
                </a>
            </div>

            <div class="col-xs-7">
                <ul class="nav nav-pills">
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            Categorias <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            {foreach $categorias as $item}
                                <li><a href="{$smarty.const.BASEURL}index.php/main/categorias/{$item->nombre_cat}">{$item->nombre_cat}</a></li>
                            {/foreach}
                        </ul>
                    </li>
                    <li><a href="{$smarty.const.BASEURL}index.php/usuarios/login">Login</a></li>
                    <li><a href="{$smarty.const.BASEURL}index.php/main/carrito">Carrito <span class="badge">{$contenido_carrito}</span></a></li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            XML <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{$smarty.const.BASEURL}index.php/main/importar">Importar</a></li>
                            <li><a href="{$smarty.const.BASEURL}index.php/main/exportar">Exportar</a></li>
                        </ul>
                    </li>
                    <li><a href="{$smarty.const.BASEURL}index.php/usuarios/mi_usuario">Mi Usuario</a></li>
                </ul>
            </div>
            <div class="col-xs-2">
                <p>{$session}</p>
                <a href="{$smarty.const.BASEURL}index.php/usuarios/logout">Salir</a>
            </div>
        </div>
    </div>
{/block}


<div id="contenido">
{block name=contenido}

{/block}
</div>

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


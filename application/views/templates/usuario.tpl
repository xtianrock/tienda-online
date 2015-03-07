
{extends 'master.tpl'}

{block name="destacados"}{/block}

	{block name=contenido}
        <div class="container contenido-usuario">
            <div class="row">

                <div class="col-xs-6 col-lg-offset-3">
                    <ul class="nav nav-pills">
                        <li><a href="{$smarty.const.BASEURL}index.php/usuarios/cambiar_datos">Cambiar datos Personales </a></li>
                        <li><a href="{$smarty.const.BASEURL}index.php/main/Exportar">Ver pedidos</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                {if isset($mensaje)}{$mensaje}{/if}
                <h2>{$usuario->usuario}</h2>
                <p>{$usuario->mail}</p>
                <p>{$usuario->nombre} {$usuario->apellidos}</p>
                <p>{$usuario->dni}</p>
                <p>{$usuario->direccion}</p>
                <p>{$usuario->cp}</p>
                <p>{$provincia}</p>
            </div>
        </div>
	{/block}







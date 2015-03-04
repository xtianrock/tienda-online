
{extends 'master.tpl'}

{block name="destacados"}{/block}

	{block name=contenido}
        <div class="container">
            <div class="row">

                <div class="col-xs-6 col-lg-offset-3">
                    <ul class="nav nav-pills">
                        <li><a href="{$smarty.const.BASEURL}index.php/main/importar">Importar </a></li>
                        <li><a href="{$smarty.const.BASEURL}index.php/main/Exportar">Exportar</a></li>
                    </ul>
                </div>
            </div>
        </div>
	{/block}







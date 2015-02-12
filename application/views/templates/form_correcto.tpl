{extends 'master.tpl'}

{block name=destacados}
    {/block}

{block name=contenido}


    <div class="container">
			<div class="row">
				<div id="login" class="col-ms-3">
                    <p>{$mensaje}</p>
                    <a href="{$smarty.const.BASEURL}index.php/usuarios/login"><button class="btn btn-lg btn-primary btn-block" type="button">Identificarse</button></a>
				</div>
			</div>
	</div>




{/block}



{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}
	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>Mostrando {$titulo}</h2>
					<div class="col-xs-4">
						<ul>
							<li>{$producto->nombre_producto}</li>
							<li>{$producto->precio_producto}</li>
							<li>{$producto->descripcion}</li>
							<img class="imagen_detalle" src="{$smarty.const.BASEURL}/assets/img/{$producto->imagen_producto}">
							<a href="{$smarty.const.BASEURL}index.php/main/addProduct"><button class="btn btn-lg btn-primary btn-block" type="button">Añadir a la cesta</button></a>
						</ul>
					</div>
			</div>
		</div>
	{/block}







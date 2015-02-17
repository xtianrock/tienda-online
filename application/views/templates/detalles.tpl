
{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}
	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>Mostrando {$titulo}</h2>
					<div class="col-xs-4">
						<ul>

							<form class="form-signin" action="{$smarty.const.BASEURL}index.php/main/addproduct/" method="post" accept-charset="utf-8"/>
							<li>{$producto->nombre_producto}</li>

							<li>{$producto->descripcion}</li>
							</br>
							<input class="cantidad" type="number" min="1" max="{$producto->stock}" name="cantidad" value="1"/>
							<p>{$producto->precio_producto} €</p>
							<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$producto->imagen_producto}">
							<input type="hidden" name="id_producto" value="{$producto->id_producto}">
							<a href="{$smarty.const.BASEURL}index.php/main/addProduct"><button class="btn btn-lg btn-primary btn-block" type="submit">Añadir a la cesta</button></a>
							</form>
						</ul>
					</div>
			</div>
		</div>
	{/block}








{extends 'master.tpl'}

{block name="destacados"}{/block}
	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>{$titulo}</h2>
				<div class="row row-margin">
					<div class="col-xs-4">
							<form class="form-signin" action="{$smarty.const.BASEURL}index.php/main/addproduct/" method="post" accept-charset="utf-8"/>
							<p>{$producto->nombre_producto}</p>
							<p>{$producto->descripcion}</p>
							</br>
							{if ($producto->stock<1)}
								<input class="cantidad" type="number" name="cantidad" value="0" disabled/> Sin stock
							{elseif $producto->stock<5}
								<input class="cantidad" type="number" min="1" max="{$producto->stock}" name="cantidad" value="1" /> Ultimas unidades!
							{else}
								<input class="cantidad" type="number" min="1" max="{$producto->stock}" name="cantidad" value="1" />
							{/if}
							<p>{$producto->precio_producto} €</p>
							<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$producto->imagen_producto}">
							<input type="hidden" name="id_producto" value="{$producto->id_producto}">
							<input type="hidden" name="uri" value="{$uri}">
							{if ($producto->stock<1)}
								<button class="btn btn-lg btn-primary btn-block disabled" type="button">Añadir a la cesta</button>
							{else}
								<button class="btn btn-lg btn-primary btn-block" type="submit">Añadir a la cesta</button>
							{/if}
							</form>
					</div>
				</div>
			</div>
		</div>
	{/block}







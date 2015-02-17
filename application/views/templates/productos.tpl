
{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>Mostrando {$titulo}</h2>
				{$agregado_carrito}
				{$num = 1}
				{$breaker = 3}
				{foreach $productos->result() as $item}
					{if $num == 1}<div class="row row-margin">{/if}
					<div class="col-xs-4">
						<form class="form-signin" action="{$smarty.const.BASEURL}index.php/main/addproduct/" method="post" accept-charset="utf-8"/>
						<a href="{$smarty.const.BASEURL}index.php/main/productos/{$categoria}/{$item->id_producto}"><button class="btn" type="button">{$item->nombre_producto}</button></a>
						</br>
						<input class="cantidad" type="number" min="1" max="{$item->stock}" name="cantidad" value="1"/>
						<p>{$item->precio_producto} €</p>
						<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$item->imagen_producto}">
						<input type="hidden" name="id_producto" value="{$item->id_producto}">
						<input type="hidden" name="uri" value="{$uri}">
						<a href="{$smarty.const.BASEURL}index.php/main/addProduct"><button class="btn btn-lg btn-primary btn-block" type="submit">Añadir a la cesta</button></a>
						</form>
					</div>
					{$num=$num+1}
					{if $num > $breaker}
						</div>
						{$num = 1}
					{/if}
				{/foreach}
			</div>
		</div>
	{/block}







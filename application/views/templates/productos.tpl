
{extends 'master.tpl'}


	{block name=contenido}
		<div class="col-sm-12">
			<div class="jumbotron">
				<h2>Mostrando {$categoria->nombre_cat}</h2>
				{$num = 1}
				{$breaker = 3}
				{foreach $productos->result() as $item}
					{if $num == 1}<div class="row row-margin">{/if}
					<div class="col-xs-4">
						<ul>
							<li>{$item->id_producto}</li>
							<li>{$item->nombre_producto}</li>
							<li>{$item->precio_producto}</li>
							<li>{$item->descripcion}</li>
							<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$item->imagen_producto}">
						</ul>
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







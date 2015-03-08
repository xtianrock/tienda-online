
{extends 'master.tpl'}

{block name="destacados"}{/block}
	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>{$titulo}</h2>
				<div class="row row-margin">
					<div class="col-xs-4">
						<table>
							<caption>Pedidos de {$pedidos->usuario}</caption>
							{foreach $pedidos as $item}
								{$item->id_pedido}
							{/foreach}
						</table>
					</div>
				</div>
			</div>
		</div>
	{/block}







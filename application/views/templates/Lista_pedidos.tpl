
{extends 'master.tpl'}

{block name="destacados"}{/block}
	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>Pedidos de {$pedidos[0]->usuario}</h2>
				<p>{$mensaje}</p>
				<div class="row row-margin">
						<table>
							<tr>
								<th>Id</th>
								<th>Estado</th>
								<th>Nº Articulos</th>
								<th>Importe</th>
								<th>Fecha pedido</th>
								<th>Fecha entrega</th>
								<th>Factura</th>

							</tr>

							{foreach $pedidos as $item}
								<tr>
									<td>{$item->id_pedido}</td>
									<td>{$item->estado}</td>
									<td>{$item->cantidad}</td>
									<td>{$item->importe}€</td>
									<td>{$item->fecha_pedido}</td>
									<td>{$item->fecha_entrega}</td>
									<td><a href="{$smarty.const.BASEURL}index.php/pedido/factura/{$item->id_pedido}/ver">Ver</a> <a href="{$smarty.const.BASEURL}index.php/pedido/factura/{$item->id_pedido}/descargar">Descargar</a></td>
								</tr>
							{/foreach}
						</table>
				</div>
			</div>
		</div>
	{/block}







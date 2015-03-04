
{extends 'master.tpl'}

{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-8 col-sm-offset-2">
			<div class="jumbotron">
				<h2>Mostrando {$titulo}</h2>
				<form action="" method="post">
					<table>
						<legend>Carrito de la compra</legend>
						<tr>
							<th>row id</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
						</tr>

						{foreach $articulos as $item}

							<tr>
								<td>{$item['rowid']}</td>
								<td>{$item['name']}</td>
								<td>{$item['price']}</td>
								<td><input class="cantidad" type="number" min="0" max="{$item['stock']}" name="{$item['rowid']}" value="{$item['qty']}"/></td>
							</tr>
						{/foreach}

						<tr id="total">
							<td><strong>Total:</strong></td>
							<!--mostramos el total del carrito
                            con $this->cart->total()-->
							<td colspan="1">{$total} euros.</td>
							<!--creamos un enlace para eliminar el carrito-->
							<td colspan="4" id="eliminarCarrito"></td>
						</tr>
					</table>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar</button>
					<a href="{$smarty.const.BASEURL}index.php/pedido/resumenCompra"><button class="btn btn-lg btn-primary btn-block" type="button">Completar compra</button></a>

				</form>
			</div>
		</div>
	{/block}







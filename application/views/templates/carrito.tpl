
{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h2>Mostrando {$titulo}</h2>
				<table>
					<legend>Carrito de la compra</legend>
					<tr>
						<th>Nombre</th>
						<th>Opción</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Eliminar</th>
					</tr>
					{foreach $articulos as $item}

					<tr>
						<td>{$item['name']}</td>
						<td>{$item['price']}</td>
						<td>{$item['qty']}</td>
					</tr>
					{/foreach}
					<tr id="total">
						<td><strong>Total:</strong></td>
						<!--mostramos el total del carrito
                        con $this->cart->total()-->
						<td colspan="1">{$total} euros.</td>
						<!--creamos un enlace para eliminar el carrito-->
						<td colspan="4" id="eliminarCarrito"><?= anchor('../catalogo/eliminarCarrito', 'Vaciar carrito')?></td>
					</tr>
				</table>

			</div>
		</div>
	{/block}







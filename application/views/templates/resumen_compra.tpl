
{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
				<h2>Mostrando {$titulo}</h2>
				<div class="col-sm-6">
					<div class="jumbo jumbotron">

							<table>
								<legend>Resumen de articulos</legend>
								<tr>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Cantidad</th>
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
									<td colspan="4" id="eliminarCarrito"></td>
								</tr>
							</table>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="jumbotron">
						<legend>Datos de facturacion:</legend>
						</br>
						<p>{$cliente->nombre} {$cliente->apellidos}</p>
						<p>{$cliente->dni}</p>
						<p>{$cliente->mail}</p>
						<p>{$cliente->direccion}</p>
						<p>{$cliente->cp} {$provincia}</p>
						</form>
					</div>
				</div>
				<a href="{$smarty.const.BASEURL}index.php/pedido/procesarCompra"><button class="btn btn-lg btn-primary btn-block" type="button">Comfirmar compra</button></a>

			</div>
	{/block}







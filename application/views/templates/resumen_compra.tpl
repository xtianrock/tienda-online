
{extends 'master.tpl'}

{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
				<h2>{$titulo}</h2>
				<h3>{$mensaje}</h3>
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
									<td colspan="1">{$total} euros.</td>
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
				<a href="{$smarty.const.BASEURL}index.php/pedido/procesarCompra"><button class="btn btn-lg btn-primary btn-block" type="button">Confirmar compra</button></a>

			</div>
	{/block}







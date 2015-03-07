
{extends 'master.tpl'}

{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
				<h2>{$titulo}</h2>
				<div class="col-sm-10">
					<div class="jumbo jumbotron">

						{if ($enlaces)}
							<a href="{$smarty.const.BASEURL}index.php/main/ver_xml/productos.xml">Ver Productos.xml</a>
							<br/>
							<a href="{$smarty.const.BASEURL}index.php/main/descargar_xml/productos.xml">Descargar Productos.xml</a>
							<br/>
							<a href="{$smarty.const.BASEURL}index.php/main/ver_xml/categoria.xml">Ver Categorias.xml</a>
							<br/>
							<a href="{$smarty.const.BASEURL}index.php/main/descargar_xml/categoria.xml">Descargar Categorias.xml</a>
						{else}
							<p>Categorias</p>{if isset($categorias_importadas)}{$categorias_importadas}{/if}
							<form action="{$smarty.const.BASEURL}index.php/main/importarDatos" method="post" enctype="multipart/form-data">
								<input type="file" name="categorias" id="archivo"></input>
								<input type="submit" value="Subir archivo"></input>
							</form>

							<p>Productos</p>{if isset($productos_importados)}{$productos_importados}{/if}
							<form action="{$smarty.const.BASEURL}index.php/main/importarDatos" method="post" enctype="multipart/form-data">
								<input type="file" name="productos" id="archivo"></input>
								<input type="submit" value="Subir archivo"></input>
							</form>

						{/if}
					</div>
				</div>
			</div>
		</div>
	{/block}







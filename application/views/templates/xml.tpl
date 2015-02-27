
{extends 'master.tpl'}

{block name="menu"}{/block}
{block name="destacados"}{/block}

	{block name=contenido}
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
				<h2>{$titulo}</h2>
				<h3>{$mensaje}</h3>
				<div class="col-sm-10">
					<div class="jumbo jumbotron">
						{if ($enlaces)}
							<a href="{$smarty.const.BASEURL}index.php/main/ver_xml/productos.xml">Ver Productos.xml</a>
							<br/>
							<a href="{$smarty.const.BASEURL}index.php/main/ver_xml/categoria.xml">Ver Categorias.xml</a>
						{/if}
					</div>
				</div>
			</div>
		</div>
	{/block}







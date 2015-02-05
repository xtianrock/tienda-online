
{extends 'master.tpl'}
{php}
	$this->assign('my_url',base_url());
{/php}

{block name=head}

	<link rel="stylesheet" href="{$smarty.const.BASEURL}/assets/css/estilos.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

{/block}
<!------------------------------------------------------------------------------------------------------------------->
{block name=header}

	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<h1>Tienda Online</h1>
			</div>
			<div class="col-xs-9">
				<ul class="nav nav-pills">
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							Dropdown <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Elemento1</a></li>
							<li><a href="#">Elemento2</a></li>
							<li><a href="#">Elemento3</a></li>
							<li><a href="#">Elemento4</a></li>
						</ul>
					</li>
					<li><a href="#">Elemento1</a></li>
					<li><a href="#">Elemento2</a></li>
					<li><a href="#">Elemento3</a></li>
					<li><a href="#">Elemento4</a></li>
				</ul>
			</div>
		</div>
	</div>
{/block}

<!------------------------------------------------------------------------------------------------------------------->

{block name=menu}
<div class="row">
	<div class="col-sm-2">
		<div class="sidebar-nav">
			<div class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs navbar-brand">Sidebar menu</span>
				</div>
				<div class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Menu Item 1</a></li>
						<li><a href="#">Menu Item 2</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
							<ul class="dropdown-menu">
								{foreach $categorias->result() as $item}
									<li><a href="{$smarty.const.BASEURL}index.php/main/categoria/{$item->id_cat}">{$item->nombre_cat}</a></li>
								{/foreach}
							</ul>
						</li>
						<li><a href="#">Menu item 4</a></li>
						<li><a href="#">Reviews <span class="badge">1,118</span></a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

{/block}


{block name=destacados}

	<div class="col-sm-9">
		<div class="jumbotron">
			<h2>Productos destacados</h2>
			<div class="row">
				{foreach $destacados as $item}
				<div class="col-xs-4">
					<ul>
						<li>{$item->id_producto}</li>
						<li>{$item->nombre_producto}</li>
						<li>{$item->precio_producto}</li>
						<li>{$item->descripcion}</li>
						<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$item->imagen_producto}" >
					</ul>
				</div>
				{/foreach}
			</div>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
		</div>
	</div>
{/block}


	{block name=productos}

		<div class="col-sm-9">
			<div class="jumbotron">
				<h2>Productos destacados</h2>
				<div class="row">
					{foreach $destacados as $item}
						<div class="col-xs-4">
							<ul>
								<li>{$item->id_producto}</li>
								<li>{$item->nombre_producto}</li>
								<li>{$item->precio_producto}</li>
								<li>{$item->descripcion}</li>
								<img class="imagen_producto" src="{$smarty.const.BASEURL}/assets/img/{$item->imagen_producto}" >
							</ul>
						</div>
					{/foreach}
				</div>
				<p><a class="btn btn-primary btn-lg" href="#" role="button">Ver todos</a></p>
			</div>
		</div>
	{/block}



{block name=header}


{/block}




{extends 'master.tpl'}

{block name=destacados }{/block}
	{block name=contenido}


		<div class="container">
			<div class="row">
				<p class="form-signin-heading">{$mensaje}</p>
				<div id="login" class="col-ms-3">
					<form class="form-signin" method="post" accept-charset="utf-8"/>
						<h2 class="form-signin-heading">Introduzca su Email</h2>
						<input name="mail" type="text" id="inputMail" class="form-control" placeholder="Email" value="{ci helper='form' function='set_value' value='mail'}" autofocus>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Enviar Correo</button>
					</form>
				</div>
			</div>
		</div>
	{/block}





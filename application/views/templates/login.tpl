
{extends 'master.tpl'}

{block name=destacados }{/block}


	{block name=contenido}
		<div id="login" class="container">

			<form class="form-signin">
				<h2 class="form-signin-heading">Identificate</h2>
				<label for="inputName" class="sr-only">Usuario
				</label>
				<input type="text" id="inputName" class="form-control" placeholder="Usuario" required autofocus>
				<label for="inputPassword" class="sr-only">Contraseña</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Contraserña" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Recordar usuario
					</label>
				</div>

				<button class="btn btn-lg btn-primary btn-block" type="submit">Conectar</button>
				</br>
				<label>¿Aún no tienes cuenta?</label>
				<a href="{$smarty.const.BASEURL}index.php/usuarios/registro"><button class="btn btn-lg btn-primary btn-block" type="button">Registrarse</button></a>

			</form>

		</div>
	{/block}





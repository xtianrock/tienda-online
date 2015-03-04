
{extends 'master.tpl'}

{block name=destacados }{/block}



	{block name=contenido}


		<div class="container">
			<div class="row">

				<div id="usuario_creado" class="col-ms-3">
					<p>{$usuario_insertado}</p>
					<p>{$requiere_login}</p>
					<p class="form-signin-heading">{if isset($mensaje)}{$mensaje}{/if}</p>
				</div>

				<div id="login" class="col-ms-3">
					<form class="form-signin" method="post" accept-charset="utf-8"/>
						<h2 class="form-signin-heading">Identificate</h2>
						<label for="inputName" class="sr-only">Usuario
						</label>
						<input name="usuario" type="text" id="inputName" class="form-control" placeholder="Usuario" value="{ci helper='form' function='set_value' value='usuario'}" autofocus>
						<label for="inputPassword" class="sr-only">Contraseña</label>
						<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraserña" value="{ci helper='form' function='set_value' value='password'}" >
						<div class="checkbox">
							<a href="{$smarty.const.BASEURL}index.php/usuarios/resetpassword">¿Olvido su contraseña?</a>
						</div>

						<button class="btn btn-lg btn-primary btn-block" type="submit">Conectar</button>
						</br>
						<label>¿Aún no tienes cuenta?</label>
						<a href="{$smarty.const.BASEURL}index.php/usuarios/registro"><button class="btn btn-lg btn-primary btn-block" type="button">Registrarse</button></a>

					</form>
				</div>
			</div>
		</div>
	{/block}





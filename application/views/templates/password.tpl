{extends 'master.tpl'}

{block name=destacados}{/block}
{block name=contenido}


    {if isset($mensaje)}{$mensaje}{/if}

    <div id="registro" class="container">

        <form class="form-signin" method="post" accept-charset="utf-8"/>
        <h2 class="form-signin-heading">Introduce tu nueva contraseña.</h2>
        <label for="inputPassword" class="control-label">Contraseña</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" value="{ci helper='form' function='set_value' value='password'}"  >
        <label for="inputConfirmPassword" class="control-label">Confirmar contraseña</label>
        <input name="confirmPassword" type="password" id="inputConfirmPassword" class="form-control" placeholder="Contraseña" value="{ci helper='form' function='set_value' value='confirmPassword'}"  >
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
        </form>

    </div>
{/block}


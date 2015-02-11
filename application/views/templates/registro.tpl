{extends 'master.tpl'}

{block name=destacados}
    {/block}
{block name=contenido}


    {$errores_validacion}

    <div id="registro" class="container">

        <form class="form-signin" method="post" accept-charset="utf-8"/>
            <h2 class="form-signin-heading">Introduce tus datos</h2>
            <div class="inputs-izquierda">
                <label for="inputUsuario" class="">Usuario</label>
                <input name="usuario" type="text" id="inputUsuario" class="form-control" placeholder="Usuario" value="{ci helper='form' function='set_value' value='usuario'}" autofocus>

                <label for="inputEmail" class="control-label">Email</label>
                <input name="mail" type="text" id="inputEmail" class="form-control" placeholder="Email" value="{ci helper='form' function='set_value' value='mail'}"  autofocus>

                <label for="inputApellidos" class="control-label">Apellidos</label>
                <input name="apellidos" type="text" id="inputApellidos" class="form-control" placeholder="Apellidos" value="{ci helper='form' function='set_value' value='apellidos'}" autofocus>

                <label for="inputDireccion" class="control-label">Direccion</label>
                <input name="direccion" type="text" id="inputDireccion" class="form-control" placeholder="Direccion" value="{ci helper='form' function='set_value' value='direccion'}">

                <label for="inputProvincia" class="control-label">Provincia</label >
                <select name="provincia" id="inputProvincia" class="form-control">

                    {foreach $provincias as $item}
                        {if {ci helper='form' function='set_value' value='provincia' default='0'}==$item['id_provincia']}
                            <option value="{$item['id_provincia']}" selected>{$item['nombre_provincia']}</option>
                        {else}
                            <option value="{$item['id_provincia']}">{$item['nombre_provincia']}</option>
                        {/if}
                    {/foreach}
                </select>
            </div>
            <div class="inputs-derecha">
                <label for="inputPassword" class="control-label">Contraseña</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" value="{ci helper='form' function='set_value' value='password'}"  >

                <label for="inputNombre" class="control-label">Nombre</label>
                <input name="nombre" type="text" id="inputNombre" class="form-control" placeholder="Nombre" value="{ci helper='form' function='set_value' value='nombre'}" >

                <label for="inputDni" class="control-label">Dni</label>
                <input name="dni" type="text" id="inputDni" class="form-control" placeholder="Dni" value="{ci helper='form' function='set_value' value='dni'}" >

                <label for="inputCp" class="control-label">Codigo postal</label>
                <input name="cp" type="text" id="inputCp" class="form-control" placeholder="Codigo postal" value="{ci helper='form' function='set_value' value='cp'}">
            </div>

            <a href="{$smarty.const.BASEURL}index.php/usuarios/registro"><button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button></a>

        </form>

    </div>
{/block}


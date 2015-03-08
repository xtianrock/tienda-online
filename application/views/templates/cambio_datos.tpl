{extends 'master.tpl'}

{block name=destacados}{/block}
{block name=contenido}


    {if isset($mensaje)}{$mensaje}{/if}

    <div id="registro" class="container">

        <form class="form-signin" method="post" accept-charset="utf-8"/>
            <h2 class="form-signin-heading">Actualice sus datos</h2>
            <div class="inputs-izquierda">
                <label for="inputUsuario" class="">Usuario</label>
                <input name="usuario" type="text" id="inputUsuario" class="form-control" value="{$usuario->usuario}"  disabled autofocus>

                <label for="inputEmail" class="control-label">Email</label>
                <input name="mail" type="text" id="inputEmail" class="form-control" placeholder="Email" value="{if isset($post)}{ci helper='form' function='set_value' value='mail'}{else}{$usuario->mail}{/if}"  autofocus>

                <label for="inputApellidos" class="control-label">Apellidos</label>
                <input name="apellidos" type="text" id="inputApellidos" class="form-control" placeholder="Apellidos" value="{if isset($post)}{ci helper='form' function='set_value' value='apellidos'}{else}{$usuario->apellidos}{/if}" autofocus>

                <label for="inputDireccion" class="control-label">Direccion</label>
                <input name="direccion" type="text" id="inputDireccion" class="form-control" placeholder="Direccion" value="{if isset($post)}{ci helper='form' function='set_value' value='direccion'}{else}{$usuario->direccion}{/if}">

                <label for="inputProvincia" class="control-label">Provincia</label >
                <select name="provincias_id_provincia" id="inputProvincia" class="form-control">


                    {foreach $provincias as $item}
                        {if isset($post)}
                           {if {ci helper='form' function='set_value' value='provincias_id_provincia'}==$item['id_provincia']}}
                            <option value="{$item['id_provincia']}" selected>{$item['nombre_provincia']}</option>
                           {else}
                               <option value="{$item['id_provincia']}">{$item['nombre_provincia']}</option>
                           {/if}
                       {else}
                           {if $usuario->provincias_id_provincia==$item['id_provincia']}}
                               <option value="{$item['id_provincia']}" selected>{$item['nombre_provincia']}</option>
                           {else}
                               <option value="{$item['id_provincia']}">{$item['nombre_provincia']}</option>
                           {/if}
                        {/if}
                    {/foreach}
                </select>
            </div>
            <div class="inputs-derecha">
                <label for="inputPassword" class="control-label">Contraseña</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" value="{ci helper='form' function='set_value' value='password'}"  >

                <label for="inputConfirmPassword" class="control-label">Confirmar contraseña</label>
                <input name="confirmPassword" type="password" id="inputConfirmPassword" class="form-control" placeholder="Contraseña" value="{ci helper='form' function='set_value' value='confirmPassword'}"  >

                <label for="inputNombre" class="control-label">Nombre</label>
                <input name="nombre" type="text" id="inputNombre" class="form-control" placeholder="Nombre" value="{if isset($post)}{ci helper='form' function='set_value' value='nombre'}{else}{$usuario->nombre}{/if}" >

                <label for="inputDni" class="control-label">Dni</label>
                <input name="dni" type="text" id="inputDni" class="form-control" placeholder="Dni" value="{if isset($post)}{ci helper='form' function='set_value' value='dni'}{else}{$usuario->dni}{/if}" >

                <label for="inputCp" class="control-label">Codigo postal</label>
                <input name="cp" type="text" id="inputCp" class="form-control" placeholder="Codigo postal" value="{if isset($post)}{ci helper='form' function='set_value' value='cp'}{else}{$usuario->cp}{/if}">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar</button>

        </form>

    </div>
{/block}


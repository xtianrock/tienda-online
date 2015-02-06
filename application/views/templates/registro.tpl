{extends 'master.tpl'}

{block name=destacados}
    {/block}
{block name=contenido}
    <div id="registro" class="container">

        <form class="form-signin">
            <h2 class="form-signin-heading">Introduce tus datos</h2>
            <label for="inputUsuario" class="control-label">Usuario</label>
            <input type="text" id="inputUsuario" class="form-control" placeholder="Usuario" required autofocus>
            <br/>
            <label for="inputPassword" class="control-label">Contraseña</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraserña" required>
            <br/>
            <label for="inputEmail" class="control-label">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            <br/>
            <label for="inputNombre" class="control-label">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" placeholder="Nombre" required>
            <br/>
            <label for="inputApellidos" class="control-label">Apellidos</label>
            <input type="text" id="inputApellidos" class="form-control" placeholder="Apellidos" required autofocus>
            <br/>
            <label for="inputDni" class="control-label">Dni</label>
            <input type="text" id="inputDni" class="form-control" placeholder="Dni" required>
            <br/>
            <label for="inputDireccion" class="control-label">Direccion</label>
            <input type="text" id="inputDireccion" class="form-control" placeholder="Direccion" required>
            <br/>
            <label for="inputDni" class="control-label">Dni</label>
            <input type="text" id="inputDni" class="form-control" placeholder="Dni" required>
            <br/>
            <label for="inputProvincia" class="control-label">Provincia</label>
            <select id="inputProvincia" class="form-control">
                {foreach $provincias->result() as $item}
                    <option value="{$item->id_provincia}">{$item->nombre_provincia}</option>
                {/foreach}

            </select>
            <br/>
            <a href="{$smarty.const.BASEURL}index.php/usuarios/registro"><button class="btn btn-lg btn-primary btn-block" type="button">Registrarse</button></a>

        </form>

    </div>
{/block}


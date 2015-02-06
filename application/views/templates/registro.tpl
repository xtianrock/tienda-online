{extends 'master.tpl'}

{block name=destacados}
    {/block}
{block name=contenido}
    <div id="registro" class="container">

        <form class="form-signin">
            <h2 class="form-signin-heading">Introduce tus datos</h2>
            <div class="inputs-izquierda">
                <label for="inputUsuario" class="">Usuario</label>
                <input type="text" id="inputUsuario" class="form-control" placeholder="Usuario"  autofocus>

                <label for="inputEmail" class="control-label">Email</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="Email" autofocus>

                <label for="inputApellidos" class="control-label">Apellidos</label>
                <input type="text" id="inputApellidos" class="form-control" placeholder="Apellidos" autofocus>

                <label for="inputDireccion" class="control-label">Direccion</label>
                <input type="text" id="inputDireccion" class="form-control" placeholder="Direccion">

                <label for="inputProvincia" class="control-label">Provincia</label>
                <select id="inputProvincia" class="form-control">
                    {foreach $provincias->result() as $item}
                        <option value="{$item->id_provincia}">{$item->nombre_provincia}</option>
                    {/foreach}
                </select>
            </div>
            <div class="inputs-derecha">
                <label for="inputPassword" class="control-label">Contraseña</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraserña" >

                <label for="inputNombre" class="control-label">Nombre</label>
                <input type="text" id="inputNombre" class="form-control" placeholder="Nombre" >

                <label for="inputDni" class="control-label">Dni</label>
                <input type="text" id="inputDni" class="form-control" placeholder="Dni">

                <label for="inputCp" class="control-label">Codigo postal</label>
                <input type="text" id="inputCp" class="form-control" placeholder="Codigo postal">
            </div>

            <a href="{$smarty.const.BASEURL}index.php/usuarios/registro"><button class="btn btn-lg btn-primary btn-block" type="button">Registrarse</button></a>

        </form>

    </div>
{/block}


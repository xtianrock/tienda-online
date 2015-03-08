<?php

/**
 * Created by PhpStorm.
 * User: xtianrock
 * Date: 06/02/2015
 * Time: 2:35
 */
class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->datos['categorias'] = $this->Modelo_tienda->getCategorias();
        //Si el usuario no ha iniciado sesion sera tratado como invitado.
        if($this->session->userdata('usuario'))
        {
            $this->datos['session']=$this->session->userdata('usuario');
        }
        else
        {
            $this->datos['session']='Invitado';
        }
        $this->datos['contenido_carrito']=$this->cart->total_items();
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(FCPATH . 'application/views/templates');
        $this->load->model('Modelo_usuarios');
        $this->load->model('Modelo_venta');
        $this->smarty->assign($this->datos);
    }

    public function index()
    {
        $this->smarty->display('login.tpl');
    }

    /**
     * Permite iniciar sesion
     */
    public function login()
    {
        $this->datos['titulo'] ='Login';
        $this->datos['usuario_insertado']=$this->session->flashdata('usuario_insertado');
        $this->datos['requiere_login']=$this->session->flashdata('requiere_login');
        if ($this->form_validation->run('login') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
        }
        else if( !$this->Modelo_usuarios->login($this->input->post()))
        {
            $this->datos['mensaje']='El nombre de usuario y/o la contraseña son incorrectos';
        }
        else
        {
            $datos_usuario = array(
                'usuario' => $this->input->post('usuario'),
                'logueado' => TRUE
            );
            if($this->session->userdata('usuario'))
            {
                $this->cart->destroy();
            }
            $this->session->set_userdata($datos_usuario);
            if($this->session->flashdata('requiere_login'))
                redirect(BASEURL.'index.php/pedido/resumenCompra');
            else
                redirect(BASEURL.'index.php/main');
        }
        if($this->session->flashdata('requiere_login'))
            $this->session->set_flashdata('requiere_login',' ');
        $this->smarty->assign($this->datos);
        $this->smarty->display('login.tpl');
    }

    /**
     * Permite a los usuarios registrarse en la aplicacion
     */
    public function registro()
    {
        $this->datos['titulo'] ='Registro';
        $this->datos['provincias'] = $this->Modelo_tienda->getProvincias();

        if ($this->form_validation->run('registro') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
            $vista='registro.tpl';
        }
        else if($this->Modelo_usuarios->getUserByName($this->input->post('usuario')))
        {
            $this->datos['mensaje']="Ya existe un usuario con el nombre de usuario ".$this->input->post('usuario').'.';
            $vista='registro.tpl';
        }
        else if($this->Modelo_usuarios->getUserByMail($this->input->post('mail')))
        {
            $this->datos['mensaje']="Ya existe un usuario con el Email: ".$this->input->post('mail').'.';
            $vista='registro.tpl';
        }
        else if($this->input->post('password')!=$this->input->post('confirmPassword'))
        {
            $this->datos['mensaje']='Las contraseñas deben coincidir.';
            $vista='registro.tpl';
        }
        else
        {
            unset($_POST['confirmPassword']);
            $mensaje=$this->Modelo_usuarios->addUser($this->input->post());
            $this->session->set_flashdata('usuario_insertado',$mensaje);
            redirect(BASEURL.'index.php/usuarios/login');
        }
        $this->smarty->assign($this->datos);
        $this->smarty->display($vista);
    }

    /**
     * Cierra la sesion actual
     */
    public function logout()
    {
        $array_sesiones = array('usuario' => '', 'logueado' => '');
        $this->session->unset_userdata($array_sesiones);
        $this->session->sess_destroy();
        redirect(BASEURL.'index.php/main');
    }

    /**
     * Permite restablecer la contraseña de un usuario
     */
    public function resetPassword()
    {
        $this->datos['titulo'] ='Restableciendo contraseña';
        if ($this->form_validation->run('email') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
            $vista='email.tpl';
        }
        else if(!$usuario=$this->Modelo_usuarios->getUserByMail($this->input->post('mail')))
        {
            $this->datos['mensaje']='No existe ningun usuario con ese Email';
            $vista='email.tpl';
        }
        else
        {
            $usuario=$this->Modelo_usuarios->getUserByMail($this->input->post('mail'));
            $cadena=$usuario->id_usuario.$usuario->usuario.rand(1,9999999).date('Y-m-d');
            $token=sha1($cadena);
            $datos=array(
                'id_usuario'=> $usuario->id_usuario,
                'usuario'=>$usuario->usuario,
                'token'=>$token,
                'fecha'=>date('Y-m-d')
            );
            $this->Modelo_usuarios->addReset($datos);
            $enlace = BASEURL.'usuarios/newPassword/'.$token;
            $this->enviarMail($usuario->mail,$enlace);
            $this->datos['mensaje']='Se ha enviado un link de restablecimiento a su direccion de correo.';
            $vista='email.tpl';
        }
        $this->smarty->assign($this->datos);
        $this->smarty->display($vista);
    }

    /**
     * Soliucita una nueva contraseña al usuario
     *
     * @param $token token que debe coincidir con el almacenado en la base de datos
     */
    public function newPassword($token)
    {
        $this->datos['titulo'] ='Restableciendo contraseña';
        if(!$reset=$this->Modelo_usuarios->getReset($token))
        {
            redirect(BASEURL.'index.php/main');
        }
        else
        {
            if ($this->form_validation->run('password') == FALSE)
            {
                $this->datos['mensaje']=validation_errors();
                $vista='password.tpl';
            }
            else if($this->input->post('password')!=$this->input->post('confirmPassword'))
            {
                $this->datos['mensaje']='Las contraseñas deben coincidir.';
                $vista='password.tpl';
            }
            else
            {
                $this->Modelo_usuarios->resetPassword($reset->id_usuario,$this->input->post('password'));
                $this->datos['mensaje']='La contraseña se ha modificado con exito.';
                $vista='password.tpl';
            }
            $this->smarty->assign($this->datos);
            $this->smarty->display($vista);
        }

    }

    /**
     * Envia el mail para restablecer la contraseña
     *
     * @param $mail direccion a la que enviar
     * @param $enlace enlace desde el cual el usuario puede restablecer la contraseña
     */
    function enviarMail($mail,$enlace)
    {
        $this->email->initialize();
        $this->email->from('xtianrock89@gmail.com', 'Prueba Autom�tica desde CI');
        $this->email->to($mail);
        $this->email->cc('xtianrock89@gmail.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject('Restablecer contraseña');
        $this->email->message($enlace);
        $this->email->send();
    }

    /**
     * Muestra el panel de usuario
     */
    function mi_usuario()
    {
        $this->datos['titulo'] ='Mi Usuario';
        $this->datos['usuario']=$this->Modelo_usuarios->getUserByName($this->session->userdata('usuario'));
        $this->datos['provincia']=$this->Modelo_usuarios->getNombreProvincia($this->datos['usuario']->provincias_id_provincia);
        $this->smarty->assign($this->datos);
        $this->smarty->display('usuario.tpl');
    }

    /**
     * Permite cmabiar los datos del usuario
     */
    function cambiar_datos()
    {
        $this->datos['titulo'] ='Mis datos';
        $this->datos['usuario']=$this->Modelo_usuarios->getUserByName($this->session->userdata('usuario'));
        $this->datos['provincias'] = $this->Modelo_tienda->getProvincias();
        print_r($this->input->post());
        if ($this->input->post())
            $this->datos['post']=true;
        if ($this->form_validation->run('cambiar_datos') == FALSE)
        {
            $this->datos['mensaje']=validation_errors();
        }
        else if($this->input->post('password')!=$this->input->post('confirmPassword'))
        {
            $this->datos['mensaje']='Las contraseñas deben coincidir.';
        }
        else
        {
            $_POST['password']=password_hash($_POST['confirmPassword'],PASSWORD_DEFAULT);
            unset($_POST['confirmPassword']);
            $mensaje=$this->Modelo_usuarios->alterUser($this->input->post(),$this->session->userdata('usuario'));
            $this->session->set_flashdata('usuario_modificado',$mensaje);
            redirect(BASEURL.'index.php/usuarios/mi_usuario');
        }
        $this->smarty->assign($this->datos);
        $this->smarty->display('cambio_datos.tpl');
    }

    /**
     * Muestra los pedidos del usuario de la sesion
     */
    function mostrar_pedidos()
    {
        $this->datos['titulo'] ='Mis pedidos';
        $this->datos['mensaje'] =$this->session->flashdata('correo');
        $this->datos['pedidos'] = $this->Modelo_venta->getPedidoByUserName($this->session->userdata('usuario'));
        $this->smarty->assign($this->datos);
        $this->smarty->display('lista_pedidos.tpl');
    }

//Funciones de validacion

    function  validarUsuario($input)
    {
        if (preg_match('/^[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ]+[@\.a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ@_\-ª]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarUsuario','El campo %s solo puede contener letras, numeros y los caracteres (_ @ - . ª )');
            return FALSE;
        }
    }
    function  validarNombre($input)
    {
        if (preg_match('/^[a-zA-ZüÜáéíóúÁÉÍÓÚñÑ ]+[a-zA-ZüÜáéíóúÁÉÍÓÚñÑª\. ]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarNombre','El campo %s solo puede contener letras, numeros y los caracteres (ª .)');
            return FALSE;
        }
    }
    function  validarDireccion($input)
    {
        if (preg_match('/^[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ ]+[a-zA-Z0-9 üÜáéíóúÁÉÍÓÚñÑºª\/.-]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarDireccion','El campo %s solo puede contener letras, numeros y los caracteres (º ª / . -)');
            return FALSE;
        }
    }
    function  validarCp($input)
    {
        if (preg_match('/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarCp','El campo %s no es valido');
            return FALSE;
        }
    }
    function  validarDni($input)
    {
        if (preg_match('/^\d{8}[-]?[A-Za-z]{1}$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarDni','El campo %s no es valido');
            return FALSE;
        }
    }
    function  validarPassword($input)
    {
        if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).[a-zA-Z0-9üÜáéíóúÁÉÍÓÚñÑ ]*$/',$input))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('validarPassword','El campo %s debe contener al menos una letra mayuscula, una minuscula y un numero');
            return FALSE;
        }
    }


}
<?php defined("BASEPATH") or exit("No tienes accesos a este escript");
/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Movimiento_model');
	}

	/*************************************************************/
	public function index(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			$this->login();
		}
	}

	/**
	*
	*
	**/
	public function login(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			$this->load->view('login_view');
		}
	}

	public function principal(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			redirect('main/restringido');
		}
	}

	public function restringido(){
		$this->load->view('restringido_view');
	}

	/**
	*
	*/
	public function login_validation(){
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|callback_validar_credenciales');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->load->model('Usuarios_model');
			$permisos = $this->Usuarios_model->permisos($this->input->post('usuario'), $this->input->post('password'));
			$data = array('usuario' => $this->input->post('usuario'),
					'permisos' => $permisos, 
					'is_logged_in' => 1
					);
			$this->session->set_userdata($data);
			redirect('main/principal');
		} else{
			
			$this->load->view('login_view');
		}
	}

	/**
	*
	*/
	public function validar_credenciales(){
		$this->load->model('Usuarios_model');

		if($this->Usuarios_model->puede_entrar() == 1 ){

			return true;
		} elseif($this->Usuarios_model->puede_entrar() == 2 ){
			$this->form_validation->set_message('validar_credenciales', 'Usuario Bloqueado!');
			return false;
		} elseif ($this->Usuarios_model->puede_entrar() == 3 ) {
			$this->form_validation->set_message('validar_credenciales', 'Usuario Inactivo');
			return false;
		}
		else{
			$this->form_validation->set_message('validar_credenciales', 'Usuario/Password incorrectos!');
			return false;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('main/login');
	}
	//------------ Fin modulo Login y Logout ---

	/**
	* Desc: Sección para la creacion de Usuarios
	*/
	public function creacion_usuarios(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$lista_usuarios['usuarios'] = $this->Usuarios_model->lista_usuarios();
			$this->load->view('creacion_usuarios_view', $lista_usuarios);
		} else{
			redirect('main/restringido');
		}
	}

	public function nuevo_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->nuevo_usuario($_POST['data']);
			
			echo $nuevo_usuario;
			
		} else{
			redirect('main/restringido');
		}
	}

	public function carga_datos_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->carga_datos_usuario($_POST['data']);
			$lista_permisos = $this->Usuarios_model->carga_permisos_usuario($_POST['data']);
			$datos_usuario['datos_usuario'] = $nuevo_usuario;
			$datos_usuario['permisos'] = $lista_permisos;
			//echo json_encode($nuevo_usuario);
			echo json_encode($datos_usuario);
		} else{
			redirect('main/restringido');
		}
	}

	public function actualizar_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$actualizar_usuario = $this->Usuarios_model->actualizar_usuario($_POST['data']);
			echo json_encode($actualizar_usuario);
		} else{
			redirect('main/restringido');
		}
	}

	public function elimina_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$elimina_usuario = $this->Usuarios_model->elimina_usuario($_POST['data']);
			echo $elimina_usuario;
		} else{
			redirect('main/restringido');
		}
	}
	//********************************************
	public function apertura_caja(){
		if ($this->session->userdata('is_logged_in')){
			$apertura = $this->Movimiento_model->apertura_caja($_POST['data']);
			echo $apertura;
		} else{
			redirect('main/restringido');
		}
	}

	public function abre_movimientos_caja(){
		if ($this->session->userdata('is_logged_in')){
			// $articulos['articulo'] = $this->Articulos_model->lista_inventario();
			
			$this->load->view('movimiento_caja_view');
		} else{
			redirect('main/restringido');
		}
	}

	public function registra_movimientos_caja(){
		if ($this->session->userdata('is_logged_in')){
			$registra_movimiento = $this->Movimiento_model->registra_movimiento($_POST['data']);
			// print_r($registra_movimiento);
			echo $registra_movimiento;
		} else{
			redirect('main/restringido');
		}
	}
}
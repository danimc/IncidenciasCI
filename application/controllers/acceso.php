<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usuario', "", TRUE);
	}

	public function index()
	{
		$this->verifica_logeado();
		$this->load->view('_head');
		$this->load->view('_login');
	}

		function menu(){
		if($this->session->userdata("logged_in")){
			redirect("home");
		}
		else{
			redirect("ingreso");
		}
    }
	

	function login() {
		if(!isset($_POST["user"]) || !isset($_POST["password"]))
			redirect("/inicio/index");

		session_start();

		$_SESSION["user"]=$_POST["user"];
		$this->usuario->validar();
	}

	function logout()
	{
		$this->simplelogin->logout();
		redirect("acceso");
	}

	function verifica_logeado()
	{
		if($this->session->userdata("logged_in"))
			redirect("/inicio");
	}
}

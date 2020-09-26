<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}


	public function index2()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

  public function index(){
		$usuario = usuario_logado();
		$data['usuario'] = $usuario;
		$this->load->view('painel/main_painel_view',$data);
	}


  public function login(){
		$usuario = usuario_logado(false);

	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('identity', 'E-mail', 'required|valid_email');
	  $this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[30]');

    if ($this->form_validation->run() == FALSE){
      $this->load->view('painel/usuario/login_view');
    } else {
			$login = $this->ion_auth->login(filter_data($this->input->post('identity')),filter_data($this->input->post('password')));

			if($login) {
				redirect('main');
			} else {

			 $data['erros'] = array('usuario' => 'E-mail ou senha inválidos');
			 $this->load->view('painel/usuario/login_view',$data);


			}

    }

	}




}

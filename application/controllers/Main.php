	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$data['view'] = 'painel/dashboard/dashboard_view';
		$this->load->view('painel/main_painel_view',$data);
	}


	public function blog() {
		$crud = new grocery_CRUD();
    $crud->set_table('blog');
    $crud->where('deleted', false);

    $crud->columns('id', 'titulo', 'autor', 'categoria', 'created_at', 'active');

    $crud->display_as('titulo', 'Título');
    $crud->display_as('conteudo', 'Conteúdo');
    $crud->display_as('created_at', 'Publicado em');
    $crud->display_as('updated_at', 'Atualizado em');
    $crud->display_as('deleted_at', 'Deletado em');
    $crud->display_as('active', 'Ativo');

    $crud->set_relation('categoria', 'blog_categorias', 'titulo');
    $crud->set_field_upload('capa', 'uploads/capas');

    if (in_array($crud->getState(), ['add', 'clone'])) {
      $crud->field_type('created_at', 'hidden', mdate('%Y-%m-%d %H:%i:%s'));
      $crud->field_type('active', 'hidden', true);
      $crud->unset_fields('updated_at', 'deleted_at', 'deleted');
    }

    if ($crud->getState() == 'edit') {
      $crud->field_type('updated_at', 'hidden', mdate('%Y-%m-%d %H:%i:%s'));
      $crud->unset_fields('created_at', 'deleted_at', 'deleted');
    }

    if ($crud->getState() == 'read') {
      $crud->unset_fields('deleted');
    }

    $crud->required_fields('capa', 'titulo', 'conteudo', 'autor', 'categoria');

    $crud->callback_read_field('capa', function($value, $primary_key) {
      return '<div id="field-capa" class="readonly_label"><img height="120" src="/uploads/capas/' . $value . '"/></div>';
    });

    $crud->callback_read_field('conteudo', function($value, $primary_key) {
      return '<div id="field-conteudo" class="readonly_label">' . $value . '</div>';
    });

    $crud->callback_read_field('active', function($value, $primary_key) {
      if ($value == 1) {
        return '<div id="field-active" class="readonly_label">Sim</div>';
      }

      return '<div id="field-active" class="readonly_label">Não</div>';
    });

    $crud->callback_delete(function($primary_key) {
      $this->db->set('deleted', true)
        ->set('deleted_at', mdate('%Y-%m-%d %H:%i:%s'))
        ->where('id', $primary_key)
        ->update('blog');
    });

    $output = (array) $crud->render();

		$output['view'] = 'painel/blog/blog_view';
		$output['usuario'] = usuario_logado();

		$this->load->view('painel/main_painel_view', $output);
	}

	public function categorias_blog() {
		$crud = new grocery_CRUD();
		$crud->set_table('blog_categorias');

		$output = (array) $crud->render();

		$output['view'] = 'painel/blog/blog_view';
		$output['usuario'] = usuario_logado();

		$this->load->view('painel/main_painel_view', $output);
	}





}

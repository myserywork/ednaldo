<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/ElasticEmail.php');

class Site extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

	public function index()
  {
    if ($this->input->post('enviar_mensagem')) {
      $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
      $this->form_validation->set_rules('contato', 'Contato', 'trim|required');
      $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required');


      if ($this->form_validation->run()) {
        $email = new ElasticEmail\Email('', '3758c7e6-8239-4ca5-aa4c-53a3d93e1e18', array(
        	'from'      => 'ricardosouza.defn@gmail.com',
        	'from_name' => 'Ricardo MoriartyDev'
        ));

        $bodyHTML =
          '<style>p { font-family: "Arial", sans-serif; }</style>'
        . '<p><strong>Nome:</strong> ' . htmlentities($this->input->post('nome')) . '</p>'
        . '<p><strong>E-mail:</strong> ' . $this->input->post('email') . '</p>'
        . '<p><strong>Contato:</strong> ' . htmlentities($this->input->post('contato')) . '</p><br>'
        . '<p>' . htmlentities($this->input->post('mensagem')) . '</p><br><br><br>'
        . '<p style="text-align: center"><strong>Essa é uma mensagem automática, não responda!</strong></p>';

        $r = $email->send('equeiroga.med@gmail.com', 'Clínica Queiroga - Contato', null, $bodyHTML);

        if (empty($r) || strpos($r, 'erro'))
        {
          redirect('site?msg=error#contato');
        }

        redirect('site?msg=success#contato');
      }
    }

    $n = $this->db->select('*')
      ->from('blog')
      ->where('active', true)
      ->order_by('id', 'desc')
      ->limit(16)
      ->get()->result();

    $noticias = [];

    for ($x = 0; $x < 4; $x++) {
      $grupo = [];

      for ($y = 0; $y < 4; $y++) {
        $item = array_shift($n);
        if ($item !== NULL) {
          $grupo[] = $item;
        }
      }

      $noticias[] = $grupo;
    }

    $data = array(
      'noticias' => $noticias
    );

		$this->load->view('instituicional/main_view', $data);
	}


}

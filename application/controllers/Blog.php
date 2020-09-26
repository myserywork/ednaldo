<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->db->select('*')->from('blog');

    if ($this->input->get('categoria')) {
      $categoria = $this->input->get('categoria');
      if ($categoria > 0) {
        $this->db->where('categoria', $categoria);
      }
    }

    $noticias = $this->db
      ->where('active', true)
      ->order_by('id', 'desc')
      ->get()->result();

    $limite = 3;
    $paginas = ceil(count($noticias) / $limite);

    if ($paginas == 0) {
      $paginas = 1;
    }

    if (isset($_POST['pagina'])) {
      if ($this->input->get('pagina') < 1) {
        redirect('blog');
      }
    }

    $pagina = $this->input->get('pagina') ? $this->input->get('pagina') : 1;

    if ($pagina > $paginas) {
      if ($paginas == 1) {
        redirect('blog');
      }

      redirect('blog?pagina=' . $paginas);
    }

    $noticias = array_slice($noticias, ($pagina - 1) * $limite, $limite);

    $categorias = $this->db->select('*')
      ->from('blog_categorias')
      ->get()->result();

    foreach ($categorias as $key => $value) {
      $categorias[$key]->quantidade = $this->db->select('*')
        ->from('blog')
        ->where('categoria', $value->id)
        ->where('active', true)
        ->get()->num_rows();
    }

    $data = array(
      'noticias' => $noticias,
      'pagina' => $pagina,
      'paginas' => $paginas,
      'categorias' => $categorias
    );

    $this->load->view('blog/main_view.php', $data);
  }

  function ver()
  {
    $noticia = $this->db->select('*')
      ->from('blog')
      ->where('id', $this->uri->segment(2))
      ->where('active', true)
      ->where('deleted', false)
      ->get()->row();

    if (!$noticia) {
      redirect('blog');
    }

    $data = array(
      'noticia' => $noticia
    );

    $this->load->view('blog/noticia_view', $data);
  }
}

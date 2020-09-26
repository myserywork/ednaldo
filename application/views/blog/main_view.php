<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/css/master.css?rand=<?= rand(0, 1000000); ?>">

    <style>
      main {
        background-image: url('/resources/img/main.png');
        background-position: center 0px;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 2000px;
      }

      .noticia {
        margin-bottom: 48px;
        padding-top: 27px;
      }

      .noticia .noticia-title {
        font-weight: bold;
        font-size: 30px;
        line-height: 35px;
        color: #171717;
      }

      .noticia .noticia-date {
        font-size: 14px;
        line-height: 16px;
        color: #666666;
      }

      .noticia .noticia-image-container {
        position: relative;
        padding-bottom: 57.8%;
        margin: 30px 0px;
      }

      .noticia .noticia-image {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
      }

      .noticia .noticia-description {
        font-size: 16px;
        line-height: 24px;
        color: #666666;
        text-align: justify;
        margin-bottom: 25px;
      }

      .noticia .noticia-btn {
        font-size: 16px;
        line-height: 15px;
        color: #666666;
        font-weight: normal;
        border: 1px solid #132038;
      }

      .noticias-nav a {
        font-size: 16px;
        line-height: 15px;
        color: #666666;
        font-weight: 500;
        border: 1px solid #E5E5E5;
        padding: 20px 0px;
        width: 51px;
        margin-right: 21px;
      }

      .noticias-nav a.ativo {
        border: 1px solid #132038;
      }

      .categorias {
        padding-top: 27px;
      }

      .categorias h1 {
        font-weight: bold;
        font-size: 18px;
        line-height: 21px;
        color: #171717;
        margin-bottom: 30px;
      }

      .categorias ul {
        list-style: none;
        padding: 0px;
        margin: 0px;
      }

      .categorias ul > li {
        margin-bottom: 30px;
        font-size: 14px;
        line-height: 16px;
      }

      .categorias ul > li > a {
        color: #666666;
      }
    </style>

    <title>Clínica Queiroga</title>

    <script src="https://kit.fontawesome.com/9a3cbf7949.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
      if (location.protocol != 'https:')
      {
        location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
      }
    </script>
  </head>
  <body>
    <header class="section-header" style="min-height: 0px">
      <nav class="section-navbar">
        <div class="navbar-inner container">
          <a href="/site"><img src="/resources/img/logomarca.png"></a>
          <div class="nav-links">
            <a href="/site#sobre">Dr. Ednaldo Queiroga</a>
            <a href="/site#clinica">Clínica</a>
            <a href="/site#servicos">Serviços</a>
            <a href="/site#cursos">Cursos</a>
            <a href="/blog">Blog</a>
            <a href="/site#contato">Contato</a>
            <a href="/site#contato" class="destaque">Agende sua consulta</a>
          </div>
        </div>
      </nav>

      <div class="container">
        <h2 class="text-light my-3">BLOG</h2>
      </div>
    </header>

    <main class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">

            <?php if (count($noticias) > 0): ?>
              <?php foreach ($noticias as $noticia): ?>
                <div class="noticia">
                  <h1 class="noticia-title"><?= $noticia->titulo; ?></h1>
                  <p class="noticia-date"><?= mdate('%d de %M - %Y', strtotime($noticia->created_at)); ?></p>
                  <div class="noticia-image-container">
                    <div class="noticia-image" style="background-image: url('/uploads/capas/<?= $noticia->capa; ?>')"></div>
                  </div>
                  <p class="noticia-description"><?= str_replace("\n", ' ', substr(strip_tags($noticia->conteudo), 0, 200)); ?></p>
                  <a class="btn noticia-btn" href="blog/<?= $noticia->id; ?>">Ler mais</a>
                </div>
              <?php endforeach; ?>

              <nav class="noticias-nav">
                <?php for ($n = 1; $n <= $paginas; $n++): ?>
                  <a class="btn <?= $n == $pagina ? 'ativo' : ''; ?>" href="javascript:alterarPagina(<?= $n; ?>)"><?= $n; ?></a>
                <?php endfor; ?>
              </nav>
            <?php else: ?>
              <p style="margin-top: 27px">Não foi possível encontrar nenhuma notícia!</p>
            <?php endif; ?>
          </div>
          <div class="col-lg-4">
            <div class="categorias">
              <h1>Categorias</h1>
              <ul>
                <?php foreach ($categorias as $categoria): ?>
                  <li>
                    <a class="d-flex justify-content-between" href="javascript:alterarCategoria(<?= $categoria->id; ?>)">
                      <div><?= $categoria->titulo; ?></div>
                      <div>(<?= $categoria->quantidade; ?>)</div>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <form class="d-none" action="/blog" method="get" id="mainForm">
        <input type="hidden" name="pagina" value="<?= $pagina; ?>">
        <input type="hidden" name="categoria" value="<?= $this->input->get('categoria') ? $this->input->get('categoria') : 0; ?>">
      </form>

      <script type="text/javascript">
        function alterarPagina(i) {
          $('#mainForm input[name=pagina]').val(i);
          $('#mainForm').submit();
        }

        function alterarCategoria(id) {
          $('#mainForm input[name=pagina]').val(1);
          $('#mainForm input[name=categoria]').val(id);
          $('#mainForm').submit();
        }
      </script>
    </main>

    <footer class="section-footer">
      <div class="container">
        <img src="/resources/img/vector-logo-footer.png" style="margin-right: 6px">
        COPYRIGHT &copy; 2017 - CLÍNICA QUEIROGA | MORIARTYDEV.COM
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if ($this->input->get('msg') == 'error'): ?>
      <script type="text/javascript">
        swal('Ops!', 'Não foi possível enviar a sua mensagem, tente novamente!', 'error');
      </script>
    <?php endif; ?>

    <?php if ($this->input->get('msg') == 'success'): ?>
      <script type="text/javascript">
        swal('Pronto!', 'Sua mensagem foi enviada com sucesso, em breve entraremos em contato!', 'success');
      </script>
    <?php endif; ?>
  </body>
</html>

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

      .noticia-voltar {
        font-size: 14px;
        line-height: 16px;
        color: #666666 !important;
        display: block;
      }

      .noticia-voltar span {
        font-weight: bold;
        color: #132038;
      }

      .noticia-image-container {
        position: relative;
        padding-bottom: 43%;
        margin: 30px 0px;
      }

      .noticia-image {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
      }

      .noticia-title {
        font-weight: bold;
        font-size: 30px;
        line-height: 35px;
        color: #171717;
      }

      .noticia-date {
        font-size: 14px;
        line-height: 16px;
        color: #666666;
      }

      .noticia-description {
        margin-top: 30px;
        font-size: 16px;
        line-height: 24px;
        color: #666666;
        text-align: justify;
        margin-bottom: 60px;
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
            <a href="/site#clinica">Clínica</a>
            <a href="/site#sobre">Dr. Ednaldo Queiroga</a>
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
        <a class="noticia-voltar" href="/blog"><span>←</span> VOLTAR</a>
        <div class="noticia-image-container">
          <div class="noticia-image" style="background-image: url('/uploads/capas/<?= $noticia->capa; ?>')"></div>
        </div>
        <h1 class="noticia-title"><?= $noticia->titulo; ?></h1>
        <p class="noticia-date"><?= mdate('%d de %M - %Y', strtotime($noticia->created_at)); ?></p>
        <div class="noticia-description">
          <?= $noticia->conteudo; ?>
        </div>
        <a class="noticia-voltar" href="/blog"><span>←</span> VOLTAR</a>
      </div>
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

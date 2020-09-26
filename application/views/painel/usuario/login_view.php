<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png'); ?>">

    <!-- page css -->

    <!-- Core css -->
    <link href="<?= base_url('assets/css/app.min.css'); ?>" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('<?= base_url(); ?>assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                        <h2 class="m-b-0">Login</h2>
                                    </div>

                                    <form action="<?= base_url('usuario/login'); ?>" method="POST">
																			<div id="validation_erros">
																				<?php echo validation_errors(); ?>

																				<?php
																				if(isset($erros)) {
																					if(count($erros) > 0) {
																					 foreach($erros as $erros => $e) {
																						 echo $e . '<br>';
																					 }
																					}
																				}
																				?>

																			</div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" name="identity" class="form-control" id="userName" placeholder="E-mail">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Senha:</label>
                                            <a class="float-right font-size-13 text-muted" href="">Esqueceu a senha?</a>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    Não tem uma conta?
                                                    <a class="small" href=""> Registrar</a>
                                                </span>
                                                <button class="btn btn-primary">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2019 MoriartyDEV</span>

                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="<?= base_url('assets/js/vendors.min.js'); ?>"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="<?= base_url('assets/js/app.min.js'); ?>"></script>

</body>

</html>

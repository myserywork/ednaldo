<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dr Ednaldo Queiroga</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/favicon.png">

    <!-- page css -->

    <!-- Core css -->

    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet">
    <?php if (isset($css_files)): ?>
    <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php endif; ?>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php $this->load->view('painel/header'); ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php $this->load->view('painel/sidebar'); ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">

                <!-- Content Wrapper START -->
                <?php $this->load->view($view); ?>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <?php $this->load->view('painel/footer'); ?>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>


  <?php $this->load->view('painel/scripts'); ?>
  <?php if (isset($js_files)):
  foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
  <?php endforeach; endif; ?>

</body>

</html>

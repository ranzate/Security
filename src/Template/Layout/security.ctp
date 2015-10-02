<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= h($this->fetch('title')) ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('uniform.default.css') ?>
    <?= $this->Html->css('sweet-alert.css') ?>
    <?= $this->Html->css('layout.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('components-rounded.css') ?>

    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('parsley.min.js') ?>
    <?= $this->Html->script('jquery.uniform.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('sweet-alert.min.js') ?>
    <?= $this->Html->script('metronic.js') ?>
    <?= $this->Html->script('layout.js') ?>
    <?= $this->Html->script('metronic.js') ?>

    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

    <style type="text/css">
        
  </style>

  <script type="text/javascript">
  var action = '<?= $this->request->params['action'] ?>';
  $(function(){
    if(action == 'view'){
        $('input, select, textarea').attr('disabled', true);
        $('.form-actions').find('button, a').not('.btn-voltar').remove();
    }
  });
  </script>
</head>
<body style="padding: 10px !important;">
    <?= $this->fetch('content') ?>
</body>
</html>
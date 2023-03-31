<?php
function printHead($pageName = 'Document')
{
?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $pageName ?></title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="<?= PATH ?>/View/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="<?= PATH ?>/View/assets/css/alertify.core.css" rel="stylesheet" type="text/css" />
            <link href="<?= PATH ?>/View/assets/css/alertify.default.css" rel="stylesheet" type="text/css" />
            <link href="<?= PATH ?>/View/assets/css/styles.css" rel="stylesheet">
            <script src="<?= PATH ?>/View/assets/js/jquery-1.12.0.min.js" type="text/javascript"></script>
            <script src="<?= PATH ?>/View/assets/js/bootstrap.min.js"></script>
            <script src="<?= PATH ?>/View/assets/js/alertify.js" type="text/javascript"></script>
            <script src="<?= PATH ?>/View/assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="<?= PATH ?>/View/assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
      </head>
<?php
}
?>
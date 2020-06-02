<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/bootstrap/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/fontawesome/all.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/sb-admin/sb-admin.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/dataTables/dataTables.min.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/jquery-ui/jquery-ui.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/toastr/toastr.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/style.css' ?>">
    <title><?= $title?></title>
</head>

<body class="position-relative min-vh-100">
    <?= $header ?>
    <?= $content ?>

    <?= $footer ?>

    <script src="<?= $this->getIndex() . '/public/js/jquery/jquery.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/popper/popper.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/fontawesome/all.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/sb-admin/sb-admin.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/bootstrap/bootstrap.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/dataTables/dataTables.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/dataTables/dataTables.bootstrap4.min.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/jquery/jquery-ui/jquery-ui.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/toastr/toastr.min.js' ?>"></script>
    <script src="<?= $this->getIndex() . '/public/js/script.js' ?>"></script>
</body>
</html>
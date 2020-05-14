<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/style.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/bootstrap/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/fontawesome/all.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/sb-admin/sb-admin.css' ?>">
    <link rel="stylesheet" href="<?= $this->getIndex() . '/public/css/dataTables/dataTables.min.css' ?>">
 
    <title><?= $title ?></title>
</head>
<body>
    <?= $header ?>
    <?= $content ?>
</body>
<script src="<?= $this->getIndex() . '/public/js/jquery/jquery.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/popper/popper.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/fontawesome/all.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/sb-admin/sb-admin.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/bootstrap/bootstrap.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/dataTables/dataTables.js' ?>"></script>
<script src="<?= $this->getIndex() . '/public/js/script.js' ?>"></script>
</html>
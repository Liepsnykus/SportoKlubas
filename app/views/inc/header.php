<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" defer integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script defer src="<?php echo URLROOT; ?>/js/main.js"></script>
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <header>
        <?php print_r($_SESSION) ?>

        <nav class="navbar navbar-expand-sm  navbar-dark bg-secondary">
            <div class="navContainer mx-auto">
                <div class="d-flex justify-content-between">
                    <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo SITENAME ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link <?php echo $data['currentPage'] == 'index' ? 'active' : '' ?>" href="<?php echo URLROOT ?>">Pradinis</a>
                            <a class="nav-link <?php echo $data['currentPage'] == 'comments' ? 'active' : '' ?>" href="<?php echo URLROOT ?>pages/comments">Atsiliepimai</a>
                        </div>
                        <?php if (isLoggedIn()) : ?>
                            <div class="navbar-nav ml-auto">
                                <div class="nav-link"><?php echo $_SESSION['name'] ?></div>
                                <a class="nav-link" href="<?php echo URLROOT ?>users/logout">Atsijungti</a>
                            </div>
                        <?php else : ?>
                            <div class="navbar-nav ml-auto">
                                <a class="nav-link <?php echo $data['currentPage'] == 'register' ? 'active' : '' ?>" href="<?php echo URLROOT ?>users/register">Registruotis</a>
                                <a class="nav-link <?php echo $data['currentPage'] == 'login' ? 'active' : '' ?>" href="<?php echo URLROOT ?>users/login">Prisijungti</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
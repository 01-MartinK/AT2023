<!DOCTYPE html>
<html lang="et">
<head>
    <base href="<?= BASE_URL ?>">
    <title><?= PROJECT_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="vendor/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/components/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/admin_main.css">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/components/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/admin_main.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
</head>
<body>

<!-- ################################################################## -->
<!-- ################################################################## -->
<!-- ##########            THIS SITE WAS DONE BY:           ########### -->
<!-- ########## RENEE SÄKS, http://www.escaper.ee/renee/cv  ########### -->
<!-- ########## CARMEN HAAV, carmen.haav@khk.ee             ########### -->
<!-- ########## Raul Kallasmaa, raul.kallasmaa@khk.ee       ########### -->
<!-- ################################################################## -->
<!-- ################################################################## -->

<!-- #####################################################################
___________              __           ____  __.___ ___  ____  __.
\__    ___/____ ________/  |_ __ __  |    |/ _/   |   \|    |/ _|
  |    |  \__  \\_  __ \   __\  |  \ |      </    ~    \      <
  |    |   / __ \|  | \/|  | |  |  / |    |  \    Y    /    |  \
  |____|  (____  /__|   |__| |____/  |____|__ \___|_  /|____|__ \
               \/                            \/     \/         \/
###################################################################### -->

<nav class="nav-bar">
    <div class="navbar-content">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-logo">
            <a href="http://voco.ee/" target="_blank"><img id="voco-logo" src="https://voco.ee/wp-content/uploads/VOCO-Logo.svg" alt="logo"/></a>
        </div>
        <div class="navbar-info">
            <?php if (isset($_SESSION['user_id'])): ?>
                <h4 class="navbar-info"><?= $_SESSION['name'] . ', ' . $_SESSION['social_id'] ?></h4>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php if (isset($auth->is_admin) && $auth->is_admin): ?>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top navbar-admin">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?= isset($resultpage) ? 'class="active"' : '' ?>><a href="admin"><?= __('Tulemused') ?></a>
                    </li>
                    <li <?= isset($practical) ? 'class="active"' : '' ?>><a
                                href="admin/practical"><?= __('Praktilised ülesanded') ?></a></li>
                    <li <?= isset($theoretical) ? 'class="active"' : '' ?>><a
                                href="admin/theoretical"><?= __('Teoreetilised küsimused') ?></a></li>
                    <li <?= isset($grading) ? 'class="active"' : '' ?>><a
                                href="admin/grading"><?= __('Hindamine') ?></a></li>
                    <li <?= isset($log) ? 'class="active"' : '' ?>><a href="admin/log"><?= __('Logi') ?></a></li>
                    <li <?= isset($properties) ? 'class="active"' : '' ?>><a
                                href="admin/settings"><?= __('Seaded') ?></a></li>
                    <li <?= isset($help) ? 'class="active"' : '' ?>><a href="admin/help"><?= __('Abi') ?></a></li>
                </ul>
                <div class="nav navbar-nav navbar-right logout">
                    <a href="logout" class="btn btn-info btn-lg logout-btn"
                       data-toggle="tooltip" data-placement="bottom" title="Logi välja">
                        <span class="glyphicon glyphicon-log-out"></span> <span class="log-out-txt">Logi välja</span>
                    </a>
                </div>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
<?php endif; ?>

<div class="container">

    <?php if (!isset($auth->is_admin) || !($auth->is_admin)): ?>
        <!-- ADMIN LOGIN -->
        <form class="form-signin" method="post" autocomplete="off">

            <h2 class="form-signin-heading"><?= __('Palun logige sisse') ?></h2>

            <?php if (isset($errors)) {
                foreach ($errors as $error): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endforeach;
            } ?>



            <div class="input-group">
                <input id="username" name="username" type="text" class="form-control" placeholder="Kasutajanimi" autofocus>
            </div>

            <br/>


            <div class="input-group">
                <input id="password" name="password" type="password" class="form-control" placeholder="Parool">
            </div>

            <br/>

            <button id="btnLogin" class="admin-login-submit"
                    type="submit"><?= __('Logi sisse') ?></button>

        </form>
    <?php endif; ?>

    <!-- Main component for a primary marketing message or call to action -->
    <?php if (!file_exists("views/$controller/{$controller}_$action.php")) error_out('The view <i>views/' . $controller . '/' . $controller . '_' . $action . '.php</i> does not exist. Create that file.'); ?>
    <?php @require "views/$controller/{$controller}_$action.php"; ?>

</div>
<!-- /container -->
<footer>
    <div class="col-md-2 footer-block">
        <a class="footer-text" href="https://voco.ee"><img id="footer-logo" src="images/VOCO.svg" alt="logo"/></a>
    </div>
    <div class="col-md-2 footer-block">
        <p class="footer-title">Kontakt</p>
        <a class="footer-text" href="mailto:info@voco.ee">info@voco.ee</a><br/>
        <a class="footer-text" href="tel:+3727361866">7 361 866</a><br/>
    </div>
    <div class="col-md-2 footer-block">
        <p class="footer-title">VOCO</p>
        <a class="footer-text" href="https://goo.gl/wGteKA" target="_blank">Kopli 1</a><br/>
        <a class="footer-text" href="https://goo.gl/wGteKA" target="_blank">Tartu 50115 Eesti</a><br/>
    </div>
    <div class="col-md-2 footer-block">
        <p class="footer-title">Privaatsustingimused</p>
        <a class="footer-text" href="https://voco.ee/andmekaitse-info/">Andmekaitse</a><br/>
        <a class="footer-text" href="https://voco.ee/kupsised/">Küpsised</a><br/>
    </div>
</footer>

<script>
    // admin login
    $('#btnLogin').on('click', function (event) {
        event.preventDefault();
        $.post('admin/login', {
            "username": $("#username").val(),
            "password": $("#password").val()
        }, function (res) {
            if (res == 'ok') {
                window.location.href = 'admin';
            } else {
                alert(res);
            }
        });
    });
</script>

</body>
</html>

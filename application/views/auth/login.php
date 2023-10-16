<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='<?php echo base_url(); ?>public/image/x-icon'
          href='<?php echo base_url(); ?>public/images/favicon.ico'/>
    <!-- /site favicon -->

    <!-- Entypo font stylesheet -->
    <link href="<?php echo base_url(); ?>public/css/entypo.css" rel="stylesheet">
    <!-- /entypo font stylesheet -->

    <!-- Font awesome stylesheet -->
    <link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet">
    <!-- /font awesome stylesheet -->

    <!-- Bootstrap stylesheet min version -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <!-- /bootstrap stylesheet min version -->

    <!-- Mouldifi core stylesheet -->
    <link href="<?php echo base_url(); ?>public/css/mouldifi-core.css" rel="stylesheet">
    <!-- /mouldifi core stylesheet -->

    <link href="<?php echo base_url(); ?>public/css/mouldifi-forms.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        .err {
            color: red;
            font-weight: bold;
        }
    </style>

</head>

<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="#"><img src="<?php echo base_url(); ?>public/images/Shamsaha_Logo_Reverse_white.png" alt="Shamsaha"
                         title="Shamsaha"></a>
    </div>
    <div class="login-content">
        <h2><strong>Welcome</strong>, please login</h2>
        <!--  <form method="post" action="<?php echo base_url(); ?>Login/login_validation">  -->
        <form class="form-signin" method="post" id="loginForm" action="<?= site_url('login') ?>">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
            <?= isset($failed) && !empty($failed) ? "<p class='err'>{$failed}</p>" : ""; ?>
            <?= $this->session->flashdata('success'); ?>
            <div class="form-group">
                <label for="username" class="sr-only">Email address</label>
                <?= form_error('username', '<div class="err">', '</div>'); ?>
                <input type="text" id="inputEmail" class="form-control" placeholder="Username"
                       value="<?= set_value('username'); ?>"
                       name="username" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <?= form_error('password', '<div class="err">', '</div>'); ?>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                       value="<?= set_value('password'); ?>" name="password">
            </div>
            <div class="form-group" style="margin-top: 25px">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>

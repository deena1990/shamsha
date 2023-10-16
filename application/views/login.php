<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $site_title; ?></title>
<!-- Site favicon -->
<link rel='shortcut icon' type='<?php echo base_url(); ?>public/image/x-icon' href='<?php echo base_url(); ?>public/images/favicon.ico' />
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


</head>
<body class="login-page">
<div class="login-container">
	<div class="login-branding">
		<a href="#"><img src="<?php echo base_url(); ?>public/images/Shamsaha_Logo_Reverse_white.png" alt="Shamsaha" title="Shamsaha"></a>
	</div>
	<div class="login-content">
		<h2><strong>Welcome</strong>, please login</h2>
		 <!--  <form method="post" action="<?php echo base_url(); ?>Login/login_validation">  -->
		 <?php echo form_open('Login/login_validation'); ?>                       
			<div class="form-group">
				<input type="text" placeholder="Username" name="username" class="form-control">
			</div>                        
			<div class="form-group">
				<input type="password" placeholder="Password" name="password" class="form-control">
			</div>
			
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
				<?php  
                          echo '<label class="text-danger">'.$this->session->flashdata

("error").'</label>';  
                     ?>
			</div>
			<p class="text-center" style="display:none;"><a href="forgot-password.html">Forgot your password?</a></p>                        
		<!--</form>-->
		<?php echo form_close(); ?>
	</div>
</div>
<!--Load JQuery-->
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
</body>

</html>

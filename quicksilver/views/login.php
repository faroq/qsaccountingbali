<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form - <?= $this->config->item('app_title') ?></title>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/style/loginstyle.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/style/jquery.loadmask.css" media="screen"/>	
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/style/jquery.alerts.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/style/jquery.validation.css" media="screen"/>
<!--SCRIPTS-->
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/jquery.loadmask.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/jquery.alerts.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/jQuery/login.js"></script>
</head>
<body>
<div class="loading">
<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>

<form name="login-form" id="frmLogin" class="login-form" action="<?= site_url('auth/login') ?>" method="post">
    <div class="header">
<!--    	<img src="<?= base_url() ?>assets/images/login/logo.png" alt="">-->
    	<h1>Login Form</h1>
        <span>Fill out the form below to login to my super awesome imaginary control panel.</span>
    </div>
    
    <div class="content">
		<input name="username" id="username" type="text" class="input username validate[required]" placeholder="Username" value="" tabindex="1"/>
		<input name="password" id="password" type="password" class="input password validate[required]" placeholder="Password" value="" tabindex="2"/>
    </div>

    <div class="footer">
    	<input type="submit" name="submit" value="Login" class="button" tabindex="3"/>
    	<!--input type="checkbox" name="remember_me" id="remember_me">Remember me?-->
    </div>
</form>

</div>

<div class="gradient"></div>
</div>
</body>
</html>
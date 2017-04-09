<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/bootstrap.min.js"></script>
	
	<script>
		var base_url = '<?php echo base_url(); ?>';
	</script>

    <script src="<?php echo base_url(); ?>assets/js/index.js?<?php echo time(); ?>"></script>    
    
</head>
<body>

 <section id="login">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                <h1>Log in with your email account</h1>
                    <form role="form" action='<?php echo base_url();?>login/process' method="post" id="login-form" autocomplete="off">
                        <input type="hidden" name="lat" id="lat" value="" />
                        <input type="hidden" name="long" id="long" value="" />

                        <?php if($msg!="") { ?>
                          <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $msg; ?>
                          </div>
                        <?php } ?>
                        
                        <div class="clear20"></div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="username" id="username" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

</body>
</html>
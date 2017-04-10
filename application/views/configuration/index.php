<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Search</title>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css?<?php echo time(); ?>">

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/bootstrap.min.js"></script>

  <script>
    var base_url = '<?php echo base_url(); ?>';
  </script>
	
</head>
<body>

 
<div class="container">
  <div>
    <h2 class="left">City Configuration</h2>
    <span class="right"><a href="<?php echo base_url()."login/logout"; ?>">Logout</a></span>
  </div>
  <div class="clear10"></div>
	<div class="panel panel-default">
        <div class="panel-body">
            <form role="form" action='<?php echo base_url();?>configuration/index' method="post" id="form">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />                

                <?php if($this->session->flashdata('msg')!="") { ?>
                  <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php } ?>
                
                <div class="form-group input-group form-file-group">
                   <input type="text" name="city" value="<?php echo $city; ?>" id="city" class="form-control" required />
                   <span class="input-group-btn">
                        <button type="submit" class="btn btn-custom btn-lg btn-block">Save</button>
                   </span>
                </div>
                <div>
                  <p>Latitude: <?php echo $lat; ?>
                  <p>Langitude: <?php echo $long; ?>
                </div>
            </form>
        </div>

    </div>
</div> <!-- /.container -->


</body>
</html>
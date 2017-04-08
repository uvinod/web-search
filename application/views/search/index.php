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

  <script src="<?php echo base_url(); ?>assets/js/main.js?<?php echo time(); ?>"></script>	
	
</head>
<body>

 
<div class="container">
    <h2>Global Search</h2>
	<div class="panel panel-default">
        <div class="panel-body">
            <form id="form">
                <div class="form-group input-group form-file-group">
                   <input type="hidden" id="pageno" />
                   <input type="text" name="keyword" value="" id="keyword" class="form-control" placeholder="Enter your search keyword" required />
                   <span class="input-group-btn">
                        <button type="submit" class="btn btn-custom btn-lg btn-block">Search</button>
                   </span>
                </div>
            </form>
            
            <div id="data-container-google" class="data-container"></div>            
            <div id="data-container-bing" class="data-container"></div>            
        </div>

    </div>
</div> <!-- /.container -->


</body>
</html>
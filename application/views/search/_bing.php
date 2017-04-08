
  <div class="clear20"></div>
  
  <div>
  <?php if(count($results->results) > 0){ ?>
      <div id="pagination-google">
        <?php 
         echo $this->ajax_pagination->create_links(); 
        ?>
      </div> 
      <div class="clear20"></div>
      <?php
       foreach($results->results as $key => $value) { 
      ?>
          <div>      
          
            <h3><a href="<?php echo $value->link; ?>" target="_blank"><?php echo $value->title; ?></a></h3>
            <p><?php echo $value->link; ?></p>
            <p><?php echo $value->snippet; ?></p>
            
          </div>
      <?php 
      } 
    } else { ?>
      <div class="alert alert-danger form-file-group">No results found</div>
    <?php }  ?>
  </div>
  

<?php use app\classes\render;?>
<?php //var_dump(render\block_vars::all())?>


<div class="alert alert-dismissible <?php echo render\block_vars::get('message_type')?>">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><?php echo render\block_vars::get('message')?></strong>
  <p>
      <?php echo render\block_vars::get('info')?>
  </p>
  
</div>


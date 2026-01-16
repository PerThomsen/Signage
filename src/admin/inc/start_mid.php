<div class="container">
	<h1>Backend - <?php echo $grpTxtHdr; ?></h1>
	<div class="row">
	  <div class="col-lg-12 mb-4 mx-auto">
	    <div class="card border border-primary mon_border_style p-5">
	      <div class="card-body">
	        <div class="box1"><?php include_once 'inc/calendar.php';?></div>
	        <p>&nbsp</p>
          	<select class='form-control' name='languageId' id='languageId' onchange='getSelVal(this);' class='languageId'>     
      			<?php include 'inc/selector_grp.php'; ?>
      		</select>      
      		<script type="text/javascript">
        		function getSelVal(sel) {
           		var url = '<?php echo $_SERVER['PHP_SELF']; ?>' 
           		location.href=url+'?cat='+sel.value;
        		}
      		</script>
	    </div>
	</div>
</div>
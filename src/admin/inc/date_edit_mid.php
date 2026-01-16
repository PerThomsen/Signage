<script src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  var editor;
  //CKEDITOR.config.readOnly = 'false';

  function formCheck(){ 
    document.Edit.Upd.value = "submitted";
  }

</script>
<noscript>
    <p>
      <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
      support, like yours, you should still see the contents (HTML data) and you should
      be able to edit it normally, without a rich editor interface.
    </p>
</noscript>

<div class="container">
  <h1><?php echo $catTxt; ?></h1>
  <div class="row">
    <div class="col-lg-12 mb-4 mx-auto">
      <div class="card border border-primary mon_border_style p-5">
        <div class="card-header">
          <?php echo $catTxt; ?>
        </div>
        <div class="card-body">
          <form name="Edit" role="form" onSubmit="return formCheck()" action="<?php echo $updateFile; ?>">
            <input type="text" class="form-control" name="headerTxt" value="<?php echo $headerTxt; ?>">
            <textarea class="ckeditor" cols="140" id="editor1" name="bodyTxt" rows="15">
              <?php echo $bodyTxt; ?>
            </textarea>
            <input type="hidden" name="datId" value="<?php echo $datId; ?>" />
            <input type="hidden" name="catId" value="<?php echo $cat; ?>" />
            <input type="hidden" name="new" value="<?php echo $dateNew; ?>" />
            <input type="hidden" name="date" value="<?php echo $dateTxt; ?>" />
            <button name="Upd" type="submit" class="btn btn-primary">Save changes</button>
            <input class="btn btn-primary" type="button" name="SubmitCancel" value="Cancel" onclick="cancelRedirect('start.php');" /> 
            <a href="#" class="btn btn-danger" role="button">Delete</a>
          </form>
          <p>&nbsp</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_GET['error'])) {
    echo '<p class="error">Error Logging In!</p>';
}
/*
  <div class="container">
    <p>You are currently logged < ? php echo $logged ? >.</p>
  </div>
*/
?> 
  <div class="container">
    <p>&nbsp;</p>
  </div>
  <div class="container">
    <form class="form-horizontal" role="form" action="process_login.php" method="post" name="login_form">                      
      <div class="form-group">
        <label class="col-sm-2 control-label" for="email">Email address:</label>
        <div class="col-sm-4">
          <input class="form-control" autofocus type="text" name="email" />
        </div>
        <div class="col-sm-6">
          &nbsp;
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="password">Password</label>
        <div class="col-sm-4">
          <input class="form-control" type="password" name="password" id="password"/>
        </div>
        <div class="col-sm-6">
          &nbsp;
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" id="knap" onclick="formhash(this.form, this.form.password);">Login</button>
      </div> 
    </form>
  </div>

  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/forms.js"></script>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>Registreted users</h3>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>User</th>
              <th>Mail</th>
              <th>LangId</th>
              <th>Change language</th>
              <th>Administrator</th>
              <th>Edit Menu</th>
              <th>Edit Artikel</th>
            </tr>
          </thead>  
          <?php echo $usrListeTxt; ?>          
        </table>
      </div>
    </div>
  <div>   
    
  <div class="container">
    <div class="row">
      <h3>Add new user</h3>
      <div class="col-sm-5">
        <div class="well well-lg well-white">
          <form class="form-horizontal" action="<?php echo $filNavn; ?>" method="post" name="registration_form" role="form">
            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="username">
                  Username
                </label>
                <div class="col-sm-7">
                  <input type="text" class="form-control"  name='username' id='username' />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="email">
                  Email
                </label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="email" id="email" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="password">
                  Password
                </label>
                <div class="col-sm-7">
                  <input class="form-control" type="password" name="password" id="password" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="confirmpwd">
                  Confirm password
                </label>
                <div class="col-sm-7">
                  <input class="form-control" type="password" name="confirmpwd" id="confirmpwd" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="chLang">
                  Change language
                </label>
                <div class="col-sm-7">
                  <select name="chLang" id="chLang">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="editMenu">
                  Edit menu
                </label>
                <div class="col-sm-7">
                  <select name="editMenu" id="editMenu">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="editArt">
                  Edit Org. Artikel
                </label>
                <div class="col-sm-7">
                  <select name="editArt" id="editArt">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="admin">
                  Administrator
                </label>
                <div class="col-sm-7">
                  <select name="admin" id="admin">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group form-group-sm">            
                <label class="col-sm-5 control-label" for="languageId">
                  Select language
                </label>
                <div class="col-sm-7">
                  <?php echo $selector; ?>
                </div>
              </div>
            </div>

                                       
            <div class="row">
              <div class="form-group form-group-sm">            
                <div class="col-sm-5">
                  &nbsp;
                </div>
                <div class="col-sm-7">
                  <input class="btn btn-primary" type="button" value="Register" id="knap" 
                         onclick="return regformhash(this.form,
                                         this.form.username,
                                         this.form.email,
                                         this.form.password,
                                         this.form.confirmpwd);" />
                </div>
              </div>
            </div>                      
          </form>          
        </div>
      </div>

      <div class="col-sm-7">
        <div class="well well-lg well-white">
          <?php
          //echo "<p>".var_dump($_POST)."</p>";
  
          if (!empty($error_msg)) {
              echo $error_msg;
          }
          ?>
          <ul>
              <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
              <li>Emails must have a valid email format</li>
              <li>Passwords must be at least 6 characters long</li>
              <li>Passwords must contain
                  <ul>
                      <li>At least one upper case letter (A..Z)</li>
                      <li>At least one lower case letter (a..z)</li>
                      <li>At least one number (0..9)</li>
                  </ul>
              </li>
              <li>Your password and confirmation must match exactly</li>
          </ul>
        </div>
      </div>
      
    </div>
  </div>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="stylecrud.css" />
    <style>
      .error { color: red; font-size: 14px; }
      .success { color: green; font-size: 16px; font-weight: bold; margin-top: 10px; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-body">
       <form id="regForm" method="post" action="connect.php" autocomplete="off">

              <h1>Registration Form</h1>

              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required />
              </div>

              <div class="form-group">
                <label for="lastame">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required />
              </div>

              <div class="form-group">
                <label for="gender">Gender</label>
                <div>
                  <label class="radio-inline"><input type="radio" name="gender" value="M" required />Male</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="F" />Female</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="O" />Others</label>
                </div>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required/>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <span class="error" id="passError"></span>
              </div>

              <div class="form-group">
                <label for="number">Phone Number</label>
                <input type="text" class="form-control" id="number" name="number" required />
                <span class="error" id="numError"></span>
              </div>

              <input type="submit" class="btn btn-primary" value="Register" />
              <div id="successMessage" class="success"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
   <script src="indexcrud.js"></script>
  </body>
</html>

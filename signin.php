<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="StyleLogin.css">
    <title>LOGIN PAGE</title>
  </head>

  <?php
    $Email = isset($_GET["Email"]) ? $_GET["Email"] : "";
  ?>

  <body>
   <div class="container">
    <h4 class="text-center">FORM LOGIN</h4>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p style="color:red" align="center">Invalid Email/Password!</p>';
            }

            else if ($_GET['error'] == "WrongPassword") {
              echo '<p style="color:red" align="center">Invalid Email/Password!</p>';
            }

            else if ($_GET['error'] == "UserNotFound") {
              echo '<p style="color:red" align="center">User not found, please register!</p>';
            }
        }
        
        ?>
		<hr>
		<form action="process/phpsignin.php" method="POST">
      <div class="form-group">
        <label for="user_id">Email </label>
        <input type="text" name="Email" class="form-control" placeholder="Enter Your Email" id="email" value="<?=$Email;?>">
    </div>
      <div class="form-group">
        <label for="konPass">Password</label>
        <input type="password" name="konPass" class="form-control" placeholder="Enter Your Password" id="konPass">
    </div>
		<button type="submit" name="btn-submit" class="btn btn-primary">LOGIN</button>
    </form>
    <small><a href="signup.php" class="float-left text-blue">Register</a></small>
    <small><a href="form/forgot-password.php" class="float-right text-blue">Forgot Password?</a></small>
	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
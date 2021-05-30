<?php include "../includes/db.php"; ?>
<?php session_start(); ?>


 <?php 
 
   if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_user_query = mysqli_query($conn ,$query);
         if(!$select_user_query) {
           die("QUERY FAİLED :".mysqli_error($conn));
         }
         while($row =mysqli_fetch_assoc($select_user_query)){
             $db_user_id = $row["user_id"];
             $db_user_name = $row["user_name"];
             $db_user_password = $row["user_password"];
             $db_user_email = $row["user_email"];
             $db_user_role = $row["user_role"];
         } 

         if($username !== $db_user_name && $password !== $db_user_password) {
                header("Location: login.php");

         }else if($username == $db_user_name && $password == $db_user_password) {
              $_SESSION["username"] = $db_user_name;
              $_SESSION["password"] = $db_user_password;
              $_SESSION["email"] = $db_user_email;
              $_SESSION["role"] = $db_user_role;

                 header("Location: index.php");

         } 
            else {
              header("Location: login.php");
            }

   }
    
 
 
 ?>




<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputUsername">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
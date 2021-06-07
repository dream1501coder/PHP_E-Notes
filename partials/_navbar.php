
  <?php 


$login=false;
$logrev=false;

  if (!isset($_SESSION['Loggedin']) || $_SESSION['Loggedin']!=true) {
    $logrev=true;
}
else{
    $login_user=$_SESSION['username'];
    // echo $login_user;
    $login=true; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  
<?php
  echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-Notes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
      if ($logrev) {
      echo  ' 
      <li class="nav-item">
        <a class="nav-link" href="signup.php">SignUp</a>
      </li>
       
        <li class="nav-item">
          <a class="nav-link" href="index.php">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
    </li>';
      }
       if ($login) {
        echo'<li class="nav-item">
        
        <a class="nav-link active" aria-current="page" href="notes.php">Home</a>
      </li>       <li class="nav-item">
      <a class="nav-link" href="#">About Us</a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="#">Contact Us</a>
  </li>
     
      
       
</ul><p class="text-light my-0 mx-2"> Hiii '.$login_user.'</p>
      
        <a href="logout.php" class="btn btn-outline-success ml-2"><i class="fa fa-power-off"></i></a>
     ';
    }
    echo'</div>
  </div>
</nav>';
?>
   </body>
</html>
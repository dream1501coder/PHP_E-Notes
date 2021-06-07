<?php
include "partials/_dbconnect.php";

$showerror="";

    $alert=false;
    $error=false;
if($_SERVER['REQUEST_METHOD']=="POST"){

    $user=$_POST['email'];
    $pass=$_POST['pwd'];
    $cpass=$_POST['cpwd'];


    $existSql = "SELECT * FROM `login_details` WHERE username='$user'";
    
    $resExist=mysqli_query($conn,$existSql);
    $numExist=mysqli_num_rows($resExist);

    if ($numExist>0) {
        $error=true;
        $showerror="username already exists plz try another username";
        

    }else{

        if ($pass==$cpass) {
            $pwdhash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="insert into login_details(`username`,`password`) values ('$user','$pwdhash');";
            $result=mysqli_query($conn,$sql);
            if($result){
                $alert=true;
            }
        }
        else{
            $showerror="Password did't matched";
            $error=true;


        }
    }
    

}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>PHP E-Notes | Signup</title>
    </head>

    <body>
        <?php
            include "partials/_navbar.php";
            ?>
            <?php
                if($alert){
                    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">  
                    <div>
                    Registered Successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    </div>';
                }
                if($error){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">  
                    <div>'
                .$showerror.
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    </div>';
                }
                ?>

            <div class="container my-3 col-md-6">
            <h3>SignUp to our LoginSys</h3>
                <form action="signup.php" method="post">

                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="text" required class="form-control" id="email" name="email" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password</label>
                        <input type="password" required  class="form-control" name="pwd" id="pwd">
                    </div>
                    <div class="mb-3">
                        <label for="cpwd" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpwd" id="cpwd">
                        <div id="emailHelp" required  class="form-text">Make sure you typed same password.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">SignUp</button>
                </form>
            </div>


            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    </body>

    </html>
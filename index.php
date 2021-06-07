<?php
include "partials/_dbconnect.php";
$showerror="";

$success=false;
$failer=false;

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $user=$_POST['email'];
    $pass=$_POST['pwd'];

    $sql = "SELECT * FROM `login_details` WHERE username='$user';";
    
    $result=mysqli_query($conn,$sql);
    
    $exist=mysqli_num_rows($result);

    if ($exist>0) {

        while($row=mysqli_fetch_assoc($result)){

            // password_verify() generates hash of given string as pwd(first para) and then matches to the hashed password(second para) stored in db 
            if(password_verify($pass,$row['password'])){

                $success=true; 
                session_start();
                $_SESSION['Loggedin']=true;
                $_SESSION['username']=$user;
                 
                header('location:notes.php');
            }
            else{
                $showerror="Invalid Credentials";
                $failer=true;
        
            }
            
        }

     
        // exit;
        
    }
    else{
        $showerror="No user exist named ".$user;
        $failer=true;

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

        <title>PHP E-Notes | Login</title>
    </head>

    <body>
        <?php
include "partials/_navbar.php";
?>
<?php
    if($success){
        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">  
        <div>
        Logged in' .$user.
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
    }
    if($failer){
        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">  
        <div>'
    .$showerror.
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
    }
?>

            <div class="container my-3 col-md-6">
            <h3>Login to our LoginSys</h3>

                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="text" class="form-control"  required id="email" name="email" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password</label>
                        <input type="password" class="form-control" required  name="pwd" id="pwd">
                    </div>
                   

                    <button type="submit" class="btn btn-primary">Login</button>
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
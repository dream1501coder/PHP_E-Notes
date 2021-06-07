<?php
include "partials/_dbconnect.php";
$validuser=false;
session_start();

if (!isset($_SESSION['Loggedin']) || $_SESSION['Loggedin']!=true) {
    header('location:login.php');
}
else{
    $current=$_SESSION['username'];
    $validuser=true; 
}

?>

<?php

$insert=false;
$update=false;
$delete=false;




// ALTER TABLE `notes` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);

if(isset($_GET['delete'])){
  $sno=$_GET['delete'];

  $sql="DELETE FROM `notes` WHERE `id` = '$sno';";

  $result=mysqli_query($conn,$sql);

  if($result){

    $delete=true;
         
  }
        
}
// for insertion
if($_SERVER['REQUEST_METHOD']=='POST'){
  if (isset($_POST['snoEdit'])){
    $sno=$_POST['snoEdit'];
    $title = $_POST['titleedit'];
    $desc = $_POST['descedit'];
  
  $sql="UPDATE `notes` SET `title` = '$title' , `desc` = '$desc' WHERE `id` = '$sno';";

  $result=mysqli_query($conn,$sql);

  if($result){

    $update=true;
    // echo "updated";
         
  }
  }
  else{

 
$title = $_POST['title'];
$desc = $_POST['desc'];


$sql="INSERT INTO `notes` (`title`, `desc`) VALUES ('$title', '$desc');";


$result=mysqli_query($conn,$sql);

if($result){

$insert=true;
     
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <title>PHP E-Notes</title>
</head>

<body>

    <!-- Button edit modal -->


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?update=true" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleedit" name="titleedit" placeholder="Enter Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Note Description</label>
                            <textarea class="form-control" id="descedit" rows="5" name="descedit" placeholder="Enter Description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                        <input type="reset" value="Reset" class="btn btn-danger">
                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <?php
include "partials/_navbar.php";
?>
    <?php
    if($insert){
        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
  
             </symbol>
        <div  class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      <div>
        Your Note has been inserted successfully.
       
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>';
}
if($update){
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>

         </symbol>
    <div  class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Your Note has been Updated successfully.
   
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>';
}

if($delete){
// echo"<script>window.location=`/PHP_E-Notes/index.php?delete=${sno}`;</script>";
echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
  </svg>

  <div  class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
<div>

Your Note has been deleted Successfully. 
  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  </div>
</div>';
    } 
?>

    

        <div class="container my-3">
            <h2>Add a New Note to E-Notes</h2>
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Note Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Note Description</label>
                    <textarea class="form-control" id="desc" rows="5" name="desc" placeholder="Enter Description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Note</button>
                <input type="reset" value="Reset" class="btn btn-danger">
            </form>
        </div>

        <div class="container">
            <?php
    $sql="select * from notes";
    // $sql='select * from login_details where `email`="guptalaxmi1512@gmail.com" LIMIT 3';
    $result=mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    // echo "<br>". $count ." records found"."<br>";
    $sn=1;
    echo '<table class="table table-striped table-bordered my-4" id="myTable">
    <thead class="text-center">
        <tr>
            <th scope="col">Sno.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody><tr>';

    while($rows=mysqli_fetch_assoc($result)){
       
        $description=$rows['desc'];

        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $desc1 = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $description);

        echo "<th>".$sn."</th><td>".$rows['title']."</td><td>".$desc1."</td><td class='text-center'><div class='btn btn-primary fa fa-edit mx-4 edit' id=".$rows['id']."></div><div class='btn btn-danger fa fa-trash delete' id=d".$rows['id']."></div></td></tr>";
        $sn=$sn+1;
    
    }
    echo "</table>";
?>
        </div>



        <script>
            edits = document.getElementsByClassName('edit');
            Array.from(edits).forEach((element) => {
                element.addEventListener("click", (e) => {
                    console.log("edit", );
                    tr = e.target.parentNode.parentNode;
                    title = tr.getElementsByTagName("td")[0].innerText;
                    desc = tr.getElementsByTagName("td")[1].innerText;
                    console.log(title, desc);
                    titleedit.value = title;
                    descedit.value = desc;
                    snoEdit.value=e.target.id;
                    console.log(e.target.id);
                    $('#editModal').modal('toggle');
                })

            })
            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    console.log("delete", );

                    sno=e.target.id.substr(1,);
                    // tr = e.target.parentNode.parentNode;
                    // title = tr.getElementsByTagName("td")[0].innerText;
                    // desc = tr.getElementsByTagName("td")[1].innerText;
                    
                    if (confirm("Are you sure you want to delete this note ?? ")) {
                        console.log("yes");
                        window.location=`/PHP_E-Notes/index.php?delete=${sno}`;
                    }
                    else{
                        console.log("no");
                         
                    }
                })

            })
        </script>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



</body>

</html>
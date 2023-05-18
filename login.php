<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
include('connect.php');
$name=$_POST['name'];
$email=$_POST['email'];
$amount=$_POST['amount'];

$validmail="SELECT * FROM `users` WHERE email='$email'";
$result=mysqli_query($con,$validmail);
$numExistRow=mysqli_num_rows($result);
  if ($numExistRow>0){
   echo ('already exist ,give another one');
   }
    else{
    $sql="INSERT INTO `users`(`name`,`email`,`amount`) VALUES('$name','$email','$amount');";
    $result=mysqli_query($con,$sql);
    if($result){
       echo ('Congrats,new user successfully created');
    }
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usercreate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
</head>
<style>
    body{
        background-color: aliceblue;
    }
</style>
<body>
    <div class="login">
        
    </div>
    <section >
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sn-8 col-md-6 m-auto border-radious-5">
                    <div class="card">
                       <div class="card-body bg-info">
                        <p class="text-center"><i class="fa-light fa-user">Create User</i></p>
                        <form action="" method="POST">
                            <input type="text" name="name" id="name" class="form-control my-4 py-3" placeholder="Enter Name" required>
                            <input type="text" name="email" id="email" class="form-control my-4 py-3" placeholder="Enter Email" required>
                            <input type="text" name="amount" id="amount" class="form-control my-4 py-3" placeholder="Amount" required>
                            <div class="text-center">
                                <button class="btn btn-secondary mt-3" type="submit"><a href="" class="nav-link "></a>Add User</button>
                                <!-- <a href="" class="nav-link">Already have an account?</a> -->
                                
                            </div>
                        </form>
                        <button class="btn btn-secondary mt-3" type="submit"><a href="index.php" class="nav-link "></a>Back to Home</button>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
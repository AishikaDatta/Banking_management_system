<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ('connect.php');

    $from = $_GET['id'];
    $to = $_POST['to'];
    $credit = $_POST['credit'];

    $sql = "SELECT * from `users` where id=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from `users` where id=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);

   
    if (($credit)<0) {
        echo '<script type="text/javascript">alert("Oops! Negative values cannot be Transferred") </script>';
    }

  
    else if($credit > $sql1['amount']) {
        echo '<script type="text/javascript">alert("Oops! Insufficient Amount") </script>';
    }
    
   
    else if($credit == 0) {
        echo '<script type="text/javascript">alert("Oops! Zero value cannot be Transferred") </script>';
    }

    else {
        
      
        $newamount = $sql1['amount'] - $credit;
        $sql = "UPDATE users set amount=$newamount where id=$from";
        mysqli_query($con,$sql);
        

       
        $newamount = $sql2['amount'] + $credit;
        $sql = "UPDATE users set amount=$newamount where id=$to";
        mysqli_query($con,$sql);
        
        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transactions(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$credit')";
        $query=mysqli_query($con,$sql);

       
        if($query){
            echo "<script> alert('Transaction Successful'); window.location='index.php'; </script>"; 
        }

        $newamount= 0;
        $credit =0;
    }   
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    

    <?php
        include ('connect.php');
        $sid=$_GET['id'];
        $sql = "SELECT * FROM  users where id=$sid";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo "Error : ".$sql."<br>".mysqli_error($con);
        }
        $row=mysqli_fetch_assoc($result);
    ?>
    <h1 class="text-center bg-info mt-5 p-4">All users</h1>
    <div class="container">
        <table class="table">
            <thead>
              <tr class="table-secondary p-4" >
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Balence</th>
              </tr>
            </thead>
            <?php 
                echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['amount'].'</td>
                </tr>
                ';
            ?>
            </table>
            </div>
            <form action="" method="post">
                <select id="select" name="to" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                    <option selected>Transfer money to</option>
                    <?php
                    $sql = "SELECT * FROM  users where id!=$sid";
                    $result=mysqli_query($con,$sql);
                    if(!$result)
                    {
                        echo "Error : ".$sql."<br>".mysqli_error($con);
                    }
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                    } 
                ?>
                  </select>
                  <input type="number" name="credit" class="form-control my-4 py-3" placeholder="AMOUNT" required>
                  <button type="submit" class="btn btn-secondary mt-3">TRANSFER</button>;
            </form>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>     
</body>
</html>
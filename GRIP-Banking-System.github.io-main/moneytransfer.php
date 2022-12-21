<?php
include 'dbcon.php';

if (isset($_POST['submit'])){
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * FROM users where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query);// returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * FROM users where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);




    // constraint to check input of negative value by user
    if(($amount)<0){
      echo '<script type="text/javascript">';
      echo ' alert("Negetive values cannot be transferred.")';
      echo "</script>";
    }



    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) {
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance.")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if ($amount == 0) {
        echo "<script type='text/javascript'>";
        echo "alert('Zero value cannot be transferred.')";
        echo "</script>";
    }


    else{
      // deducting amount from sender's account
      $newbalance = $sql1['balance'] - $amount;
      $sql = "UPDATE users set balance = $newbalance where id=$from";
      mysqli_query($conn, $sql);

      // adding amount to receiver's account
      $newbalance = $sql2['balance'] + $amount;
      $sql = "UPDATE users set balance = $newbalance where id = $to";
      mysqli_query($conn, $sql);

      $sender = $sql1['name'];
      $receiver = $sql2['name'];
      $sql = "INSERT INTO transaction(`sender`,`receiver`,`balance`) VALUES ('$sender','$receiver','$amount')";
      $query = mysqli_query($conn, $sql);

      if ($query) {
        echo "<script> alert('Transaction successful');
                        window.location='transactionhistory.php';
                        </script>";
      }

      $newbalance = 0;
      $amount = 0;

    }
}
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>TRANSFER</title>

     <link rel="stylesheet" href="css/moneytransfer.css">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

     <script src="https://kit.fontawesome.com/06f98189ab.js" crossorigin="anonymous"></script>


     <style type="text/css">

        button:hover {
            transform: scale(1.1);
        }
    </style>



   </head>
   <body style="background-color:white;">

     <?php
      include "navbar.php";
      ?>

      <div class="container">
        <h2 class="text-center pt-4" style="color : black;">TRANSACTION</h2>
        <?php
        include 'dbcon.php';
        $sid = $_GET['id'];
        $sql = "SELECT * FROM  users where id=$sid";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        }
        $rows = mysqli_fetch_assoc($result);
        ?>
        <form method="post" name="tcredit" class="tabletext"><br>
            <div>
                <table class="table table-striped table-condensed table-bordered">
                    <tr style="color : white;">
                        <th class="text-center" style="background-color:#330010;">Id</th>
                        <th class="text-center" style="background-color:#330010;">Name</th>
                        <th class="text-center" style="background-color:#330010;">Email</th>
                        <th class="text-center" style="background-color:#330010;">Balance</th>
                    </tr>
                    <tr style="color : black;">
                        <td class="py-2"><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['name'] ?></td>
                        <td class="py-2"><?php echo $rows['email'] ?></td>
                        <td class="py-2"><?php echo $rows['balance'] ?></td>
                    </tr>
                </table>
            </div>
            <br><br><br>
            <label style="color : black;"><b>Transfer To:</b></label>
            <select name="to" class="form-control" required>
                <option value="" disabled selected>Choose</option>
                <?php
                include 'config.php';
                $sid = $_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Error " . $sql . "<br>" . mysqli_error($conn);
                }
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <option class="table" value="<?php echo $rows['id']; ?>">

                        <?php echo $rows['name']; ?> (Balance:
                        <?php echo $rows['balance']; ?> )

                    </option>
                <?php
                }
                ?>
                <div>
            </select>
            <br>
            <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>
            <br><br>
            <div class="text-center">
                <button class="btn btn-lg btn-success mt-3" name="submit" type="submit" id="myBtn" style="background-color:#330010;">Transfer</button>
            </div>
        </form>
    </div>






    <?php
      include "footer.php";
    ?>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
 </html>

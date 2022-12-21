<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transaction History</title>

    <link rel="stylesheet" href="css\transactionhistory.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/06f98189ab.js" crossorigin="anonymous"></script>

  </head>
  <body style="background-color:white;">
    <?php
      include "navbar.php"
     ?>

     <div class="container">
       <h1 class="text-center py-4" style="color:black;">TRANSACTION HISTORY</h1>

       <br>
       <div class="table-responsive-sm">
         <table class="table table-hover table-condensed table-bordered table-light" >
           <thead class="bg-secondary" style="color:white;">
             <tr>
               <th class="text-center" style="background-color:#330010;">S.num</th>
               <th class="text-center" style="background-color:#330010;">Sender</th>
               <th class="text-center" style="background-color:#330010;">Receiver</th>
               <th class="text-center" style="background-color:#330010;">Balance</th>
               <th class="text-center" style="background-color:#330010;">Date & Time</th>
             </tr>
           </thead>

           <tbody>
             <?php
                    include 'dbcon.php';

                    $sql = "SELECT * FROM `transaction`";
                    $query = mysqli_query($conn, $sql);

                    while ($rows = mysqli_fetch_assoc($query)) {

                    ?>

                        <tr style="color: black;">
                            <td class="py-2"><?php echo $rows['snum']; ?><b></td>
                            <td class="py-2"><?php echo $rows['sender']; ?></td>
                            <td class="py-2"><?php echo $rows['receiver']; ?></td>
                            <td class="py-2"><?php echo $rows['balance']; ?></td>
                            <td class="py-2"><?php echo $rows['datetime']; ?></td>
                        </tr>

                    <?php
                    }

                    ?>
           </tbody>

         </table>

       </div>
     </div>



     <?php
      include "footer.php";
    ?>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

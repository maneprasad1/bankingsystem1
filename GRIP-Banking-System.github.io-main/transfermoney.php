<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transfer Money</title>

    <link rel="stylesheet" href="css/transfermoney.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/06f98189ab.js" crossorigin="anonymous"></script>



  </head>
  <body style="background-color:white;">
    <?php
      include "navbar.php"
     ?>

     <?php
        include 'dbcon.php';
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
      ?>

     <div class="container" >
       <h1 class="text-center py-4" style="color:black">TRANSFER MONEY</h1>
        <div class="row">
          <div class="col">
            <div class="table-responsive-sm">
              <table class="table table-medium table-hover table-sm  table-condensed table-bordered" style="Border-color:black;" >
                <thead class="bg-secondary" style="color:white;">
                  <tr>
                    <th scope="col" class="text-center py-2"  style="background-color:#330010;">ID</th>
                    <th scope="col" class="text-center py-2" style="background-color:#330010;">Name</th>
                    <th scope="col" class="text-center py-2" style="background-color:#330010;">Email</th>
                    <th scope="col" class="text-center py-2" style="background-color:#330010;">Mobile</th>
                    <th scope="col" class="text-center py-2" style="background-color:#330010;">Balance</th>
                    <th scope="col" class="text-center py-2" style="background-color:#330010;">Operation</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($rows = mysqli_fetch_assoc($result)) {
                  ?>

                        <tr>
                          <td><?php echo $rows['id'] ?></td>
                          <td><?php echo $rows['name'] ?></td>
                          <td><?php echo $rows['email'] ?></td>
                          <td><?php echo $rows['mobile'] ?></td>
                          <td><?php echo $rows['balance'] ?></td>
                          <td><a href="moneytransfer.php?id=<?php echo $rows['id'] ?>"><button type="button" class="btn btn-success" style="background-color:#330010;">Transfer</button></a></td>
                        </tr>
                  <?php
                    }
                   ?>

                </tbody>
              </table>
            </div>
          </div>
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

<?php
require 'dbconnection.php';

?>

<?php
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(!isset($_SESSION['AccountId']))
        {
            echo "<script>window.location.href='login.php';</script>";
        }
        require_once "dbconnection.php";
    ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<style>
    h2 {
  position: relative;
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-weight: 300;
  font-size: 40px;
  color: #080808;
  -webkit-transition: all 0.4s ease 0s;
  -o-transition: all 0.4s ease 0s;
  transition: all 0.4s ease 0s;
  margin:20px;
}
    .seven h2 {
text-align: center;
    font-size:30px; font-weight:300; color:#222; letter-spacing:1px;
    text-transform: uppercase;

    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-template-rows: 27px 0;
    grid-gap: 20px;
    align-items: center;
}

.seven h2:after,.seven h2:before {
    content: " ";   
    display: block;
    border-bottom: 1px solid #c50000;
    border-top: 1px solid #c50000;
    height: 5px;
  background-color:#f8f8f8;
}
</style>
    <title>History</title>

</head>

<body>
    <!-- <div class="seven">
    <h2>History</h2>
    </div> -->
    <?php require_once 'navigation.php'; ?>
    <header class="text-center py-4 m-0 bg-dark text-light d-flex align-items-center">
        <button class="btn btn-primary navbar-toggler bg-dark text-light navbar-dark col-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#navigation">
            <span class="navbar-toggler-icon text-secondary"></span>
        </button>    
        <h1 class="col-10">History</h1>
    </header>
    <div class="container my-4">
    <div class="seven">
    </div>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Mode</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>

                <!-- <tr>
                    <th scope='row'>1</th>
                    <td>18956</td>
                    <td>187452</td>
                    <td>50000</td>
                    <td>Govt to pvt</td>
                    <td>24/08/2002</td>
                </tr> -->

                <?php 
          $sql = "SELECT * FROM `transactionhistory`";
          $result = mysqli_query($con, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sql3 = "SELECT * FROM `mode` where ModeId=".$row['Mode'];
            $result2 = mysqli_query($con, $sql3);
            $row2 = mysqli_fetch_assoc($result2);

            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['FromAcc'] . "</td>
            <td>". $row['ToAcc'] . "</td>
            <td>". $row['Amount'] . "</td>
            <td>". $row2['Mode'] . "</td>
            <td>". $row['Date'] . "</td>
          </tr>";
        } 
          ?>

            </tbody>
        </table>
    </div>
    <hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>

</body>

</html>
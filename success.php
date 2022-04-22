<?php
session_start();
require 'dbconnection.php';

$id= $_SESSION['AccountId'];

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <title>Success</title>

</head>

<body>
    <!-- <div class="seven">
    <h2>History</h2>
    </div> -->
    <div class="container my-4">
    <div class="seven">
    <h2>Success</h2>
    </div>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Date And Time</th>
                    <th scope="col">Amount Transfer</th>
					<th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">From Type</th>
                    <th scope="col">To Type</th>
                   
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
            $response = json_decode($_GET['response'], true);
            echo "<tr>
                    <td>". $_GET['date'] . "</td>
                    <td>". $_GET['amt'] . "</td>
                    <td>". $_GET['from'] . "</td>
                    <td>". $_GET['to'] . "</td>
                    <td>". $_GET['fromType'] . "</td>
                    <td>". $_GET['toType'] . "</td>
                </tr>";
       ?>

            </tbody>
        </table>
    </div>
    <hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>

</body>

</html>
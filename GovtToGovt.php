<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Govt to Govt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    
    body
    {
        background: #DDD;
    }
    h1,h2,h3,h4,h5,h6{
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
    }
    .heading
    {
    background: #54229d;
    }
    </style>
<body>
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
        if(isset($_POST['account']))
        {        
            $sql = "SELECT * FROM account WHERE accountId = '{$_SESSION['AccountId']}'";
            $result = mysqli_query($con,$sql);
            $result1 = mysqli_fetch_assoc($result);
            $hash = $result1['HashNumber'];
            $currentBalance = $result1['BalanceGovt'];
            $amt = $_POST['amt'];
            
            if($currentBalance >= $amt)
            {
                if(mysqli_num_rows($result)==1)
                {
                    $sql = "UPDATE account SET BalanceGovt = BalanceGovt-{$_POST['amt']} WHERE AccountId= '{$_SESSION['AccountId']}'";
                    $result = mysqli_query($con,$sql);
                    $sql = "UPDATE account SET BalancePvt = BalancePvt+{$_POST['amt']} WHERE AccountId= '{$_SESSION['AccountId']}'";
                    $result = mysqli_query($con,$sql);
                    $date = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO `TransactionHistory` VALUES(NULL,'{$hash}','{$hash}','{$amt}','{$date}','1','{$_SESSION['AccountId']}','{$_SESSION['AccountId']}')";
                    $result = mysqli_query($con,$sql);
                    
                    echo "Success";
                }
                else
                {
                    echo "Account Not Exist";
                }
            }
            else
            {
                echo "Insufficient Balance";
            }
            
            
        }
    ?>
    <header>
        <h1 class="text-center py-4 m-0 bg-dark text-light">Transfer Govt To Govt</h1>
    </header>
    <section>
        <h4 class="text-center display-6 py-4 m-0 heading mb-4 text-light">Welcome <?php echo $_SESSION['Name'];?></h1>
    </section>
    <section class="d-flex my-4 flex-wrap">
        <div class="col-md-6 col-sm-12 col-12 text-center">
            <h3 class="mb-4">Available Amount</h3>
            <div class="mx-4">
                <table class="table table-responsive text-center">
                  <thead>
                    <tr>
                      <th scope="col">Sr No.</th>
                      <th scope="col">Partition Type</th>
                      <th scope="col">Amount Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Govt</td>
                      <?php 
                        $sql = "SELECT * FROM account WHERE accountId = '{$_SESSION['AccountId']}'";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $BalanceGovt = $row['BalanceGovt'];
                        $BalancePvt = $row['BalancePvt'];
                      ?>
                      <td><?php echo $BalanceGovt; ?> Rs.</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Private</td>
                      <td><?php echo $BalancePvt; ?> Rs.</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <th colspan="1">Total Amount</th>
                      <th><?php echo $BalanceGovt+$BalancePvt ?>Rs.</th>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12 text-center m-0 d-flex align-items-center flex-wrap">
            <h3 class="col-12">Amount To Transfer</h3>
            <div class="my-2 col-12">
                <form action="#" method="post" class="w-75 mx-auto" id="GovtToGovt">
                    <div class="form-floating m-2 d-flex align-items-center h-100">
                        <input type="text" name="account" id="account" min="0" placeholder="Transfer To SELF" class="form-control mx-auto" disabled>
                        <label for="amt">Transfer To SELF</label>
                    </div>
                    <div class="form-floating m-2 d-flex align-items-center h-100">
                        <input type="number" name="amt" id="amt" min="0" placeholder="Enter The Amount" class="form-control mx-auto" required>
                        <label for="amt">Enter The Amount</label>
                    </div>
                    <button type="submit" class="btn btn-success">Transfer</button>
                </form>
            </div>
        </div>
    </section>
    <section>
        <h4 class="text-center display-6 py-4 m-0 heading text-light">Transfer History</h1>
        <table class="table table-responsive table-light text-center">
          <thead>
            <tr>
              <th scope="col">Sr No.</th>
              <th scope="col">Date</th>
              <th scope="col">Amount</th>
              <th scope="col">To (Account)</th>
              <th scope="col">To (Type) </th>
            </tr>
          </thead>
          <tbody>
            <?php
                $sql = "SELECT * FROM transactionHistory WHERE FromAccId='{$_SESSION['AccountId']}' AND ToAccId='{$_SESSION['AccountId']}' AND Mode = '1'";
                $result = mysqli_query($con,$sql);
                $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {
            ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $row['Date']; ?></td>
                    <td><?php echo $row['Amount']; ?></td>
                    <td><?php echo $row['ToAccId']; ?></td>
                    <?php
                        $sql = "SELECT * FROM mode WHERE modeId={$row['Mode']}";
                        $result1 = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result1);
                    ?>
                    <td><?php echo $row['Mode']; ?></td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $(document).on("submit","#GovtToGovt", (e)=>{
            e.preventDefault();
            let amt = $("#GovtToGovt #amt").val();
            let account = $("#GovtToGovt #account").val();
            if(amt<=100000)
            {
                $.ajax({
                    type: "POST",
                    url: "<?php $_SERVER['PHP_SELF'] ?>",
                    data: {amt : amt, account : account},
                    success: function (response) {
                        if(response == "Success")
                        {
                            alert("Amount Transfer Successful");
                            window.location.href="<?php echo $_SERVER['PHP_SELF']; ?>";
                        }
                        else
                        {
                            alert(response);
                        }
                    }
                });
            }
            else
            {
                alert("You Don't Have Sufficient Balance To Transfer");
            }
        });
    });
    
</script>
</html>
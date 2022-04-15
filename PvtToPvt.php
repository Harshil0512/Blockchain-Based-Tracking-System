<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Pvt To Pvt</title>
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
        
    ?>
    <header>
        <h1 class="text-center py-4 m-0 bg-dark text-light">Transfer Pvt To Pvt</h1>
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
                <form action="#" method="post" class="w-75 mx-auto" id="PvtToPvt">
                    <div class="form-floating m-2 d-flex align-items-center h-100">
                        <input type="text" name="account" id="account" min="0" placeholder="Enter Account No." class="form-control mx-auto" required>
                        <label for="amt">Enter Account No.</label>
                    </div>
                    <div class="form-floating m-2 d-flex align-items-center h-100">
                        <input type="number" name="amt" id="amt" min="0" placeholder="Enter The Amount" class="form-control mx-auto" required>
                        <label for="amt">Enter The Amount</label>
                    </div>
                    <button type="submit" class="btn btn-success" >Transfer</button>
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
                $sql = "SELECT * FROM transactionHistory WHERE (FromAccId='{$_SESSION['AccountId']}' OR ToAccId='{$_SESSION['AccountId']}') AND Mode = '3'";
                $result = mysqli_query($con,$sql);
                $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {
            ?>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
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
    <div class="modal fade" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header heading">
                <h5 class="modal-title text-light" id="staticBackdropLabel">Confirm Transaction</h5>
                <button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bold" id="confirmText">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">Cancel</button>
                <form action="PvtToPvt.php" method="POST" id="confirmForm">
                    <button type="submit" class="btn heading text-light" name="confirm">Confirm</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" id="confirmBtn" data-bs-target="#confirm"></button>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $(document).on("click","#cancel", (e)=>{
            window.location.href="PvtToPvt.php";
        });
        $(document).on("submit","#PvtToPvt", (e)=>{
            e.preventDefault();
            let amt = $("#PvtToPvt #amt").val();
            let account = $("#PvtToPvt #account").val();
            $("#confirmText").text(`Are You Want Sure To Transfer Rs. ${amt} From Your Government Partition To Private Partition ?`);
            if(amt<=100000)
            {
                $('#confirmBtn').click();
                    $(document).on("submit","#confirmForm", (e)=>{
                        e.preventDefault();
                        $.ajax({
                        type: "POST",
                        url: "PvtToPvtConfirm.php",
                        data: {amt : amt, account : account},
                        success: function (response) {
                            if(response=="Success")
                            {
                                alert("Transfer Successful");
                                window.location.href="PvtToPvt.php";
                            }
                            else
                            {
                                alert(response);
                                window.location.href="PvtToPvt.php";
                            }
                            
                        },
                        error: function(response)
                        {
                            alert("Account Doesn't Exists !!");
                            window.location.href="PvtToPvt.php";
                        }
                    });
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
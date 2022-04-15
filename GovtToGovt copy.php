<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Govt to Pvt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        require_once "dbconnection.php";
        if(isset($_POST['account']))
        {
            $sql = "SELECT * FROM account WHERE accountId = '{$_POST['account']}'";
            $result = mysqli_query($con,$sql);
            $hash = mysqli_fetch_assoc($result)['HashNumber'];
            $amt = $_POST['amt'];
            if(mysqli_num_rows($result)==1)
            {
                $sql = "UPDATE account SET BalancePvt = BalancePvt-{$_POST['amt']} WHERE AccountId= '190280107057'";
                $result = mysqli_query($con,$sql);
                $sql = "UPDATE account SET BalancePvt = BalancePvt+{$_POST['amt']} WHERE AccountId= '{$_POST['account']}'";
                $result = mysqli_query($con,$sql);
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO TransactionHistory VALUES('NULL','33e71616c0bf13936a210cc69630db680002','{$hash}','{$amt}','{$date}','1','190280107057','{$_POST['account']}')";
                $result = mysqli_query($con,$sql);
                echo "Success";
            }
            else
            {
                echo "Account Not Exist";
            }
        }
    ?>
    <header>
        <h1 class="text-center py-4 m-0 bg-dark text-light">Transfer Govt To Govt</h1>
    </header>
    <section>
        <h4 class="text-center display-6 py-4 m-0 bg-secondary text-light">Harshil Khamar</h1>
    </section>
    <section class="d-flex">
        <div class="col-6 text-center">
            <h3>Available Amount</h3>
            <div>
                <table class="table">
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
                      <td>100000 Rs.</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Private</td>
                      <td>100000 Rs.</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <th colspan="1">Total Amount</th>
                      <th>200000 Rs.</th>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="col-6 text-center d-flex align-items-center flex-wrap">
            <h3 class="col-12">Amount To Transfer</h3>
            <div class="my-2 mx-4 col-12">
                <form action="#" method="post" class="w-75 mx-auto" id="GovtToGovt">
                    <div class="form-floating m-2 d-flex align-items-center h-100">
                        <input type="number" name="account" id="account" min="0" placeholder="Enter The Account" class="form-control mx-auto" required>
                        <label for="amt">Enter The Account No.</label>
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
        <h4 class="text-center display-6 py-4 bg-secondary text-light">Transfer History</h1>
        <table class="table">
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
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
              <td>@mdo</td>     
            </tr>
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
            if(amt<100000)
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
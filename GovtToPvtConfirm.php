<?php
    require_once "dbconnection.php";
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['AccountId']))
    {
        echo "<script>window.location.href='login.php';</script>";
    }
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
                $sql = "INSERT INTO `TransactionHistory` VALUES(NULL,'{$hash}','{$hash}','{$amt}','{$date}','2','{$_SESSION['AccountId']}','{$_SESSION['AccountId']}')";
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
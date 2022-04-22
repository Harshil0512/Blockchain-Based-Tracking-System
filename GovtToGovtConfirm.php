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
        $accountId = $_POST['account'];
        $sql = "SELECT * FROM account WHERE accountId = '{$accountId}'";
        $result = mysqli_query($con,$sql);
        $result = mysqli_fetch_assoc($result);
        $hashTo = $result['HashNumber'];
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
                $sql = "UPDATE account SET BalanceGovt = BalanceGovt-{$amt} WHERE AccountId= '{$_SESSION['AccountId']}'";
                $result = mysqli_query($con,$sql);
                $sql = "UPDATE account SET BalanceGovt = BalanceGovt+{$amt} WHERE AccountId= '{$accountId}'";
                $result = mysqli_query($con,$sql);
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO `TransactionHistory` VALUES(NULL,'{$hash}','{$hashTo}','{$amt}','{$date}','1','{$_SESSION['AccountId']}','{$accountId}')";
                $result = mysqli_query($con,$sql);
                $output['from'] = $_SESSION['AccountId'];
                $output['to'] = $accountId;
                $output['date'] = $date;
                $output['amt'] = $amt;
                $output['fromType'] = "Govt";
                $output['toType'] = "Govt";
                echo json_encode($output);
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
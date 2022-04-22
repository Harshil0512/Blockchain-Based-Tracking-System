<?php
    session_start();
    session_reset();
    session_destroy();
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<body style="background : #eee;">
    <div style="height:20vh" class="d-flex justify-content-center align-items-center">
        <h1 class="text-center text-success my-auto">You Are Logged Out Successfully !!</h1>
    </div>
    <a href="login.php" class="text-decoration-none"><h2 class="text-center col-12 text-primary">Click Here To Login Again</h2></a>
</body>

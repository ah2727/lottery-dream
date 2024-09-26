<?php
session_start();
$errorMsg = '';
if (isset($_SESSION['errorMsg'])){
    $errorMsg = $_SESSION['errorMsg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>is a traning</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Style . CsS -->
    <link rel="stylesheet" href="../style.css">

</head>
<body style="background-color: #f45b69">
<form class="login" method="post" action="LoginPage.php" >
    <h5 class="text-center size-20">welcome</h5>
    <input type="email" placeholder="Email" class="border" name="Email">
    <input type="password" placeholder="Password" class="border" name="password">
    <input type="submit" class="btn btn-primary bg-primary" value="login" name="submit" >
    <p class="text-warning"><?=$errorMsg?></p>
</form>
</body>
</html>
<?php
$ErrorMsg='';
?>
<?php
if (isset($_POST['submit'])){
    $confrim = $_POST['confirm'];
    if (empty($confrim)){
        $ErrorMsg = 'Input Not VALID';
    }else{
        if ($_SESSION['Two'] == $confrim){
            $_SESSION['TwoStep'] = "Confirm";
            header("Location:index.php");
        }else{
            $ErrorMsg = "Confirm Code Not Match";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <form action="" class="col-lg-8" method="post">
            <div class="row justify-content-center">
                <input type="text" class="form-control mt-4" name="inpt1" required placeholder="Confirm Code">
                <input type="submit" class="btn btn-primary mt-3" name="confirm" value="confirm">
            </div>
            <div class="">
                <p><?=$ErrorMsg?></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>


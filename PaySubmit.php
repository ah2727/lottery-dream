<?php
session_start();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
    <iframe " src="<?=$_SESSION['payy']->payLink?>" style="
    width: 100%;
    height: 75vh;
    border: 0;
    border-radius: 20px;
    ">
    </iframe>
    <div class="text-center mt-2 d-flex justify-content-center">
        <div class="col-lg-5">
            <p style="font-weight: bold;text-transform: uppercase">If you paid you can return to profile</p>
            <a  style="text-transform: uppercase;font-weight: bold" href="client/index.php?menu=orders" class="btn btn-outline-success">Return</a>
        </div>

    </div>
    </body>
    </html>

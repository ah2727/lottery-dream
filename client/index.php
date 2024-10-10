<?php
session_start();
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/Cheak.php';
include_once '../clases/Update_Database.php';
$update = new Update_Database();


$shop = new readingData();
$chek = new Cheak();
$resTrak = $shop->SelTrack($_SESSION['emailc']);
foreach ($resTrak as $key => $trak){
   $ressss = $chek->CheakPay($trak['trackID']);
   if ($ressss->status == 'Expired'){
       $update->DeleteTrack($ressss->trackId);
   }else if ($ressss->status == 'Paid' || $ressss->status == 'Confirming'){
       $update->UpdateTrack($ressss->trackId);
   }
}
$AllShop = $shop->ReadShop($_SESSION['emailc']);
$Winners = $shop->selWinnerEmail($_SESSION['emailc']);
if (!isset($_SESSION['emailc'])){
    header("Location:../login");
}
include_once "../clases/db_connect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css?v=0.3">

    <!-- Botstrap .Css-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    

</head>
<body>
<header class="web-header-section-client" style="direction: rtl">
    <div class="container">
        <nav class="navbar navbar-expand-lg  justify-content-around" >
            <li class="dropdown d-flex justify-content-star dp_io"><a class="nav-link nav-item text-dark fw-semibold dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i  class="bi bi-person-lines-fill" style="font-size: 25px"></i></a>
                <ul class="dropdown-menu dm-loi">
                <a class="nav-item nav-item text-dark text-center text-uppercase fw-semibold dropdown-item py-2"  href="?menu=wallet">wallet</a>
                <a class="nav-item nav-item text-dark text-center  text-uppercase fw-semibold dropdown-item py-2 c-pointer" href="?menu=referral">referral</a>

                    <a class="nav-item nav-item text-dark text-center text-uppercase fw-semibold dropdown-item py-2" href="?menu=profile" >profile</a>

                    <a class="nav-item nav-item text-dark text-center  text-uppercase fw-semibold dropdown-item py-2 c-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal1">log out</a>

                </ul>
            </li>
            <div style="width: 120px"><a href="../index.php"><img src="../image/logo.svg" alt="" class="img-fluid"></div></a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="font-size: 25px; color: black"><i class="bi bi-menu-button-wide"></i></span>
            </button>
            <div class="collapse justify-content-lg-start navbar-collapse flex-grow-0" id="navbarSupportedContent" style="direction: ltr">
                <div class="navbar-nav align-items-center">
                <li class="w-100 justify-content-star"><a class="nav-item nav-link text-dark fw-semibold " href="?menu=Home">Home</a></li>
                <li class="w-100 justify-content-start"><a class="nav-link nav-item text-dark fw-semibold  " href="?menu=support">Support</a></li>
                    <li class="w-100 justify-content-start"><a class="nav-link nav-item text-dark fw-semibold  " href="?menu=orders">Orders</a></li>
                    <li class="w-100 justify-content-start"><a class="nav-link nav-item text-dark fw-semibold  " href="../basket.php">Shop</a></li>
            </div>
            </div>
        </nav>
    </div>
</header>
<hr>
<main>
    <section>
        <div class="container mt-5">
            <?php
            if (isset($_GET['menu'])){
                switch ($_GET['menu']){
                    case "Home":
                        include_once "Home.php";
                        break;
                    case "wallet":
                        include_once "wallet/wallet.php";
                        break;
                    case "deposit":
                        include_once "wallet/deposit.php";
                        break;
                    case "referral":
                        include_once "referral.php";
                        break;
                    case "profile":
                        include_once "profile.php";
                        break;
                    case "support":
                        include_once "support.php";
                        break;
                    case "orders":
                        include_once "Shops.php";
                        break;
                    default:
                        include_once "Home.php";
                }
            }else{
                include_once "Home.php";
            }
            ?>
        </div>
    </section>
    <footer class="web-footer-section-client border ">
        <div class="container">
            <div class="row justify-content-around">
            <p class="col-lg-6 text-uppercase text-center fw-semibold my-2">lottery.re</p>
            <p class="text-uppercase col-lg-6 text-center fw-semibold my-2">design by lottery.re</p>

        </div>
    </footer>
</main>

<!-- jquery -->
<script src="../js/jquery-3.6.0.min.js"></script>
<!-- bootstrap  -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- index -->
<script src="../js/index.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</body>
</html>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are sure for log out?
                </div>
                <div class="modal-footer">
                    <a href="?logout=1" class="btn btn-outline-primary mx-3">logout</a>
                    <a href="?menu=profile" class="btn btn-outline-danger mx-3">cancel</a>
                </div>
            </div>
        </div>
    </div>
<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:../login.php");
}
?>
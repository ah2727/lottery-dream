<?php
ob_start();

session_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/onlineUsers.php';
include_once '../clases/viwe.php';
$viwe = new viwe();
$dayviwe = $viwe->selDay();
$mviwe = $viwe->selMviwe();
$readindex = new readingData();
$userCount = $readindex->counuserName();
$cardsCount = $readindex->counCards();
$HeadCount = $readindex->councardhead();
$totalBuy = $readindex->countBuy();
$online = new onlineUsers();
$res = $online->getOnlineUsers();
$cnt  = $cardsCount['count(id)'] + $HeadCount['count(id)'];

if (isset($_SESSION['email'])) {
} else {
    header("Location:login.php");
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
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Style . CsS -->
    <link rel="stylesheet" href="../style.css">
    <!--    responsive   -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!--    Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">

    <!--    0-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">

    <!--        Data tabels -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
</head>

<body style="font-family: 'Bakbak One'">
    <main>
        <!--Start Container-->
        <div class="container">
            <!--Start Header-->
            <header class="web-header-section-administrator">
                <nav class="navbar navbar-expand-lg">
                    <li class="nav-link nav-item  text-primary c-pointer text-center my-dropdown" style="font-size: 25px; width: 150px"><a><i class="bi bi-person-circle"></i>
                            <span class="size-10"><br>welcome AmirHosein</span>
                        </a>
                        <ul class="my-menu p-2">
                            <li class="pt-1 pb-2 mx-2"><a class="dropdown-item1 my-2 size-15 text-dark" href="?type=profile">Profile</a></li>
                            <li class="py-2 mx-2"><a class="dropdown-item1 my-2 size-15 pt-3 text-dark" href="?logout=1">LOGOUT</a></li>
                        </ul>
                    </li>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse collapse_administrator" id="navbarSupportedContent">
                        <div class="navbar-nav">
                            <li><a class="nav-link nav-item text-dark" href="index.php">Home</a></li>
                            <li class="dropdown"><a class="nav-link nav-item text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">SiteSetting</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item my-2" href="?type=addNewAdmin">Add New Admin</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=adminSetting">Admin Setting</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=AddWinner">Add Winner</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=WinnerStatus">Winner Status</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=earning">earning&referral</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=earning">withdrawl</a></li>


                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link nav-item text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Cards Setting</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item my-2" href="?type=addNewCards">Add New Cards</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=addNewCardsHead">Add New Cards Head</a></li>
                                    <li><a class="dropdown-item my-2" href="?type=cardsStatus">Cards Status</a></li>

                                </ul>
                            </li>
                            <li><a class="nav-link nav-item text-dark" href="?type=messages">messages</a></li>
                        </div>
                    </div>
                </nav>
            </header>
            <section class="web-slider-menu mt-5 border-bottom pb-4">
                <div class="row justify-content-between">
                    <div class="card mx-1 col-lg-2 bg-danger mt-2">
                        <div class="card-header" style="border-bottom: 1px solid white">
                            <h5 class="pb-1 pt-1 size-13 text-center" style="text-transform: uppercase">UserNames</h5>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="size-15 text-center"><?= $userCount['count(id)'] ?></p>
                        </div>
                    </div>
                    <div class="card mx-1 col-lg-2 bg-warning mt-2">
                        <div class="card-header" style="border-bottom: 1px solid white">
                            <h5 class="pb-1 pt-1 size-13 text-center" style="text-transform: uppercase">Total Cards</h5>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="size-15 text-center"><?php echo $cnt ?></p>
                        </div>
                    </div>
                    <div class="card mx-1 col-lg-2 bg-primary mt-2">
                        <div class="card-header" style="border-bottom: 1px solid white">
                            <h5 class="pb-1 pt-1 size-13 text-center" style="text-transform: uppercase">Total buy</h5>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="size-15 text-center"><?= $totalBuy['count(id)'] ?></p>
                        </div>
                    </div>
                    <div class="card mx-1 col-lg-2 bg-success mt-2">
                        <div class="card-header" style="border-bottom: 1px solid white">
                            <h5 class="pb-1 pt-1 size-13 text-center" style="text-transform: uppercase">Admins Online</h5>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="size-15 text-center"><?= $res['count(id)'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <?php
                        if (isset($_GET['type'])) {
                            switch ($_GET['type']) {
                                case "addNewAdmin":
                                    include_once "inc/addNewAdmin.php";
                                    break;
                                case "adminSetting":
                                    include_once "inc/AdminSetting.php";
                                    break;
                                case "addNewCards":
                                    include_once "inc/addNewCards.php";
                                    break;
                                case "profile":
                                    include_once "inc/profile.php";
                                    break;
                                case "cardsStatus":
                                    include_once "inc/cardStatus.php";
                                    break;
                                case "AddWinner":
                                    include_once 'inc/AddWinner.php';
                                    break;
                                case "messages":
                                    include_once "inc/messages.php";
                                    break;
                                case "addNewCardsHead":
                                    include_once "inc/addNewCardsHead.php";
                                    break;
                                case "WinnerStatus":
                                    include_once "inc/winnerSetting.php";
                                    break;

                                case "earning":
                                    include_once "inc/earning.php";
                                    break;

                                default:
                                    include_once "inc/charts.php";
                            }
                        } else {
                            include_once "inc/charts.php";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <footer class="web-footer-section bg-primary mt-5">
            <div class="container">
            </div>
        </footer>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="font-family: sans-serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for log out?</h5>
                        <button onclick="close1()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                        </button>
                        <a href="?logout=1" type="button" class="btn btn-primary">logout</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- index -->
    <script src="../js/index.js"></script>
    <!-- jquery -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <!-- bootstrap  -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!--    Cdn-->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>

<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:login.php");
}
?>
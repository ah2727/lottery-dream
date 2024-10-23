
<?php
session_start();
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/register.php';
include_once "../clases/createwallet.php";
include_once "../clases/referral.php";
include_once "../clases/gems.php"

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lorooott</title>
    <!-- Botstrap .Css-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../style.css">
    <!-- Style -->
    <link rel="stylesheet" href="../css/87e1e548f220918d.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="../css/0a8acb52cdb1f962.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="../css/148011a395061c55.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="../css/bf5750195f5b2ba9.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../css/d53016d9c486db61.css">
    <!-- responsive -->
    <!-- responsive -->
    <link rel="stylesheet" href="../css/e210c8fb9235f783.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<main>
    <div id="__next">
        <header id="lite-header" class="bg-white shadow-button">
            <div class="flex items-center px-4 py-6 h-16 shadow-button border-b border-gray-300 md:border-0">
                <div class="flex flex-1 justify-between"></div>
                <div class="flex justify-center flex-1"><a aria-label="National Lottery Logo" href="/"><img
                            class="w-32 h-14" src="../image/logo.svg"
                            alt="National Lottery Logo"></a></div>
                <div class="flex-1 flex justify-end">
                    <a href="../index.php">
                        <button aria-label="Close"
                                class="inline-flex flex-col justify-center px-3 text-sm font-bold leading-none lg:mr-5 sm:mr-0">
                            <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M4.73907 2.46994C4.11249 1.84335 3.0966 1.84335 2.47001 2.46994C1.84343 3.09652 1.84343 4.11241 2.47001 4.739L9.73098 12L2.46994 19.261C1.84335 19.8876 1.84335 20.9035 2.46994 21.5301C3.09652 22.1567 4.11241 22.1567 4.739 21.5301L12 14.269L19.261 21.53C19.8876 22.1566 20.9035 22.1566 21.5301 21.53C22.1567 20.9034 22.1567 19.8875 21.5301 19.261L14.2691 12L21.53 4.73904C22.1566 4.11246 22.1566 3.09657 21.53 2.46998C20.9034 1.8434 19.8875 1.8434 19.261 2.46998L12 9.73091L4.73907 2.46994Z"
                                      fill="#2D4550"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </header>
        <div class="flex items-center w-full md:pb-16 lg:pb-8 flex-col min-h-screen-8/10 bg-white md:bg-gradient-to-b from-blue-400 to-blue-100">
            <div class="flex flex-col items-stretch w-full sm:max-w-full lg:max-w-3xl md:max-w-2xl">
                <div class="flex justify-center md:pt-8 md:mx-6">
                    <div class="relative flex flex-col w-full md:w-125 lg:w-full items-stretch bg-white md:shadow lg:shadow md:rounded-2xl pt-8 md:pt-0">
                        <div class="flex flex-col px-6 lg:pt-6 md:pt-6 lg:px-22 md:px-11">
                            <div class="flex items-center justify-content-center mb-3">
                                <h3 class="text-center my-2 mx-12 font-black text-3xl">Confirm Email</h3>

                            </div>
                            <div class="lg:w-92 flex flex-col items-stretch self-center w-full">
                                <form action="" method="post">
                                    <div role="presentation"
                                         class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                        <div class="flex-1"><input tabindex="0" id="" name="Code"
                                                                   type="text"
                                                                   autocomplete="current-password"
                                                                   class="font-bold text-lg text-blue-800 outline-none w-full"
                                                                   value="" style="height: 100%" placeholder="Confirm Code"></div>
                                    </div>
                                    <p class="mt-3 text-center d-flex justify-content-center align-items-center"><?=$_SESSION['email']?></p>
                                    <div class="text-center mt-2">
                                        <a href="?EditeEmail=1" class="text-center d-flex justify-content-center align-items-center "><span>
                                                <i class="bi bi-pencil-square d-flex justify-content-center align-items-center me-2"></i>
                                            </span> <span>
                                                Edit Email
                                            </span></a>

                                    </div>
                                    <div class="flex flex-col w-72 mt-16 mx-auto">
                                        <input type="submit" value="Confirm" name="ConfirmEmail"
                                               class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold cursor-default p-4  bg-green-500 border-gray-400">
                                    </div>
                                </form>
                            </div>
                            <div class="flex inline-block text-blue-dark justify-center mt-6 mb-12 align-items-center"><p class="mr-2">Need
                                    help?</p><span class="underline"><a href="../contact-us.php">Contact us</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="main-footer" class="styles_footer__UG76L">
        <section class="styles_play-responsibly__MPNOj">
            <div class="styles_play-responsibly__age__gaTVM">18+</div>
            <p class="styles_play-responsibly__text__OBXR_">Play responsibly, Play for fun. National Lottery funds Good
                Causes around Ireland.</p><a class="styles_play-responsibly__link__yBhMs"
                                             href="/useful-info/play-responsibly">Responsible play information</a>
        </section>
    </footer>
</main>
<?php
echo $_SESSION['rand'];
if (isset($_GET['EditeEmail']))
{
    ?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLongTitle"><?=$_SESSION['email']?></h5>
                <a  href="ConfirmEmail.php" onclick="close1()" type="button" class="close border p-2 bg-danger rounded-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white" style="font-size: 20px">&times;</span>
                </a>
            </div>
            <form action="" method="post">
            <div class="d-flex justify-content-center my-4">
                <input type="text" class="form-control w-75" placeholder="New Email" name="newEmail">
            </div>
            <div class="modal-footer">
                <a href="?type=adminSetting" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                </a>
                <input type="submit" class="btn btn-primary " value="confirm" name="ChangeEmail">
            </div>
            </form>
            <?php
            if (isset($_POST['ChangeEmail'])){
                if (empty($_POST['newEmail'])){

                }else{
                    $_SESSION['email'] = $_POST['newEmail'];
                    header("Location:ConfirmEmail.php");
                }
            }
            ?>
        </div>
    </div>
</div>
    <?php
}
?>
</body>

<?php
if (isset($_POST['ConfirmEmail'])) {
    echo "sss";
    $code = $_POST['Code'];
    if ($_SESSION['rand'] == $code) {
        $pdo = new register();
        $wallet = new wallet();
        $wallet->createwallet($_SESSION['email']);
        $referal =new referral();
        $referal->createreferral($_SESSION['email']);
        $gems = new gems();
        $gems->creategems($_SESSION['email']);
        $pdo->Signup($_SESSION['email'],$_SESSION['password'],$_SESSION['FirstName'],$_SESSION['LastName'],$_SESSION['Address'],$_SESSION['mother'],$_SESSION['place'],$_SESSION['birthDay'],$_SESSION['Gender'],$_SESSION['phone']);
        if($_SESSION["referralid"]){
            echo $referal->insertReferral($_SESSION["referralid"],$_SESSION['email']);
            $gems->addGemsRefrral($_SESSION["referralid"]);
        }
        session_destroy();
        session_start();
        $_SESSION['RegS'] = "Registration was successful";

        header(header: "Location:../login.php");
    }
}

?>

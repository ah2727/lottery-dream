<?php
session_start();
ob_start();
include_once '../clases/send_Email.php';
$Email = new send_Email();
?>

<?php
if (isset($_SESSION['FirstName'])){
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
                            <h3 class="text-center my-2 mx-12 font-black text-3xl">Register</h3>

                        </div>
                        <div class="lg:w-92 flex flex-col items-stretch self-center w-full">
                            <div class="p-5 pb-7 flex justify-center">
                                <div class="flex">
                                    <div class="w-13 justify-center cursor-pointer" role="button" tabindex="0">
                                        <div class="h-10 w-10 text-center flex items-center justify-center rounded-full m-auto relative bg-blue-200">
                                            <span class="text-2xl font-bold ">1 </span>
                                            <div class="absolute top-0 right-0">
                                                <svg class="animate-pop" width="16" height="16" viewBox="0 0 16 16"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"
                                                          fill="white"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M14 8C14 11.3137 11.3137 14 8 14C4.68629 14 2 11.3137 2 8C2 4.68629 4.68629 2 8 2C11.3137 2 14 4.68629 14 8ZM4.78932 8.63341L5.95295 9.79704L6.83135 10.6754C6.83135 10.6754 7.09933 10.8876 7.36166 10.6754C7.624 10.4633 8.24571 9.79704 8.24571 9.79704L11.2107 6.83202C11.5273 6.51544 11.5273 6.00218 11.2107 5.6856C10.8942 5.36902 10.3811 5.36902 10.0646 5.6856L7.09933 8.65082L5.9355 7.487C5.61893 7.17042 5.1059 7.17042 4.78932 7.487C4.63561 7.64071 4.55183 7.84716 4.55183 8.06009C4.55183 8.27312 4.63551 8.4796 4.78932 8.63341Z"
                                                          fill="#208337"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex justify-center"><p
                                                    class="text-center leading-none font-bold uppercase pt-2 text-sm  text-blue-900">
                                                Account Details</p></div>
                                    </div>
                                    <hr class="w-6 sm:w-10 md:w-11 mx-3 sm:mx-5 md:mx-6 my-5 h-px bg-blue-900">
                                </div>
                                <div class="flex">
                                    <div class="w-13 justify-center cursor-pointer" role="button" tabindex="0">
                                        <div class="h-10 w-10 text-center flex items-center justify-center rounded-full m-auto relative bg-blue-200">
                                            <span class="text-2xl font-bold ">2 </span>
                                            <div class="absolute top-0 right-0">
                                                <svg class="animate-pop" width="16" height="16" viewBox="0 0 16 16"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"
                                                          fill="white"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M14 8C14 11.3137 11.3137 14 8 14C4.68629 14 2 11.3137 2 8C2 4.68629 4.68629 2 8 2C11.3137 2 14 4.68629 14 8ZM4.78932 8.63341L5.95295 9.79704L6.83135 10.6754C6.83135 10.6754 7.09933 10.8876 7.36166 10.6754C7.624 10.4633 8.24571 9.79704 8.24571 9.79704L11.2107 6.83202C11.5273 6.51544 11.5273 6.00218 11.2107 5.6856C10.8942 5.36902 10.3811 5.36902 10.0646 5.6856L7.09933 8.65082L5.9355 7.487C5.61893 7.17042 5.1059 7.17042 4.78932 7.487C4.63561 7.64071 4.55183 7.84716 4.55183 8.06009C4.55183 8.27312 4.63551 8.4796 4.78932 8.63341Z"
                                                          fill="#208337"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex justify-center"><p
                                                    class="text-center leading-none font-bold uppercase pt-2 text-sm  text-blue-900">
                                                User Details</p></div>
                                    </div>
                                    <hr class="w-6 sm:w-10 md:w-11 mx-3 sm:mx-5 md:mx-6 my-5 h-px bg-blue-900">
                                </div>
                                <div class="flex">
                                    <div class="w-13 justify-center cursor-default" role="button" tabindex="0">
                                        <div class="-z-1 absolute bg-blue-200 ml-1.5 h-10 w-10 rounded-full"></div>
                                        <div class="h-10 w-10 text-center flex items-center justify-center rounded-full m-auto animate-pop bg-blue-900">
                                            <span class="text-2xl font-bold  text-white">3 </span></div>
                                        <div class="flex justify-center"><p
                                                    class="text-center leading-none font-bold uppercase pt-2 text-sm  text-blue-900">
                                                Contact Details</p></div>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                            <div role="presentation"
                                 class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                <div class="flex-1"><input tabindex="0" id="" name="Phone"
                                                           type="text"
                                                           autocomplete="current-password"
                                                           class="font-bold text-lg text-blue-800 outline-none w-full"
                                                           value="" style="height: 100%" placeholder="Phone Number"></div>
                            </div>
                                <p class="text-sm text-gray-600">We will contact you when you win</p><h5
                                        class="mt-6 mb-2 font-bold text-xl">Address</h5>
                            <div role="presentation"
                                 class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                <div class="flex-1"><input tabindex="0" id="" name="Address"
                                                           type="text"
                                                           autocomplete="current-password"
                                                           class="font-bold text-lg text-blue-800 outline-none w-full"
                                                           value="" style="height: 100%" placeholder="Address"></div>
                            </div>
                                <div class="flex flex-col w-72 mt-16 mx-auto">
                                    <input type="submit" value="Continue" name="submit_step3"
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
</body>
<?php
}else{
    header("Location:step2.php");
}
?>
<?php
if (isset($_POST['submit_step3'])){
    $_SESSION['phone']=$_POST['Phone'];
    $_SESSION['Address']=$_POST['Address'];
    print_r($_SESSION);
    if (empty($_SESSION['phone']) || empty($_SESSION['Address'])){
        $errorMsg = "Filed Can not empty";
        echo "22222";
    }else{
        $_SESSION['rand'] = rand(10000, 99999);
        $res1 = $Email->ConfirmEmail($_SESSION['email'],$_SESSION['rand']);
        header("Location:ConfirmEmail.php");
    }
}
?>


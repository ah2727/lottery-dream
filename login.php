<?php
ob_start();
session_start();
$errorMsg = '';
if (isset($_SESSION['error'])) {
    $errorMsg = $_SESSION['error'];
}
?>
<?php
if (isset($_SESSION['emailc'])) {
    header("Location:client/index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Dream</title>
    <link rel="icon" type="image/x-icon" href="image/mini logo.ico">
    <!-- Botstrap .Css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="style.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/87e1e548f220918d.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="css/0a8acb52cdb1f962.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="css/148011a395061c55.css">
    <!-- responsive -->
    <!-- Style -->
    <link rel="stylesheet" href="css/bf5750195f5b2ba9.css">
    <!-- responsive -->
    <link rel="stylesheet" href="css/d53016d9c486db61.css">
    <!-- responsive -->
    <!-- responsive -->
    <link rel="stylesheet" href="css/e210c8fb9235f783.css">
    <!-- responsive -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<main>
    <div id="__next">
        <header id="lite-header" class="bg-white shadow-button">
            <div class="flex items-center px-4 py-6 h-16 shadow-button border-b border-gray-300 md:border-0">
                <div class="flex flex-1 justify-between"></div>
                <div class="flex justify-center flex-1"><a aria-label="National Lottery Logo" href="index.php"><img
                                class="w-32 h-14" src="image/logo.svg"
                                alt="National Lottery Logo"></a></div>
                <div class="flex-1 flex justify-end">
                    <a href="index.php" aria-label="Close"
                            class="inline-flex flex-col justify-center px-3 text-sm font-bold leading-none lg:mr-5 sm:mr-0">
                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4.73907 2.46994C4.11249 1.84335 3.0966 1.84335 2.47001 2.46994C1.84343 3.09652 1.84343 4.11241 2.47001 4.739L9.73098 12L2.46994 19.261C1.84335 19.8876 1.84335 20.9035 2.46994 21.5301C3.09652 22.1567 4.11241 22.1567 4.739 21.5301L12 14.269L19.261 21.53C19.8876 22.1566 20.9035 22.1566 21.5301 21.53C22.1567 20.9034 22.1567 19.8875 21.5301 19.261L14.2691 12L21.53 4.73904C22.1566 4.11246 22.1566 3.09657 21.53 2.46998C20.9034 1.8434 19.8875 1.8434 19.261 2.46998L12 9.73091L4.73907 2.46994Z"
                                  fill="#2D4550"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </header>
        <div class="flex items-center w-full md:pb-16 lg:pb-8 flex-col min-h-screen-8/10 bg-white md:bg-gradient-to-b from-blue-400 to-blue-100">
            <div class="flex flex-col items-stretch w-full sm:max-w-full lg:max-w-3xl md:max-w-2xl">
                <div class="flex justify-center md:pt-8 md:mx-6">
                    <div class="relative flex flex-col w-full md:w-125 lg:w-full items-stretch bg-white md:shadow lg:shadow md:rounded-2xl pt-8 md:pt-0">
                        <div class="flex flex-col px-6 lg:pt-6 md:pt-6 lg:px-22 md:px-11">
                            <div class="flex items-center justify-center pb-8">
                                <h3 class="mt-auto text-center font-black text-3xl">Sign in to continue</h3>

                            </div>
                            <?php if(isset($_SESSION['RegS'])){
                                ?>
                                <div class="flex items-center justify-center pb-8">
                                    <h3 class="mt-auto text-center font-black text-1xl text-success"><?php echo $_SESSION['RegS']; unset($_SESSION['RegS'])?></h3>

                                </div>
                            <?php
                            }
                            ?>
                            <?php if(isset($_SESSION['successful'])){
                                ?>
                                <div class="flex items-center justify-center pb-8">
                                    <h3 class="mt-auto text-center font-black text-1xl text-success"><?php echo $_SESSION['successful']; unset($_SESSION['successful'])?></h3>

                                </div>
                                <?php
                            }
                            ?>
                            <div class="flex flex-col items-stretch self-center lg:w-92">

                                <div class="px-4">
                                    <form action="loginWeb.php" method="post">

                                    <div class="mb-4">
                                        <div role="presentation"
                                             class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                            <div class=" flex-1">
                                                <input name="email" id="Email" type="email" class="font-bold text-lg text-blue-800 outline-none w-full" style="height: 100%" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div role="presentation"
                                             class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                            <div class=" flex-1">
                                                <input name="password"  id="password" type="password"  class="font-bold text-lg text-blue-800 outline-none w-full" style="height: 100%" placeholder="PASSWORD">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mx-4 lg:mx-12">
                                        <input id="signInButton" name="submit" type="submit" value="Sign in"
                                                class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold cursor-default p-4 border-gray-400"
                                                style="width: 100%;background-color: rgba(196,220,51,var(--tw-bg-opacity));color: rgba(45,69,80,var(--tw-text-opacity))" >
                                        <div class="flex flex-col sm:items-center mt-6 mb-12 gap-1 text-blue-900 underline">
                                            <div class="flex flex-wrap w-full justify-between"><a class="text-sm"
                                                                                                  href="forgotPassword.php">Forgot
                                                    Password?</a><br><a class="text-sm" href="">Other
                                                    issues signing in?</a></div></div>
                                    </div>
                                        <?php
                                        if (isset($_SESSION['error'])){
                                            ?>
                                            <div class="mb-3">
                                                <p class="text-center text-danger"><?=$_SESSION['error']?></p>
                                            </div>
                                        <?php
                                            unset($_SESSION['error']);
                                        }
                                        ?>
                                    </form>
                                </div>
                                <div class="relative inline-flex justify-between px-4 py-6 mb-8 bg-cover lg:hidden md:hidden bg-register-here-tablet rounded-xl">
                                    <p class="w-6/12 text-lg font-bold text-white">Create an account &amp; start
                                        playing!</p>
                                    <div class="mt-auto mb-auto text-center whitespace-pre"><a role="link"
                                                                                               class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold shadow-button hover:shadow-button-hov px-4 py-1 text-blue-800 bg-white active:bg-blue-lighter-04"
                                                                                               href="signUp/step1.php"><span>Register Here</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-between hidden px-6 py-6 bg-cover lg:inline-flex md:inline-flex lg:relative md:relative  rounded-bl-2xl" style="background-image: url('image/RegisterHereBackgroundDesktop.svg')">
                            <p class="font-bold text-white">Create an account &amp; start playing!</p><a role="button"
                                                                                                         class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold shadow-button hover:shadow-button-hov px-4 py-1 text-blue-800 bg-white active:bg-blue-lighter-04"
                                                                                                         href="signUp/step1.php"><span>Register Here</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="main-footer" class="styles_footer__UG76L">
            <section class="styles_play-responsibly__MPNOj">
                <div class="styles_play-responsibly__age__gaTVM">18+</div>
                <p class="styles_play-responsibly__text__OBXR_">Play responsibly, Play for fun. National Lottery funds
                    Good Causes around Ireland.</p><a class="styles_play-responsibly__link__yBhMs"
                                                      href="/useful-info/play-responsibly">Responsible play
                    information</a></section>
        </footer>
    </div>
</main>
</body>

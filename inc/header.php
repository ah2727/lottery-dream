<?php
include_once 'clases/db_connect.php';
include_once 'clases/readingData.php';
$pdo = new readingData();
$res = $pdo->readCardsAll();
$selCard = $pdo->selCard();
$resssss = $pdo->selAllby();
$result1 = $pdo->selCard();
$now = time();
$tt = $selCard['times'] - $now;
if (!empty($result1)){
    $cnt1= $result1['countstamp'];

}
if (!empty($result1)) {
    foreach ($resssss as $allby) {
        if ($allby['CardName'] == $result1['CardName']) {
            $cnt1--;
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
    <title>Lottery | Dream</title>
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
    <link rel="stylesheet" href="css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="css/d53016d9c486db61.css">
    <!-- responsive -->
    <!-- responsive -->
    <link rel="stylesheet" href="css/e210c8fb9235f783.css">
    <!-- responsive -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<main>
        <!-- Start Header -->
        <header id="lite-header" class="bg-white ">
            <div class="hidden lg:block"></div>
            <div class="hidden mx-auto lg:block max-w-screen-lg">
                <div class="relative flex flex-col pt-4">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center justify-center">
                            <div class="flex items-center flex-shrink-0 -mt-4">
                                <div class="w-auto" aria-label="nllogo">
                                    <a aria-label="National Lottery Logo " href="index.php">
                                        <img class="w-32 h-14 mt-4" src="image/logo.svg" alt="National Lottery Logo" style="height:  30px"></a>
                                </div>
                            </div>
                            <div class="ml-8">
                                <div class="flex justify-between">
                                    <button aria-expanded="true" aria-controls="games-content-space" onclick="menulg()" id="games-content-controller" class="flex justify-center items-center  navigation_headerLink__YX2ZY">
                                        <div class="absolute bottom-0 w-full  h-1 rounded-md"></div>
                                        Lottos
                                        <svg class="transform duration-100 ease ml-3" width="12" height="8" id="tre"
                                             viewBox="0 0 12 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M0.589585 1.30342C0.0670926 1.94531 0.157045 2.89232 0.793881 3.42252L4.9406 6.87489C5.54298 7.3764 6.4602 7.37377 7.05941 6.87489L11.2061 3.42252C11.843 2.89232 11.9329 1.94531 11.4104 1.30342C10.8839 0.656532 9.93347 0.562464 9.29163 1.09683L6.00001 3.83729L2.70838 1.09683C2.06654 0.562464 1.11615 0.656532 0.589585 1.30342Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                    <button aria-expanded="false" aria-controls="results-content-space" onclick="resultlg()"
                                            id="results-content-controller"
                                            class="flex justify-center items-center  navigation_headerLink__YX2ZY">
                                        Results
                                        <svg class="transform duration-100 ease ml-3" width="12" height="8" id="tre2"
                                             viewBox="0 0 12 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M0.589585 1.30342C0.0670926 1.94531 0.157045 2.89232 0.793881 3.42252L4.9406 6.87489C5.54298 7.3764 6.4602 7.37377 7.05941 6.87489L11.2061 3.42252C11.843 2.89232 11.9329 1.94531 11.4104 1.30342C10.8839 0.656532 9.93347 0.562464 9.29163 1.09683L6.00001 3.83729L2.70838 1.09683C2.06654 0.562464 1.11615 0.656532 0.589585 1.30342Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end flex-1">
                            <div class="inline-flex items-center"></div>
                            <div class="inline-flex items-center py-2 pl-6 divide-x-2 divide-gray-900">
                                <?php
                                if (!isset($_SESSION['emailc'])){
                                    ?>
                                <a class="px-2 text-sm font-bold hover:text-blue-light" href="signUp/step1.php">Register</a>
                                <a class="px-2 text-sm font-bold hover:text-blue-light" href="login.php">Login</a>
                                <?php
                                }else{
                                    ?>
                                    <a class="px-2 text-sm font-bold hover:text-blue-light" style="font-size: 28px" href="client/index.php"><i class="bi bi-person-circle"></i></a>

                            <?php
                                }
                                ?>
                            </div>

                            <a class="text-xl font-bold hover:text-blue-light px-4" aria-label="&quot;View Basket 0" href="basket.php">
                                <svg class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.034 20a2.665 2.665 0 0 0 2.662-2.662 2.665 2.665 0 0 0-2.662-2.661 2.665 2.665 0 0 0-2.661 2.661A2.665 2.665 0 0 0 16.034 20Zm0-3.67a1.01 1.01 0 0 1 0 2.017 1.01 1.01 0 0 1 0-2.018ZM20.3 5.027a.826.826 0 0 0-.65-.316H5.52l-.448-2.252C4.798 1.034 3.535 0 2.067 0H.827a.826.826 0 0 0 0 1.653h1.24c.688 0 1.256.46 1.383 1.12v.005l1.856 9.335a2.67 2.67 0 0 0 2.612 2.143h8.368c1.21 0 2.27-.818 2.576-1.988l.004-.014 1.587-6.521a.826.826 0 0 0-.154-.706Zm-3.038 6.828a1.01 1.01 0 0 1-.976.748H7.918c-.48 0-.897-.342-.991-.813L5.848 6.364h12.75l-1.336 5.49ZM8.109 14.677a2.665 2.665 0 0 0-2.662 2.661A2.665 2.665 0 0 0 8.11 20a2.665 2.665 0 0 0 2.662-2.662 2.665 2.665 0 0 0-2.662-2.661Zm0 3.67a1.01 1.01 0 0 1 0-2.018 1.01 1.01 0 0 1 0 2.018Z"
                                          fill="#2D4550"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="mt-20 absolute ease-in w-full duration-250 z-50" id="lg_Menu" style="display: none">
                        <div class="duration-250 ease-in shadow-megaMenu rounded-lg" style="transition-delay: 0s; opacity: 100;">
                            <div class="bg-white h-full rounded-md flex flex-col items-center relative">
                                <div class="absolute top-0 right-0 ease-in delay-200" style="opacity: 100;">
                                    <button aria-label="close" onclick="menulg()">
                                        <svg class="w-4 my-5 mr-7" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 1.25rem !important;margin-bottom: 1.25rem !important">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M3.5543 1.85245C3.08437 1.38252 2.32245 1.38252 1.85251 1.85245C1.38257 2.32239 1.38257 3.08431 1.85251 3.55425L7.29824 8.99998L1.85245 14.4458C1.38252 14.9157 1.38252 15.6776 1.85245 16.1476C2.32239 16.6175 3.08431 16.6175 3.55425 16.1476L9.00003 10.7018L14.4458 16.1475C14.9157 16.6175 15.6776 16.6175 16.1476 16.1475C16.6175 15.6776 16.6175 14.9157 16.1476 14.4457L10.7018 8.99998L16.1475 3.55428C16.6175 3.08434 16.6175 2.32242 16.1475 1.85249C15.6776 1.38255 14.9157 1.38255 14.4457 1.85249L9.00003 7.29818L3.5543 1.85245Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div id="games-content-space" role="region" aria-labelledby="games-content-controller" class="flex flex-col px-6 w-full pb-5 mb-1">
                                    <h6 class="leading-6 mt-4 font-black text-lg" style="margin-bottom: 1.25rem !important">Lotto Cards</h6>
                                    <div class="flex space-x-3">
                                        <div class="flex-1 w-full animate-fadeToTop"
                                             style="animation-duration: 0.2s; opacity: 100;">
                                            <button class="group w-full cursor-pointer h-45">
                                                <div class=" bg-left bg-cover bg-no-repeat text-white rounded-lg hover:shadow-hover relative p-3 h-full" style="background-image: url('image/CardsImage/<?=$selCard['bg_Image']?>')">
                                                    <div class="flex flex-col items-start flex-start text-left">
                                                        <div class="filter drop-shadow"><img alt="white Lotto logo"
                                                                                             class="h-10 w-auto"
                                                                                             src="image/CardsImage/<?=$selCard['cardImage']?>"
                                                                                             role="img"></div>
                                                        <h2 class="text-sm leading-5 font-bold mt-1 mb-1 shadow-text"
                                                            <?php
                                                        if ($cnt1 == 0 || $cnt1<0){
                                                            ?>
                                                            style="font-size: 20px"
                                                                <?php
                                                        }
                                                        ?> >
                                                            <?php
                                                            if ($result1['times'] != 0){
                                                                $ssss   = $result1['times'] - time();
                                                                $wick =7*24*60*60;
                                                                $day = 24*60*60;
                                                                $min = 60*60;
                                                                $sec = 60;
                                                                if ($ssss > $wick){
                                                                    echo  date("l--d-M, Ha",$result1['times']) ;
                                                                }elseif ($ssss>$day){
                                                                    echo floor($ssss/(24*60*60)) .' Days To Go';
                                                                }elseif ($ssss>$min){
                                                                    echo floor($ssss/(60*60)) .' hours To Go';
                                                                }elseif ($ssss>$sec) {
                                                                    echo floor($ssss / (60)) . ' min To Go';
                                                                }
                                                                elseif ($ssss <=0){
                                                                    echo '<div>Drawing in process</div>';
                                                                }
                                                                else{
                                                                    echo date("l, ha",$result1['times']);
                                                                }
                                                            }else{
                                                                if ($cnt1 == 0 || $cnt1<0){
                                                                    echo 'Drawing in process';
                                                                }else{
                                                                    echo $cnt1 .' To go';

                                                                }
                                                            }
                                                            ?>
                                                        </h2>
                                                        <?php
                                                        if ($cnt1>0 || $tt> 0){
                                                        ?>
                                                        <h3 class="font-black mb-3 shadow-text text-xl"><span
                                                                    aria-hidden="true"
                                                                    class="text-lg md:text-3xl lg:text-xl"><span><?=$selCard['winnermoney']?><?=$selCard['winnermoney_head']?></span></span>
                                                        </h3>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="flex flex-col justify-between w-full absolute bottom-0 left-0 p-2">
                                                            <p class="text-white text-x-sm font-bold pb-1">
                                                                *estimated</p>
                                                            <?php
                                                            if ($cnt1>0 || $tt> 0){
                                                                ?>
                                                                <div class="flex flex-start"><a
                                                                            aria-label="Play from €4 link"
                                                                            class="flex justify-center  cursor-pointer group-hover:text-blue-900 group-hover:shadow-hover group-hover:bg-white rounded-full ease-in-out duration-200"
                                                                            href="baskettttt.php?CardName=<?=$selCard['CardName']?>">
                                                                        <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
                                                                            <div class="uppercase text-sm font-bold leading-none xsm:text-sm">
                                                                                <span aria-label="play from €4"  class="ar">Play from €<?=$selCard['Money']?></span>
                                                                            </div>
                                                                        </div>
                                                                    </a></div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                        <?php
                                        foreach ($res as $res2){
                                           $test = $res2['times']- $now;
                                            $cnt= $res2['countstamp'];
                                            foreach ($resssss as $allby){
                                                if ($allby['CardName']==$res2['CardName']){
                                                    $cnt--;
                                                }
                                            }
                                            ?>
                                        <div class="flex-1 w-full animate-fadeToTop"
                                             style="animation-duration: 0.2s; opacity: 100;">
                                            <button class="group w-full cursor-pointer h-45">
                                                <div class=" bg-left bg-cover bg-no-repeat text-white rounded-lg hover:shadow-hover relative p-3 h-full" style="background-image: url('image/CardsImage/<?=$res2['bg_Image']?>')">
                                                    <div class="flex flex-col items-start flex-start text-left">
                                                        <div class="filter drop-shadow"><img alt="white Lotto logo"
                                                                                             class="h-10 w-auto"
                                                                                             src="image/CardsImage/<?=$res2['cardImage']?>"
                                                                                             role="img"></div>
                                                        <h2 class="text-sm leading-5 font-bold mt-1 mb-1 shadow-text"                                                             <?php
                                                        if ($cnt1 == 0 || $cnt1<0){
                                                            ?>
                                                            style="font-size: 20px"
                                                            <?php
                                                        }
                                                        ?> >                                                            <?php

                                                            if ($res2['times'] != 0) {
                                                                $ssss   = $res2['times'] - time();
                                                                $wick =7*24*60*60;
                                                                $day = 24*60*60;
                                                                $min = 60*60;
                                                                $sec = 60;
                                                                if ($ssss > $wick){
                                                                    echo  date("l--d-M, Ha",$res2['times']) ;
                                                                }elseif ($ssss>$day){
                                                                    echo floor($ssss/(24*60*60)) .' Days To Go';
                                                                }elseif ($ssss>$min){
                                                                    echo floor($ssss/(60*60)) .' hours To Go';
                                                                }elseif ($ssss>$sec) {
                                                                    echo floor($ssss / (60)) . ' min To Go';
                                                                }
                                                                elseif ($ssss <=0){
                                                                    echo '<div>Drawing in process</div>';
                                                                }
                                                                else{
                                                                    echo date("l, ha",$res2['times']);
                                                                }
                                                            } else {
                                                                if ($cnt == 0 || $cnt < 0) {
                                                                    echo 'Drawing in process';
                                                                } else {
                                                                    echo $cnt . ' To go';

                                                                }
                                                            }

                                                            ?>
                                                            </h2>
                                                        <?php
                                                        if ($cnt>0 || $test> 0){
                                                            ?>                                                        <h3 class="font-black mb-3 shadow-text text-xl"><span
                                                                        aria-hidden="true"
                                                                        class="text-lg md:text-3xl lg:text-xl"><span><?=$res2['winnermoney']?></span>
                                                                          <?= $res2['winnermoney_head']?>
                                                                </span>
                                                            </h3>

                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="flex flex-col justify-between w-full absolute bottom-0 left-0 p-2">
                                                            <p class="text-white text-x-sm font-bold pb-1">
                                                                *estimated</p>
                                                            <?php
                                                            if ($cnt>0 || $test> 0){
                                                                ?>
                                                            <div class="flex flex-start"><a
                                                                        aria-label="Play from €4 link"
                                                                        class="flex justify-center  cursor-pointer group-hover:text-blue-900 group-hover:shadow-hover group-hover:bg-white rounded-full ease-in-out duration-200"
                                                                        href="baskettttt.php?CardName=<?=$res2['CardName']?>">
                                                                    <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
                                                                        <div class="uppercase text-sm font-bold leading-none xsm:text-sm">
                                                                            <span aria-label="play from €4"  class="ar">Play from €<?=$res2['Money']?></span>
                                                                        </div>
                                                                    </div>
                                                                </a></div>
                                                        </div>
                                                            <?php
                                                            }
                                                            ?>

                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-20 absolute ease-in w-full duration-250 z-20 d-none"  id="results-content-space1">
                        <div class="duration-250 ease-in shadow-megaMenu rounded-lg"
                             style="transition-delay: 0.3s;">
                            <div class="bg-white h-full rounded-md flex flex-col items-center relative">
                                <div class="absolute top-0 right-0 ease-in delay-200">
                                    <button aria-label="close" onclick="closeres()">
                                        <svg class="w-4 my-5 mr-7" viewBox="0 0 18 18" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" style="margin-top: 1.25rem !important;margin-bottom: 1.25rem !important;">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M3.5543 1.85245C3.08437 1.38252 2.32245 1.38252 1.85251 1.85245C1.38257 2.32239 1.38257 3.08431 1.85251 3.55425L7.29824 8.99998L1.85245 14.4458C1.38252 14.9157 1.38252 15.6776 1.85245 16.1476C2.32239 16.6175 3.08431 16.6175 3.55425 16.1476L9.00003 10.7018L14.4458 16.1475C14.9157 16.6175 15.6776 16.6175 16.1476 16.1475C16.6175 15.6776 16.6175 14.9157 16.1476 14.4457L10.7018 8.99998L16.1475 3.55428C16.6175 3.08434 16.6175 2.32242 16.1475 1.85249C15.6776 1.38255 14.9157 1.38255 14.4457 1.85249L9.00003 7.29818L3.5543 1.85245Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="pt-14 w-full " id="results-content-space" role="region"
                                     aria-labelledby="results-content-controller">
                                    <div class="flex mx-6 space-x-4">
                                        <div tabindex="0" role="link" class="flex-1  relative" id="TestNum" aria-label="Lotto" >
                                            <a href="result.php?cardName=<?=$selCard['CardName']?>">
                                            <div class="group cursor-pointer flex flex-col items-center h-52 rounded-md bg-cover flex-1 bg-lottoCardBackground bg-left shadow-headerCard hover:shadow-headerCardHover transition-all ease-linear animate-fadeOut"
                                                 style="animation-duration: 0.2s;background-image: url('image/CardsImage/<?=$selCard['bg_Image']?>')">
                                                <div class="flex flex-col pt-10 h-full w-full justify-end items-center mb-6 ">
                                                    <div class="relative mb-10 filter drop-shadow"><img
                                                                alt="white Lotto logo" class="w-38"
                                                                src="image/CardsImage/<?=$selCard['result_Image']?>"
                                                                role="img"></div>
                                                    <button role="link"
                                                            class="py-1.5 px-3 mx-2 bg-black-alpha-20 rounded-full border border-solid border-white text-white  group-hover:text-blue-900 group-hover:shadow-hover group-hover:bg-white ease-in-out duration-200">
                                                        <h5 class="uppercase text-sm font-bold ar" id="" style="font-size: 10px">View Results</h5>
                                                    </button>
                                                </div>
                                            </div>
                                            </a>
                                        </div>

                                        <?php
                                        foreach ($res as $resm){
                                            ?>

                                            <div tabindex="0" role="link" class="flex-1 TestNum1 relative" aria-label="Lotto" >
                                                <a href="result.php?cardName=<?=$resm['CardName']?>">
                                                <div class="group cursor-pointer flex flex-col items-center h-52 rounded-md bg-cover flex-1 bg-lottoCardBackground bg-left shadow-headerCard hover:shadow-headerCardHover transition-all ease-linear animate-fadeOut"
                                                     style="animation-duration: 0.2s;background-image: url('image/CardsImage/<?=$resm['bg_Image']?>')">
                                                    <div class="flex flex-col pt-10 h-full w-full justify-end items-center mb-6 ">
                                                        <div class="relative mb-10 filter drop-shadow"><img
                                                                    alt="white Lotto logo" class="w-38"
                                                                    src="image/CardsImage/<?=$resm['result_Image']?>"
                                                                    role="img"></div>
                                                        <button role="link"
                                                                class="py-1.5 px-3 mx-2 bg-black-alpha-20 rounded-full border border-solid border-white text-white  group-hover:text-blue-900 group-hover:shadow-hover group-hover:bg-white ease-in-out duration-200">
                                                            <h5 class="uppercase text-sm font-bold ar" style="font-size: 10px">View Results</h5>
                                                        </button>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="w-full flex flex-col ease-in delay-200"><span
                                                class="w-full border-t-1 my-3"></span>
                                        <div class="w-full flex justify-center items-center space-x-9 underline mb-3"><a
                                                    href="prize.php">How to claim your prize</a><a
                                                    href="prizes.php">Unclaimed prizes</a></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:hidden">
                <div class="flex items-center px-4 py-3 lg:hidden h-14">
                    <div class="flex flex-1 justify-between">
                        <div class="flex items-center">
                            <button type="button"
                                    class="inline-flex items-center justify-center py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="open_menu()">
                                <svg class="block" width="32" height="32" viewBox="0 0 32 32" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="4" y="22.6667" width="24" height="3.46667" rx="1.73333"
                                          fill="#2D4550"></rect>
                                    <rect x="4" y="14.6667" width="24" height="3.46667" rx="1.73333"
                                          fill="#2D4550"></rect>
                                    <rect x="4" y="6.66666" width="24" height="3.46667" rx="1.73333"
                                          fill="#2D4550"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-center flex-1" aria-label="nllogoMobile">
                        <a href="index.php"><img class="h-12 w-auto" src="image/logo.svg" alt=" Logo"></a>
                    </div>
                    <div class="flex-1 flex justify-end items-center space-x-3">
                        <?php if (!isset($_SESSION['emailc'])){
                            ?>
                            <a href="login.php" class="text-center inline-flex flex-col justify-center px-3 text-sm font-bold leading-none uppercase border border-gray-900 rounded-full box-content hover:text-blue-light h-7 w-11" style="font-size: 10px">Login</a>
                        <?php
                        }else{
                            ?>
                            <a class="px-2 text-sm font-bold hover:text-blue-light" style="font-size: 28px" href="client/index.php"><i class="bi bi-person-circle"></i></a>
                        <?php
                        }
                        ?>
                        <a class="text-xl font-bold hover:text-blue-light" aria-label="&quot;View Basket 0"
                                     href="basket.php">
                            <svg class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.034 20a2.665 2.665 0 0 0 2.662-2.662 2.665 2.665 0 0 0-2.662-2.661 2.665 2.665 0 0 0-2.661 2.661A2.665 2.665 0 0 0 16.034 20Zm0-3.67a1.01 1.01 0 0 1 0 2.017 1.01 1.01 0 0 1 0-2.018ZM20.3 5.027a.826.826 0 0 0-.65-.316H5.52l-.448-2.252C4.798 1.034 3.535 0 2.067 0H.827a.826.826 0 0 0 0 1.653h1.24c.688 0 1.256.46 1.383 1.12v.005l1.856 9.335a2.67 2.67 0 0 0 2.612 2.143h8.368c1.21 0 2.27-.818 2.576-1.988l.004-.014 1.587-6.521a.826.826 0 0 0-.154-.706Zm-3.038 6.828a1.01 1.01 0 0 1-.976.748H7.918c-.48 0-.897-.342-.991-.813L5.848 6.364h12.75l-1.336 5.49ZM8.109 14.677a2.665 2.665 0 0 0-2.662 2.661A2.665 2.665 0 0 0 8.11 20a2.665 2.665 0 0 0 2.662-2.662 2.665 2.665 0 0 0-2.662-2.661Zm0 3.67a1.01 1.01 0 0 1 0-2.018 1.01 1.01 0 0 1 0 2.018Z"
                                      fill="#2D4550"></path>
                            </svg>
                        </a></div>
                </div>
                <nav class="h-auto w-auto flex">
                    <ul class="fixed z-30 inset-y-0 left-0 w-screen bg-white animations_animateInLeft__Q2Rej overflow-auto d-none" id="colse_Menu">
                        <li class="flex items-center justify-between border-b-1 border-gray-300 w-screen py-3.5">
                            <div class="px-2 sm:mx-auto"><span>Don't have an account?</span><br class="sm:hidden"><a
                                        href="signUp/step1.php"
                                        class="sm:px-1 py-3 text-base font-bold text-gray-900 underline uppercase">Register
                                    today</a></div>
                            <button aria-label="Close Menu" class="mr-6 text-gray-900" onclick="Menu_Close()">
                                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4.73907 2.46994C4.11249 1.84335 3.0966 1.84335 2.47001 2.46994C1.84343 3.09652 1.84343 4.11241 2.47001 4.739L9.73098 12L2.46994 19.261C1.84335 19.8876 1.84335 20.9035 2.46994 21.5301C3.09652 22.1567 4.11241 22.1567 4.739 21.5301L12 14.269L19.261 21.53C19.8876 22.1566 20.9035 22.1566 21.5301 21.53C22.1567 20.9034 22.1567 19.8875 21.5301 19.261L14.2691 12L21.53 4.73904C22.1566 4.11246 22.1566 3.09657 21.53 2.46998C20.9034 1.8434 19.8875 1.8434 19.261 2.46998L12 9.73091L4.73907 2.46994Z"
                                          fill="#2D4550"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <div class="block border-gray-300 border-b-1">
                                <div class="top-0 py-3">
                                    <button aria-label="Games, collapsed, menu" class="flex w-full justify-between px-6  box-border appearance-none cursor-pointer" type="button" onclick="Menu_sm()">
                                        <h6 class="pr-1 text-base font-bold text-lg">Lottos</h6>
                                        <svg class="transform duration-100 ease mt-1" width="12" height="8"
                                             viewBox="0 0 12 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M0.589585 1.30342C0.0670926 1.94531 0.157045 2.89232 0.793881 3.42252L4.9406 6.87489C5.54298 7.3764 6.4602 7.37377 7.05941 6.87489L11.2061 3.42252C11.843 2.89232 11.9329 1.94531 11.4104 1.30342C10.8839 0.656532 9.93347 0.562464 9.29163 1.09683L6.00001 3.83729L2.70838 1.09683C2.06654 0.562464 1.11615 0.656532 0.589585 1.30342Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="transition-max-height duration-700 ease-in-out flex-1 bg-gray-100 d-none" id="sm_Menu">
                                    <div class="flex flex-col">

                                        <a class="text-left" <?php
                                        if ($cnt1>0 || $tt >0){
                                            ?>
                                            href="baske2.php?CardName=<?=$selCard['CardName']?>"
                                                <?php
                                        }

                                        ?>>
                                            <div class="flex items-center space-x-1 active:bg-blue-100 w-full px-6 h-12"
                                                 style="animation-duration:0.3s"><h6 class="w-1/2 font-bold text-lg">
                                                    <?=$selCard ['CardName']?></h6>
                                                <div class="w-1/2 text-sm">
                                                    <?php
                                                    if ($cnt1>0){
                                                        ?>
                                                        <p class="font-bold text-blue-800"><span aria-hidden="true"
                                                                                                 class="text-lg md:text-3xl text-sm md:text-sm"><span><?=$selCard['winnermoney']?> <?=$selCard['winnermoney_head']?></span></span>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>

                                                    <p><span>
                                        <?php
                                        if ($result1['times'] != 0){
                                            $ssss   = $result1['times'] - time();
                                            $wick =7*24*60*60;
                                            $day = 24*60*60;
                                            $min = 60*60;
                                            $sec = 60;
                                            if ($ssss > $wick){
                                                echo  date("l--d-M, Ha",$result1['times']) ;
                                            }elseif ($ssss>$day){
                                                echo floor($ssss/(24*60*60)) .' Days To Go';
                                            }elseif ($ssss>$min){
                                                echo floor($ssss/(60*60)) .' hours To Go';
                                            }elseif ($ssss>$sec) {
                                                echo floor($ssss / (60)) . ' min To Go';
                                            }
                                            elseif ($ssss <=0){
                                                echo '<div>Drawing in process</div>';
                                            }
                                            else{
                                                echo date("l, ha",$result1['times']);
                                            }
                                        }else{
                                            if ($cnt1 == 0 || $cnt1<0){
                                                echo 'Drawing in process';
                                            }else{
                                                echo $cnt1 .' To go';

                                            }
                                        }
                                        ?>
                                                        </span></p></div>
                                            </div>
                                        </a>
                                        <?php
                                        foreach ($res as $row){
                                            $test = $row['times']- $now;
                                            $cnt= $row['countstamp'];
                                            foreach ($resssss as $allby){
                                                if ($allby['CardName']==$row['CardName']){
                                                    $cnt--;
                                                }
                                            }
                                            ?>
                                            <a class="text-left" <?php if ($cnt>0 || $test> 0){
                                                ?>
                                                href=".php?CardName=<?=$row['CardName']?>"
                                                    <?php
                                            }
                                            ?>
                                            >
                                                <div class="flex items-center space-x-1 active:bg-blue-100 w-full px-6 h-12"
                                                     style="animation-duration:0.3s"><h6 class="w-1/2 font-bold text-lg">
                                                        <?=$row['CardName']?></h6>
                                                    <div class="w-1/2 text-sm"><p class="font-bold text-blue-800"><span aria-hidden="true"
                                                                    class="text-lg md:text-3xl text-sm md:text-sm"><span><?=$row['winnermoney']?></span>
                                                                                                                        <?= $row['winnermoney_head']?>
                                                            </span>
                                                        </p>
                                                        <p><span>
                                        <?php
                                        if ($row['times'] != 0){
                                            $ssss   = $row['times'] - time();
                                            $wick =7*24*60*60;
                                            $day = 24*60*60;
                                            $min = 60*60;
                                            $sec = 60;
                                            if ($ssss > $wick){
                                                echo  date("l--d-M, Ha",$row['times']) ;
                                            }elseif ($ssss>$day){
                                                echo floor($ssss/(24*60*60)) .' Days To Go';
                                            }elseif ($ssss>$min){
                                                echo floor($ssss/(60*60)) .' hours To Go';
                                            }elseif ($ssss>$sec) {
                                                echo floor($ssss / (60)) . ' min To Go';
                                            }
                                            elseif ($ssss <=0){
                                                echo '<div>Drawing in process</div>';
                                            }
                                            else{
                                                echo date("l, ha",$row['times']);
                                            }
                                        }else{
                                            if ($cnt == 0 || $cnt<0){
                                                echo 'Drawing in process';
                                            }else{
                                                echo $cnt .' To go';

                                            }
                                        }
                                        ?>
                                                            </span></p></div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block border-gray-300 border-b-1">
                                <div class="top-0 py-3">
                                    <button aria-label="Results, collapsed, menu" class="flex w-full justify-between px-6  box-border appearance-none cursor-pointer" type="button" onclick="Menu_result()">
                                        <h6 class="pr-1 text-base font-bold text-lg">Results</h6>
                                        <svg class="transform duration-100 ease mt-1" width="12" height="8"
                                             viewBox="0 0 12 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M0.589585 1.30342C0.0670926 1.94531 0.157045 2.89232 0.793881 3.42252L4.9406 6.87489C5.54298 7.3764 6.4602 7.37377 7.05941 6.87489L11.2061 3.42252C11.843 2.89232 11.9329 1.94531 11.4104 1.30342C10.8839 0.656532 9.93347 0.562464 9.29163 1.09683L6.00001 3.83729L2.70838 1.09683C2.06654 0.562464 1.11615 0.656532 0.589585 1.30342Z"
                                                  fill="#2D4550"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class=" overflow-hidden transition-max-height duration-700 ease-in-out flex-1 bg-gray-100 d-none" id="result">
                                    <div class="flex flex-col text-lg space-y-4 font-bold mb-2 px-6 py-4">
                                        <div class="" style="animation-duration:0.3s">
                                            <a href="result.php?cardName=<?=$selCard['CardName']?>" class="font-bold text-lg" role="link" tabindex="0"><?=$selCard['CardName']?></a>
                                        </div>
                                        <?php
                                        $res_sm_menu = $pdo->readCardsAll();
                                        foreach ($res_sm_menu as $result_sm){
                                            ?>
                                            <div class="" style="animation-duration:0.3s">
                                                <a href="result.php?cardName=<?=$result_sm['CardName']?>" class="font-bold text-lg" role="link" tabindex="0"><?=$result_sm['CardName']?></a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    <script>
        let TestNum = document.getElementById('')
    </script>

        <script>
            let lg_Menu = document.getElementById("lg_Menu");
            let sm_Menu = document.getElementById('sm_Menu');
            let result = document.getElementById('result')
            let tre = document.getElementById("tre");
            let tre2 = document.getElementById("tre2");
            let results_content_space1 = document.getElementById('results-content-space1');
            let colse_Menu = document.getElementById('colse_Menu');
            function menulg(){
                lg_Menu.classList.toggle("show")
                results_content_space1.classList.remove('show');
                tre2.classList.remove('rotate-180');
                tre.classList.toggle('rotate-180')
            }
            function Menu_sm(){
                sm_Menu.classList.toggle("show")
            }
            function Menu_result(){
                result.classList.toggle("show")

            }
            function Menu_Close(){
                colse_Menu.classList.toggle('show')
            }
            function open_menu(){
                colse_Menu.classList.toggle('show')
            }
            function resultlg() {
                results_content_space1.classList.toggle('show');
                lg_Menu.classList.remove('show');
                tre.classList.remove('rotate-180');
                tre2.classList.toggle('rotate-180');
            }
            function closeres(){
                results_content_space1.classList.toggle('show');
                tre2.classList.toggle('rotate-180');
            }
            function Close_lg() {
                lg_Menu.classList.toggle("show")
            }
        </script>
        <style>
            .show{
                display: block !important;
                stransform: rotate(180deg);

            }
            .hide{
                display: none !important;
            }
        </style>
    <script>
        $(document).ready(function (){
            $('button').mouseenter(function (){
                $(this).find('.ar').css("color",'#2D4550');
            })
            $('#TestNum').mouseenter(function (){
                $(this).find('.ar').css("color",'#2D4550');
            })
            $('#TestNum').mouseleave(function (){
                $(this).find('.ar').css("color",'#fff');
            })
            $('.TestNum1').mouseenter(function (){
                $(this).find('.ar').css("color",'#2D4550');
            })
            $('.TestNum1').mouseleave(function (){
                $(this).find('.ar').css("color",'#fff');
            })
        })
        $(document).ready(function (){
            $('button').mouseleave(function (){
                $(this).find('.ar').css("color",'#fff');
            })
        })
    </script>
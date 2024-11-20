<?php
use payment\pay;
include_once 'clases/pay.php';
$payyyy = new pay();
session_start();
ob_start();
include_once 'inc/header.php';
include_once 'clases/readingData.php';
include_once 'clases/register.php';
include_once 'clases/cart.php';
$cart = new Cart();
$cartitem = $cart->selectCartItemsByEmail($_SESSION["emailc"]);
$reggg= new register();
$pdob = new readingData();
$BAS = $pdob->readCards();
$selo = $pdob->selCard();
$resssss = $pdob->selAllby();
$cnt1= $selo['countstamp'];
$now = time();
$tt = $selo['times'] - $now;
foreach ($resssss as $allby) {
    if ($allby['CardName'] == $selo['CardName']) {
        $cnt1--;
    }
}
$n = 0;
if (isset($_SESSION['PayShop'])){
    foreach ($_SESSION['PayShop'] as $k1 => $v) {
        if (!isset($_SESSION['payshop'])) {
            $_SESSION['payshop'][] = $v['CardName'];
        } else {
            for ($i = 0; $i < count($_SESSION['PayShop']); $i++) {
                if (!in_array($v['CardName'], $_SESSION['payshop'])) {
                    $_SESSION['payshop'][] = $v['CardName'];
                }

            }

        }
    }
}
if (isset($_GET['DeleteBasket'])){
$cart->deleteCartItemById($_GET['DeleteBasket']);
}
if (isset($_POST['buynow'])) {
}
?>
    <div id="__next">
        <div class="relative min-h-screen-9/10 flex flex-col">
            <div class="lg:container mx-auto p-4 lg:pl-20 grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12">
                <div class="col-start-1 col-end-1 lg:col-start-1 lg:col-end-10 whitespace-nowrap"><h1
                            class="pr-4 text-3xl font-black py-4 mt-5">Your Basket</h1></div>
            </div>
            <div class="relative overflow-hidden flex-grow">
                <div class="flex-col justify-center items-center relative hidden lg:flex">
                    <svg role="img" aria-hidden="true" class="absolute -top-16 -z-1" fill="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3400 3025" xml:space="preserve"
                         style="width: 3400px;"><path fill="none" d="M1077 0h1246v3025H1077z"></path>
                        <path fill="#E7EFF3" d="M-1.4 241h3401.8v2784H-1.4z"></path>
                        <radialGradient id="a" cx="2198.211" cy="0.521" r="1"
                                        gradientTransform="matrix(0 1020.5 -2156.28 0 2932.702 -2243151.5)"
                                        gradientUnits="userSpaceOnUse">
                            <stop offset="0.29" style="stop-color: rgb(243, 248, 249);"></stop>
                            <stop offset="1" style="stop-color: rgb(197, 216, 225); stop-opacity: 0;"></stop>
                        </radialGradient>
                        <path fill="url(#a)"
                              d="M618.7 238.7c1431-225 1899.4-175.7 2177.7-213v1396.9H618.7V238.7z"></path>
                        <linearGradient id="b" gradientUnits="userSpaceOnUse" x1="1156.969" y1="-1627.537" x2="1984.815"
                                        y2="-1069.002" gradientTransform="translate(0 1826)">
                            <stop offset="0.407" style="stop-color: rgb(234, 242, 245);"></stop>
                            <stop offset="0.649" style="stop-color: rgb(223, 233, 238);"></stop>
                            <stop offset="1" style="stop-color: rgb(215, 231, 238); stop-opacity: 0;"></stop>
                        </linearGradient>
                        <path fill="url(#b)"
                              d="M1364.7 903.9c-113.2-255.2-264.2-755.7-268.6-789.9 84.1 23.4 881.7 76.5 1296.1 34.3V1421h-732.8c.1 0-181.5-261.9-294.7-517.1z"></path>
                        <linearGradient id="c" gradientUnits="userSpaceOnUse" x1="-0.4" y1="-314.45" x2="3400.4"
                                        y2="-314.45" gradientTransform="translate(0 1826)">
                            <stop offset="0.165" style="stop-color: rgb(255, 255, 255);"></stop>
                            <stop offset="0.243" style="stop-color: rgb(255, 255, 255); stop-opacity: 0;"></stop>
                            <stop offset="0.777" style="stop-color: rgb(255, 255, 255); stop-opacity: 0;"></stop>
                            <stop offset="0.832" style="stop-color: rgb(255, 255, 255);"></stop>
                        </linearGradient>
                        <path fill="url(#c)" d="M-.4 0h3400.8v3023.1H-.4z"></path></svg>
                </div>
                <svg role="img" aria-hidden="true" class="absolute top-0 w-full h-full -z-1 left-0 md:hidden"
                     fill="none"
                     viewBox="0 0 369 1744" preserveAspectRatio="xMidYMin slice" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_18059_535807)">
                        <rect y="91" width="368" height="1653" fill="#E7EFF3"></rect>
                        <path d="M0.627584 64.4401C243.968 3.69939 323.611 17.0134 370.929 6.95391L370.928 384.023L185.778 384.023L0.627424 384.023L0.627494 111.1L0.627584 64.4401Z"
                              fill="url(#paint0_linear_18059_535807)"></path>
                        <path d="M93.9231 243.994C63.3373 175.106 22.5487 40.0178 21.3736 30.7746C44.0906 37.0997 259.549 51.433 371.505 40.0421L371.505 383.561L173.562 383.562C173.562 383.562 124.509 312.882 93.9231 243.994Z"
                              fill="url(#paint1_linear_18059_535807)"></path>
                    </g>
                    <defs>
                        <linearGradient id="paint0_linear_18059_535807" x1="371.626" y1="-1.97951" x2="416.362"
                                        y2="315.847"
                                        gradientUnits="userSpaceOnUse">
                            <stop offset="0.290336" stop-color="#F3F8F9"></stop>
                            <stop offset="0.557292" stop-color="#D6E6ED"></stop>
                            <stop offset="1" stop-color="#D6E6ED" stop-opacity="0"></stop>
                        </linearGradient>
                        <linearGradient id="paint1_linear_18059_535807" x1="55.2584" y1="27.73" x2="245.461"
                                        y2="327.814"
                                        gradientUnits="userSpaceOnUse">
                            <stop offset="0.407151" stop-color="#EAF2F5"></stop>
                            <stop offset="0.64896" stop-color="#DFE9EE"></stop>
                            <stop offset="1" stop-color="#D7E7EE" stop-opacity="0"></stop>
                        </linearGradient>
                        <clipPath id="clip0_18059_535807">
                            <rect width="369" height="1744" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
                <svg role="img" aria-hidden="true"
                     class="absolute top-0 w-full h-full -z-1 left-0 hidden md:block lg:hidden" fill="none"
                     viewBox="0 0 768 3025" preserveAspectRatio="xMidYMin slice" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_18059_535808)">
                        <rect y="241" width="767" height="2784" fill="#E7EFF3"></rect>
                        <path d="M1.30473 134.218C507.77 7.70575 673.531 35.4365 772.012 14.4843L772.012 799.854L386.658 799.854L1.30445 799.854L1.30459 231.402L1.30473 134.218Z"
                              fill="url(#paint0_linear_18059_535808)"></path>
                        <path d="M195.482 508.198C131.824 364.716 46.9309 83.3507 44.4851 64.0987C91.766 77.2726 540.199 107.127 773.213 83.4013L773.213 798.893L361.235 798.893C361.235 798.893 259.141 651.68 195.482 508.198Z"
                              fill="url(#paint1_linear_18059_535808)"></path>
                    </g>
                    <defs>
                        <linearGradient id="paint0_linear_18059_535808" x1="773.465" y1="-4.12245" x2="866.708"
                                        y2="657.837"
                                        gradientUnits="userSpaceOnUse">
                            <stop offset="0.290336" stop-color="#F3F8F9"></stop>
                            <stop offset="0.680977" stop-color="#D6E6ED"></stop>
                            <stop offset="1" stop-color="#D7E7EE" stop-opacity="0"></stop>
                        </linearGradient>
                        <linearGradient id="paint1_linear_18059_535808" x1="115.01" y1="57.7573" x2="511.292"
                                        y2="682.518"
                                        gradientUnits="userSpaceOnUse">
                            <stop offset="0.407151" stop-color="#EAF2F5"></stop>
                            <stop offset="0.64896" stop-color="#DFE9EE"></stop>
                            <stop offset="1" stop-color="#D7E7EE" stop-opacity="0"></stop>
                        </linearGradient>
                        <clipPath id="clip0_18059_535808">
                            <rect width="768" height="3025" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
                <div class="lg:container mx-auto p-4 grid sm:grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-4 ">
                    <div class="col-start-1 col-end-5 md:col-start-2 md:col-end-8 lg:col-start-3 lg:col-end-11"><h2
                                class="absolute font-black text-xl">Your basket items</h2>
                        <?php
                        if (isset($cartitem) && !empty($cartitem) && !empty($cartitem)){
                            foreach ($cartitem as $text) {
                                $res = $pdob->selCarsWithName($text["CardName"]);
                                if (empty($res)) {
                                    $res = $pdob->selCarsWithName1($text["CardName"]);
                                }
                            ?>


                            <div class="w-full">
                                <div class="shadow bg-white rounded-lg">
                                    <div class="bg-white rounded-t-lg flex items-center justify-between px-4 mt-8 pt-3">
                                        <img
                                                alt=" Lotto logo" class="h-12 w-26"
                                                src="image/CardsImage/<?=$res['Basket_Image']?>" role="img">
                                        <div class="flex items-center">
                                            <a href="baskettttt.php?CardName=<?=$res['CardName']?>" aria-label="edit" role="link" class="pr-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M16.4012 4.99878C16.2068 4.99878 16.0046 5.07656 15.8568 5.22433L14.4335 6.64767L17.3501 9.56433L18.7735 8.141C19.0768 7.83767 19.0768 7.34767 18.7735 7.04433L16.9535 5.22433C16.7979 5.06878 16.6035 4.99878 16.4012 4.99878ZM13.6012 9.68087L14.3168 10.3964L7.27013 17.4431H6.55457V16.7275L13.6012 9.68087ZM4.99902 16.0818L13.6012 7.47955L16.5179 10.3962L7.91569 18.9984H4.99902V16.0818Z"
                                                          fill="#2D4550"></path>
                                                </svg>
                                            </a>
                                            <a href="?DeleteBasket=<?= $text['id'] ?>" aria-label="delete">
                                                <svg class="w-5" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.71412 14.1074C8.06586 14.1074 8.35366 13.8196 8.35366 13.4679V9.31092C8.35366 8.95918 8.06586 8.67139 7.71412 8.67139C7.36238 8.67139 7.07458 8.95918 7.07458 9.31092V13.4679C7.07458 13.8196 7.36238 14.1074 7.71412 14.1074Z"
                                                          fill="#2D4550"></path>
                                                    <path d="M10.2083 14.1074C10.56 14.1074 10.8478 13.8196 10.8478 13.4679V9.31092C10.8478 8.95918 10.56 8.67139 10.2083 8.67139C9.85652 8.67139 9.56873 8.95918 9.56873 9.31092V13.4679C9.56873 13.8196 9.85652 14.1074 10.2083 14.1074Z"
                                                          fill="#2D4550"></path>
                                                    <path d="M12.7025 14.1074C13.0543 14.1074 13.3421 13.8196 13.3421 13.4679V9.31092C13.3421 8.95918 13.0543 8.67139 12.7025 8.67139C12.3508 8.67139 12.063 8.95918 12.063 9.31092V13.4679C12.063 13.8196 12.3508 14.1074 12.7025 14.1074Z"
                                                          fill="#2D4550"></path>
                                                    <path d="M16.4438 5.01017H13.2142L12.8145 3.66715C12.6066 2.97965 11.9671 2.5 11.2476 2.5H9.16913C8.44965 2.5 7.81012 2.97965 7.60227 3.66715L7.20256 5.01017H3.97291C3.62116 5.01017 3.33337 5.29797 3.33337 5.64971C3.33337 6.00145 3.62116 6.28924 3.97291 6.28924H4.46855V16.1541C4.46855 17.0015 5.15605 17.7049 6.01942 17.7049H14.4133C15.2607 17.7049 15.9642 17.0174 15.9642 16.1541V6.27326H16.4438C16.7956 6.27326 17.0834 5.98546 17.0834 5.63372C17.0834 5.28198 16.7956 5.01017 16.4438 5.01017ZM8.83337 4.03488C8.88134 3.89099 9.00925 3.77907 9.16913 3.77907H11.2636C11.4235 3.77907 11.5514 3.875 11.5994 4.03488L11.8872 5.01017H8.52959L8.83337 4.03488ZM14.6691 16.1381C14.6691 16.282 14.5412 16.4099 14.3973 16.4099H6.01942C5.87552 16.4099 5.74762 16.282 5.74762 16.1381V6.27326H14.6851V16.1381H14.6691Z"
                                                          fill="#2D4550"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="bg-white flex items-start justify-between px-4 pt-2 pb-4">
                                        <div><p><?php
                                                $n=0;
                                                foreach($cartitem as $rwss) {
                                                    if ($res['CardName'] == $rwss['CardName']) {
                                                        $n++;
                                                    }
                                                }
                                                echo $n . " Lines";
                                                ?>
</p></div>
                                        <div class="bg-blue-100 rounded-md py-1 px-2"><p
                                                    class="text-dark-blue font-bold">
                                                <?php
                                                $n=0;
                                                foreach($cartitem as $rwss) {
                                                    if ($res['CardName'] == $rwss['CardName']) {
                                                        $n++;
                                                    }
                                                }
                                                echo '$'.$res['Money'] * $n;
                                                ?>
                                            </p></div>
                                    </div>
                                    <div class="border-t-1 bg-white border-grey-300 py-2 px-4 flex flex-col justify-center">
                                        <button class="flex justify-center cursor-pointer leading-normal text-base font-bold group-hover:text-blue-prompt items-center ShowBasket"
                                                role="button"><span id="details">Show details</span><span
                                                    class="pl-1 pr-2"><svg
                                                        class="transform duration-100 ease" width="12"
                                                        height="8"
                                                        viewBox="0 0 12 8" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg" aria-label="expanded"><path
                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M0.589585 1.30342C0.0670926 1.94531 0.157045 2.89232 0.793881 3.42252L4.9406 6.87489C5.54298 7.3764 6.4602 7.37377 7.05941 6.87489L11.2061 3.42252C11.843 2.89232 11.9329 1.94531 11.4104 1.30342C10.8839 0.656532 9.93347 0.562464 9.29163 1.09683L6.00001 3.83729L2.70838 1.09683C2.06654 0.562464 1.11615 0.656532 0.589585 1.30342Z"
                                                            fill="#2D4550"></path></svg></span></button>
                                    </div>
                                    <div aria-hidden="false" class="duration-700 transition-all ease-in-out Basket "
                                         id=""
                                         style="max-height: 259px; display: none">
                                        <div class="bg-gray-100 px-4 pt-2 pb-3 border-t-1 border-grey-300 rounded-b-md">

                                            <div class="mb-3 mt-2 self-center flex flex-col items-center">
                                                <div class="w-auto space-y-6 flex flex-col">
                                                    <div class="flex flex-col">
                                                        <div class="mb-2 flex gap-2">
                                                            <div class="flex gap-1.5 md:gap-2 flex-wrap">
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$text['balls1']?>
                                                                </div>
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$text['balls2']?>
                                                                </div>
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$text['bals3']?>
                                                                </div>
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$text['balls4']?>
                                                                </div>
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$text['balls5']?>
                                                                </div>
                                                                <div class="flex font-bold rounded-full justify-center items-center relative text-white bg-red-800 w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl">
                                                                    <?=$rwss['balls6']?>
                                                                </div>
                                                            </div>

                                                            <div class="flex gap-1.5 md:gap-2 flex-wrap"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <section class="flex justify-between text-lg border-t-1 pt-1"><h4
                                                        class="text-dark-blue font-bold">Total</h4><h4
                                                        class="text-dark-blue font-bold">
                                                    <?php
                                                    $n=0;
                                                    foreach($cartitem as $rwss) {
                                                        if ($res['CardName'] == $rwss['CardName']) {
                                                        $n++;
                                                        }
                                                    }
                                                   echo '$'.$res['Money'] * $n;
                                                    ?>
                                                </h4></section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        }
                        ?>
                    </div>
                    <div class="col-start-1 col-end-5 md:col-start-2 md:col-end-8 lg:col-start-4 lg:col-end-10">
                    </div>
                    <div class="col-start-1 col-end-5 md:col-start-2 md:col-end-8 lg:col-start-3 lg:col-end-11 mt-6">
                        <div class="grid grid-cols-2 lg:grid-cols-3 auto-cols-max gap-4 pb-12">
                            <button class="md:flex-grow flex flex-col group rounded-xl md:m-0 px-2 py-3 items-center justify-evenly space-y-2 text-white h-40 md:h-44 min-w-38"
                                 style="background-image: url('image/CardsImage/<?= $selo['bg_Image'] ?>')">
                                <a <?php if ($cnt1 >0 || $tt> 0){

                                    ?>
                                    href="baskettttt.php?CardName=<?= $selo['CardName'] ?>"
                                        <?php
                                }?>>
                                    <span class="d-flex justify-center">
                                        <img alt=" Eurodreams logo" class="h-12 w-26"
                                             src="image/CardsImage/<?= $selo['result_Image'] ?>" role="img"></span>
                                    <div class="flex flex-col text-center">
                                        <p class="text-lg sm:text-2xl font-black text-white ">
                                        <span><?= $selo['winnermoney'] ?> <span
                                                    class="inline md:block font-bold text-sm md:text-lg mt-0 pt-0 lg:text-xl">
                                        <?php
                                        if ($selo['times'] != 0){
                                            $ssss   = $selo['times'] - time();
                                            $wick =7*24*60*60;
                                            $day = 24*60*60;
                                            $min = 60*60;
                                            $sec = 60;
                                            if ($ssss > $wick){
                                                echo  date("l--d-M, Ha",$selo['times']) ;
                                            }elseif ($ssss>$day){
                                                echo floor($ssss/(24*60*60)) .' Days To Go';
                                            }elseif ($ssss>$min){
                                                echo floor($ssss/(60*60)) .' hours To Go';
                                            }elseif ($ssss>$sec) {
                                                echo floor($ssss / (60)) . ' min To Go';
                                            }
                                            else{
                                                echo '<div class="text-white">Drawing in process</div>';
                                            }

                                        }else{
                                            if ($cnt1 == 0 || $cnt1<0){
                                                echo 'Drawing in process';
                                            }else{
                                                echo $cnt1 .' To go';

                                            }
                                        }
                                        ?>
                                            </span></span>
                                        </p>
                                    </div>
                                    <?php
                                    if ($cnt1 >0 || $tt> 60){
                                        ?>
                                        <a aria-label="Play from €2.50 link" class="flex justify-center cursor-pointer"
                                           href="baskettttt.php?CardName=<?= $selo['CardName'] ?>"

                                        >
                                            <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
                                                <div class="uppercase text-sm font-bold leading-none xsm:text-sm"><span class="ar">Play from €<?= $selo['Money'] ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                </a>
                            </button>
                            <?php
                            foreach ($BAS as $resb) {
                                $test = $resb['times'] - $now;
                                $cnt= $resb['countstamp'];
                                foreach ($resssss as $allby){
                                    if ($allby['CardName']==$resb['CardName']){
                                        $cnt--;
                                    }
                                }
                                ?>
                                <button class="md:flex-grow flex flex-col group rounded-xl md:m-0 px-2 py-3 items-center justify-evenly space-y-2 text-white h-40 md:h-44 min-w-38"
                                     style="background-image: url('image/CardsImage/<?= $resb['bg_Image'] ?>')">
                                    <a class=""
                                       <?php if ($cnt>0 || $test > 0){
                                           ?>
                                           href="baskettttt.php?CardName=<?= $resb['CardName'] ?>"

                                            <?php
                                       }
                                       ?>>
                                    <span class="d-flex justify-center">
                                        <img alt=" Eurodreams logo" class="h-12 w-26"
                                             src="image/CardsImage/<?= $resb['result_Image'] ?>" role="img"></span>
                                        <div class="flex flex-col text-center">
                                            <p class="text-lg sm:text-2xl font-black text-white ">
                                            <span><?= $resb['winnermoney'] ?><span
                                                        class="inline md:block font-bold text-sm md:text-lg mt-0 pt-0 lg:text-xl">
                                                    <?php
                                                    if ($resb['times'] != 0){
                                                        $ssss   = $resb['times'] - time();
                                                        $wick =7*24*60*60;
                                                        $day = 24*60*60;
                                                        $min = 60*60;
                                                        $sec = 60;
                                                        if ($ssss > $wick){
                                                            echo  date("l--d-M, Ha",$resb['times']) ;
                                                        }elseif ($ssss>$day){
                                                            echo floor($ssss/(24*60*60)) .' Days To Go';
                                                        }elseif ($ssss>$min){
                                                            echo floor($ssss/(60*60)) .' hours To Go';
                                                        }elseif ($ssss>$sec) {
                                                            echo floor($ssss / (60)) . ' min To Go';
                                                        }
                                                        else{
                                                            echo '<div class="text-white">Drawing in process</div>';
                                                        }

                                                    }else{
                                                        if ($cnt == 0 || $cnt<0){
                                                            echo 'Drawing in process';
                                                        }else{
                                                            echo $cnt .' To go';

                                                        }
                                                    }
                                                    ?>
                                                </span></span>
                                            </p>
                                        </div>
                                        <?php
                                        if ($cnt > 0 ||  $test > 0){
                                            ?>
                                        <a aria-label="Play from €2.50 link" class="flex justify-center cursor-pointer"
                                           href="baskettttt.php?CardName=<?= $resb['CardName'] ?>">
                                        <?php
                                        }
                                        ?>                                                <?php
                                            if ($cnt > 0 ||   $test > 60){
                                            ?>

                                            <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
  <div class="uppercase text-sm font-bold leading-none xsm:text-sm"><span class="ar">Play from €<?= $resb['Money'] ?></span>
                                                </div>

                                            </div>
                                                <?php
                                            }
                                            ?>
                                        </a>
                                    </a>
                                </button>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-row flex bg-white shadow fixed bottom-0 w-full z-20 py-4 px-4 md:px-7 lg:px-28 rounded-t-lg justify-between lg:justify-end items-center">
            <div class="flex justify-between lg:justify-end w-full">
                <div class="flex flex-col justify-between lg:mr-22">
                    <div class="flex justify-end font-bold"><span class="font-bold text-xl"><span
                                    class="flex flex-col lg:flex-row lg:items-center">Total:
                                <span
                                        class="text-3xl font-black lg:ml-1">
                                    <?php
                                    $_SESSION['money'] = 0;
                                    if (isset($cartitem)) {
                                        foreach ($cartitem as $Paaay) {
                                            $res = $pdob->selCarsWithName($Paaay['CardName']);
                                            if (empty($res)) {
                                                $res = $pdob->selCarsWithName1($Paaay['CardName']);
                                            }
                                            $_SESSION['money'] = $_SESSION['money'] + $res['Money'];
                                        }
                                    }
                                    ?>
                                    $ <?php if (isset($_SESSION['money'])){
                                        echo $_SESSION['money'];
                                    }else{
                                        echo 0;
                                    }?>
                                </span>
                            </span></span></div>
                </div>
            </div>
            <div class="flex flex-row w-full md:w-auto">
                <form action="" method="post">

                <input type="submit" value="Buy Now" name="buynow"
                       class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-full sm:w-44 md:w-48 lg:w-64 h-12 cursor-default text-blue-800 bg-green-500 border-green-400 c-pointer border-gray-400"
                       data-selected="false">
                </form>

            </div>
        </div>
        <?php
        include_once 'inc/footer.php';
        ?>
    </div>
<?php
if (isset($_POST['buynow'])){
    if (isset($_SESSION['emailc'])){
        if (isset($_SESSION['money']) && $_SESSION['money'] != 0){
             $ordayid =rand(10000000,99999999);
             $now = time();
                foreach ($cartitem as $paybu) {
                    $randCode = rand(1000, 9999);
                    foreach($cartitem as $e){
                        $cart->deleteCartItemById($e["id"]);

                    $reggg->InsertOrderTabel($_SESSION['emailc'],$paybu['balls1'],$paybu['balls2'],$paybu['bals3'],$paybu['balls4'],$paybu['balls5'],$paybu['balls6'],$ordayid,$randCode,$paybu['CardName'],$_SESSION['pay'],$now,$e["division"],$e["gems"] ?? 0);
                    $_COOKIE["inputOption"]="";
                                        unset($_SESSION['PayShop']);
                                    }
                }
                $ttk = $_SESSION['payy']->trackId;
            $_SESSION['payy'] = $payyyy->oxPay($_SESSION['money'],$_SESSION['emailc'],$ordayid,'');
            $reggg->insertTrak($_SESSION['emailc'],$ttk,$ordayid);

            unset($_SESSION['payshop']);
            header("Location:" . "/PaySubmit.php");
    }
    }else{
        header("Location:login.php");
    }
}
?>
    <script>
        $(document).ready(function () {
            $('.ShowBasket').click(function () {
                $('#details').text('Hide details');
                $(this).find('svg').toggleClass('rotate-180');
                $(this).parent().parent().find('.Basket').toggleClass('showB');
            })
        })
    </script>
<?php
?>

<script>
    $(document).ready(function (){
        $('button').mouseenter(function (){
            $(this).find('.ar').css("color",'#2D4550');
        })
    })
    $(document).ready(function (){
        $('button').mouseleave(function (){
            $(this).find('.ar').css("color",'#fff');
        })
    })
</script>

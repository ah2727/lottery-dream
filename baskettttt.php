<?php

use payment\pay;

session_start();
ob_start();
$Error_MSG = '';
$_SESSION['idpay'] = 0;
include_once 'inc/header.php';
include_once 'clases/readingData.php';
include_once 'clases/pay.php';
include_once 'clases/register.php';
require_once 'clases/db_connect.php';
require_once 'clases/gems.php';

$gems = new gems();
$usergems = $gems->getGems($_SESSION['emailc']);
$reggg = new register();
$pdob = new readingData();
$pay11 = new pay();
$resssss = $pdob->selAllby();
if (isset($_GET['CardName']) && !empty($_GET['CardName'])) {
    $result = $pdob->selCarsWithName($_GET['CardName']);
    if (empty($result)) {
        $result = $pdob->selCarsWithName1($_GET['CardName']);
        if (empty($result)) {
            header("Location:basket.php");
        }
    }
    $_SESSION['pay'] = $result['Money'];

    $cardName = $_GET['CardName'];
    if (isset($_POST['submitshop'])) {
        if (empty($_POST['n1']) || empty($_POST['n2']) || empty($_POST['n3']) || empty($_POST['n4']) || empty($_POST['n5']) || empty($_POST['n6'])) {
            $Error_MSG = "Please Select 6 Balls";
        } else {
            $_SESSION['PayShop'][] = [
                'CardName' => $cardName,
                'bal1' => $_POST['n1'],
                'bal2' => $_POST['n2'],
                'bal3' => $_POST['n3'],
                'bal4' => $_POST['n4'],
                'bal5' => $_POST['n5'],
                'bal6' => $_POST['n6']

            ];
            header("Location:?CardName=" . $_GET['CardName']);
        }
    }
    if (isset($_POST['edite'])) {
        if (empty($_POST['n1']) || empty($_POST['n2']) || empty($_POST['n3']) || empty($_POST['n4']) || empty($_POST['n5']) || empty($_POST['n1'])) {
            $Error_MSG = "Please Select 6 Balls";
        } else {
            foreach ($_SESSION['PayShop'] as $kay2 => $val2) {
                if ($_POST['edite'] == $kay2) {
                    $_SESSION['PayShop'][$kay2] = [
                        'CardName' => $cardName,
                        'bal1' => $_POST['n1'],
                        'bal2' => $_POST['n2'],
                        'bal3' => $_POST['n3'],
                        'bal4' => $_POST['n4'],
                        'bal5' => $_POST['n5'],
                        'bal6' => $_POST['n6']
                    ];
                    header("Location:?CardName=" . $_GET['CardName']);
                }
            }
        }
    }
    if (isset($_GET['delete'])) {
        foreach ($_SESSION['PayShop'] as $kay => $val1) {
            if ($kay == $_GET['delete']) {
                unset($_SESSION['PayShop'][$_GET['delete']]);
                header("Location:?CardName=" . $_GET['CardName']);
            }
        }
    }

?>
    <div id="__next">
        <div class="bg-blue-100 relative flex justify-center min-h-screen" style="min-height: 70lvh">
            <div class="flex flex-col lg:flex-row w-full h-full lg:max-w-screen-lg lg:justify-center">
                <div class="bg-cover absolute bg-cover bg-no-repeat w-full h-60 md:h-56 lg:h-80"
                    style="background-image: url('image/CardsImage/<?= $result['bg_Image'] ?>')">
                </div>
                <div class="flex flex-col lg:flex-row w-full px-4 md:px-6 lg:px-0 lg:pl-0 h-full z-1 lg:justify-center">
                    <div class="flex flex-col">
                        <div class="flex items-start z-10 absolute lg:static"><a href="index.php" role="link"
                                class="flex text-blue-900 hover:text-white bg-green-500 rounded-full uppercase justify-start cursor-pointer items-center font-bold text-x-sm pl-1.5 pr-3 mb-3 mt-2 z-1">
                                <svg class="fill-current leading-none" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.1219 6.81753C13.6928 6.153 14.7127 6.05914 15.404 6.60435C16.1006 7.15381 16.2019 8.14552 15.6264 8.81526L12.6752 12.25L15.6264 15.6847C16.2019 16.3545 16.1006 17.3462 15.404 17.8956C14.7127 18.4409 13.6928 18.347 13.1219 17.6825L9.40394 13.3555C8.86669 12.7302 8.86386 11.7731 9.40394 11.1445L13.1219 6.81753Z"
                                        fill="#2D4550"></path>
                                </svg>
                                home</a></div>
                        <div class="flex flex-col w-full md:w-125 mx-auto md:mt-9 lg:mt-4 lg:mx-0 lg:pr-14 items-between mt-8">
                            <div class="mb-1 mt-0 md:mt-2 lg:mt-3"><img alt="white Eurodreams logo"
                                    class="drop-shadow filter w-25 h-12 lg:w-1/3 lg:h-full"
                                    src="image/CardsImage/<?= $result['cardImage'] ?>"
                                    role="img"></div>
                            <div class="flex lg:block justify-between flex-col">
                                <div class="flex flex-col">
                                    <h1
                                        class="text-white shadow-text text-3xl md:text-4xl lg:text-5xl font-black"><span
                                            aria-label="€20,000 <desc>per month for 30 years</desc>  guaranteed"
                                            class=""><span><?= $result['winnermoney'] ?> <span
                                                    class="block font-bold text-xl"><?= $result['cardHeader'] ?></span></span></span>
                                    </h1>
                                </div>
                                <div class="flex  lg:flex-col justify-between">
                                    <p
                                        class="text-white shadow-text font-bold lg:mt-2 lg:text-xl">
                                        <?php
                                        $cnt = $result['countstamp'];
                                        foreach ($resssss as $allby) {
                                            if ($allby['CardName'] == $result['CardName']) {
                                                $cnt--;
                                            }
                                        }
                                        if ($result['times'] != 0) {
                                            $ssss   = $result['times'] - time();
                                            $wick = 7 * 24 * 60 * 60;
                                            $day = 24 * 60 * 60;
                                            $min = 60 * 60;
                                            $sec = 60;
                                            if ($ssss > $wick) {
                                                echo  date("l--d-M, Ha", $result['times']);
                                            } elseif ($ssss > $day) {
                                                echo floor($ssss / (24 * 60 * 60)) . ' Days To Go';
                                            } elseif ($ssss > $min) {
                                                echo floor($ssss / (60 * 60)) . ' hours To Go';
                                            } elseif ($ssss > $sec) {
                                                echo floor($ssss / (60)) . ' min To Go';
                                            } elseif ($ssss <= 0) {
                                                echo '<div>Drawing in process</div>';
                                            } else {
                                                echo date("l, ha", $result['times']);
                                            }
                                        } else {
                                            if ($cnt == 0 || $cnt < 0) {
                                                echo 'Drawing in process';
                                            } else {
                                                echo $cnt . ' To go';
                                            }
                                        }
                                        ?></p>
                                    <div class="flex lg:flex-col justify-between lg:justify-start sm:mt-0.5 items-baseline">
                                        <div class="text-white shadow-text font-bold lg:py-8 text-sm lg:text-base">*
                                            guaranteed
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col mb-4 mx-4 mt-6 md:mt-9 lg:m-4 w-full md:w-125 lg:w-5/12 self-center lg:flex-grow">
                        <div class="md:px-0 z-10 w-full">
                            <div class="bg-white rounded-lg shadow w-full p-4 md:p-8 mb-8 flex flex-col">
                                <div class="flex flex-col items-start mb-4">
                                    <div class="flex flex-row space-x-2 pb-1">
                                        <h1 class="font-black text-2xl capitalize"
                                            aria-level="3">
                                            Play <?= $result['CardName'] ?></h1>
                                        <div class="flex self-center max-w-xs relative justify-center items-center">
                                            <div role="button" tabindex="0" aria-label="tooltip" class="">
                                                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10Z"
                                                        stroke="#2D4550" stroke-width="2"></path>
                                                    <path d="M8.88867 8.88894C8.88867 8.27529 9.38613 7.77783 9.99978 7.77783C10.6134 7.77783 11.1109 8.27529 11.1109 8.88894V15.0001C11.1109 15.6137 10.6134 16.1112 9.99978 16.1112C9.38613 16.1112 8.88867 15.6137 8.88867 15.0001V8.88894Z"
                                                        fill="#2D4550"></path>
                                                    <rect x="8.61133" y="3.88867" width="2.77778" height="2.77778"
                                                        rx="1.38889" fill="#2D4550"></rect>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="text-blue">Pick lines of 6 numbers .</h2>
                                </div>
                                <ol class="hidden" aria-hidden="true"></ol>
                                <div class="flex justify-center">
                                    <div id="block1" class="flex flex-col items-center mb-9 w-min">
                                        <?php
                                        if (isset($_SESSION['PayShop'])) {
                                            foreach ($_SESSION['PayShop'] as $kay => $val) {
                                                if ($val['CardName'] == $cardName) {

                                        ?>
                                                    <div class="flex flex-row space-y-4 mt-3 ">
                                                        <a href="?CardName=<?= $_GET['CardName'] ?>&delete=<?= $kay ?>" class="d-flex align-items-center position-relative" style="font-size: 20px;margin-right: 10px"><i class="bi bi-trash"></i></a>
                                                        <button class="relative text-center rounded-full p-2 border border-gray-300 hover:shadow-hover cursor-pointer bg-white w-min addblock">
                                                            <div class="inline-flex justify-center z-2 pt-1 mx-1 space-x-1">
                                                                <?php
                                                                $n = 0;
                                                                for ($i = 1; $i < 7; $i++) {
                                                                    $n = $i;
                                                                ?>
                                                                    <div
                                                                        class="self-auto flex font-bold rounded-full justify-center bg-game-daily bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                        <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                                            aria-hidden="true" class="sp-1">
                                                                            <?= $val['bal' . $i] ?>
                                                                        </span>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="absolute sb inline z-1 w-auto mx-auto top-1/3 left-0 right-0 text-center" style="display: none"
                                                                <p aria-label="Enter Numbers smb" class="font-bold text-lg"><span
                                                                    class="inline-flex relative"> <svg width="15"
                                                                        height="14"
                                                                        viewBox="0 0 15 14"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M12.7625 5.26325C13.7218 5.26325 14.4991 6.04055 14.4991 6.99984C14.4991 7.46593 14.313 7.90555 13.9902 8.22831C13.6676 8.55093 13.2279 8.73678 12.7622 8.73678L9.23582 8.73703L9.23582 12.2631C9.23582 12.7292 9.04976 13.1688 8.727 13.4915C8.40439 13.8142 7.96466 14 7.49888 14C6.53959 14 5.7623 13.2227 5.7623 12.2634L5.7623 8.73678H2.23565C1.27635 8.73678 0.49906 7.95949 0.49906 7.00019C0.49906 6.0409 1.27671 5.26325 2.236 5.26325L5.76204 5.26325L5.7623 1.73696C5.7623 0.777663 6.53994 1.80256e-05 7.49924 1.86999e-05C8.45853 1.85313e-05 9.23582 0.777313 9.23582 1.73661L9.23582 5.26325L12.7625 5.26325Z"
                                                                            fill="#2D4550"></path>
                                                                    </svg></span>
                                                                <span> Enter Numbers</span>
                                                                </p>

                                                        </button>
                                                        <form action="" method="post" style="background: transparent; display: none">
                                                            <div>
                                                                <div class="Overlays_underlay__nUyk3 Overlays_is-open__xwDvf"></div>
                                                                <div class="Overlays_modal-wrapper__G3WQL Overlays_is-open__xwDvf">
                                                                    <div data-ismodal="true"
                                                                        class="Overlays_modal__X3QSB Overlays_is-open__xwDvf undefined overflow-y-auto"><span
                                                                            data-focus-scope-start="true" hidden=""></span>
                                                                        <div class="relative h-full">
                                                                            <div class="flex flex-col h-24 md:h-28 lg:rounded-t-lg sticky top-0 z-1 bg-game-daily-light">
                                                                                <div class="flex justify-center py-3 relative">
                                                                                    <span class="m-4 absolute top-0 right-0 c-pointer close">
                                                                                        <svg class="transform rotate-45 w-3 h-3" width="14" height="14" viewBox="0 0 14 14"
                                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                                d="M8.59182 11.8214C8.59182 12.7002 7.8798 13.4122 7.00108 13.4122C6.57414 13.4122 6.17144 13.2417 5.87578 12.9461C5.58026 12.6506 5.41001 12.2478 5.41001 11.8212L5.40978 8.59098L2.17988 8.59098C1.75294 8.59098 1.35024 8.42055 1.05458 8.12489C0.75906 7.82937 0.588814 7.42658 0.588814 6.99992C0.588814 6.12119 1.30083 5.40918 2.17955 5.40918L5.41001 5.40918L5.41001 2.17872C5.41001 1.29999 6.12203 0.587978 7.00076 0.587977C7.87948 0.587978 8.59182 1.30031 8.59182 2.17904L8.59182 5.40895L11.822 5.40918C12.7007 5.40918 13.413 6.12151 13.413 7.00024C13.413 7.87897 12.701 8.59098 11.8223 8.59098H8.59182V11.8214Z"
                                                                                                fill="#2D4550"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="relative text-center">
                                                                                    <div class="relative flex justify-center">
                                                                                        <div class="absolute flex space-x-1">
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm"></span>
                                                                                                <span aria-hidden="true" class="sp-1"><?= $val['bal1'] ?></span>
                                                                                                <input type="text" class="num1" hidden name="n1">
                                                                                            </div>
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm "></span>
                                                                                                <span
                                                                                                    aria-hidden="true" class="sp-2"><?= $val['bal2'] ?></span>
                                                                                                <input type="text" class="num2" hidden name="n2">
                                                                                            </div>
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm "></span>
                                                                                                <span aria-hidden="true" class="sp-3"><?= $val['bal3'] ?>
                                                                                                </span>
                                                                                                <input type="text" class="num3" hidden name="n3">
                                                                                            </div>
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                                                                    aria-hidden="true"
                                                                                                    class="sp-4"> <?= $val['bal4'] ?></span>
                                                                                                <input type="text" class="num4" hidden name="n4">
                                                                                            </div>
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                                                                    aria-hidden="true"
                                                                                                    class="sp-5"><?= $val['bal5'] ?></span>
                                                                                                <input type="text" class="num5" hidden name="n5">
                                                                                            </div>
                                                                                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                                                                <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                                                                    aria-hidden="true"
                                                                                                    class="sp-6"><?= $val['bal6'] ?></span>
                                                                                                <input type="text" class="num6" hidden name="n6">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="pb-24 overflow-y-auto w-full lg:w-168 no-scrollbar px-2">
                                                                                <div class="bg-white px-2 mt-2">
                                                                                    <div class="border-gray-300 border-b-1 py-1 mb-2 flex justify-between"><span
                                                                                            class="p-1 text-base text-left flex gap-x-3">
                                                                                            <h6
                                                                                                class="font-bold">Pick 6 numbers</h6>
                                                                                        </span>
                                                                                        <p class="py-1"><span><span class="countnum">6</span> of 6</span></p>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="ml-3 flex flex-wrap gap-2">
                                                                                    <?php
                                                                                    for ($i = 1; $i <= 50; $i++) {
                                                                                    ?>
                                                                                        <div class=" flex items-center justify-center cursor-pointer rounded-circle w-8 h-8 md:w-11 md:h-11 border border-gray-600 bg-white text-base font-bold" onclick="clickbals()">
                                                                                            <div aria-hidden="true"><?= $i ?></div>
                                                                                            <input style="height: 2.5rem;width: 2.5rem" type="checkbox" class="opacity-0 absolute balls cursor-pointer" name="balls[<?= $i ?>]"
                                                                                                aria-label="1" id="name"
                                                                                                value="<?= $i ?>">
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="bg-white flex w-full justify-evenly p-3 mt-6 shadow-top fixed lg:absolute bottom-0 h-20 lg:rounded-b-lg resq">
                                                                                <input type="reset" data-elem-reset-num-button="true" id="re1" value="Reset" onclick=""
                                                                                    class="reset flex items-center justify-center rounded-full position-relative border text-sm transition duration-150 uppercase font-bold w-1/2 mx-2 cursor-default bg-white border-blue-800 border-gray-400"
                                                                                    data-selected="false">
                                                                                <label class="cursor-pointer d-flex align-items-center position-absolute responr" for="<?= $kay ?>" style="right: 19%; bottom: 39%; white-space: nowrap;">
                                                                                    Add numbers
                                                                                </label>
                                                                                <input type="submit" data-elem-add-num-button="true" value="<?= $kay ?>" id="<?= $kay ?>"
                                                                                    name="edite"
                                                                                    class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-1/2 mx-2 cursor-default bg-green-500 border-green-400 border-gray-400"
                                                                                    data-selected="false" style="text-indent:-9999px;">
                                                                            </div>
                                                                        </div>
                                                                        <span data-focus-scope-end="true" hidden=""></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>

                                        <div class="flex flex-col space-y-4 mt-3 block1" style="margin-left: 35px">
                                            <button class="relative text-center rounded-full p-2 border border-gray-300 hover:shadow-hover cursor-pointer bg-white w-min" ">
                                        <div class=" inline-flex justify-center z-2 pt-1 mx-1 space-x-1">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full justify-center bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-1"></span>
                                                </div>
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full  bgs2 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-2">
                                                    </span>
                                                </div>
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs3 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-3">
                                                    </span>
                                                </div>
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs4 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-4">
                                                    </span>
                                                </div>
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs5 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-5">
                                                    </span>
                                                </div>
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs6 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                                    <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-6">
                                                    </span>
                                                </div>
                                        </div>
                                        <div class="absolute sb inline z-1 w-auto mx-auto top-1/3 left-0 right-0 text-center"
                                            style="">
                                            <p aria-label="Enter Numbers smb" class="font-bold text-lg"><span
                                                    class="inline-flex relative"> <svg width="15"
                                                        height="14"
                                                        viewBox="0 0 15 14"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12.7625 5.26325C13.7218 5.26325 14.4991 6.04055 14.4991 6.99984C14.4991 7.46593 14.313 7.90555 13.9902 8.22831C13.6676 8.55093 13.2279 8.73678 12.7622 8.73678L9.23582 8.73703L9.23582 12.2631C9.23582 12.7292 9.04976 13.1688 8.727 13.4915C8.40439 13.8142 7.96466 14 7.49888 14C6.53959 14 5.7623 13.2227 5.7623 12.2634L5.7623 8.73678H2.23565C1.27635 8.73678 0.49906 7.95949 0.49906 7.00019C0.49906 6.0409 1.27671 5.26325 2.236 5.26325L5.76204 5.26325L5.7623 1.73696C5.7623 0.777663 6.53994 1.80256e-05 7.49924 1.86999e-05C8.45853 1.85313e-05 9.23582 0.777313 9.23582 1.73661L9.23582 5.26325L12.7625 5.26325Z"
                                                            fill="#2D4550"></path>
                                                    </svg></span> <span> Enter Numbers</span>
                                            </p>
                                        </div>
                                        </button>
                                    </div>

                                    <p class="mt-4 text-danger"><?= $Error_MSG ?></p>
                                </div>
                                <div id="block2" class="flex flex-col w-100 space-y-4 mt-3 block2 hidden" style="margin-left: 35px">
                                    <h1 style="width: 20vh;">Into how many parts should it be divided?</h1>
                                    <div>
                                        <div class="radio-container">
                                            <h2>Select an Option</h2>

                                            <!-- Radio buttons for selection -->
                                            <label class="radio-option">1
                                                <input type="radio" class="selectedOption" name="selectedOption" value="1" onclick="selectOption(this.value)">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-option">2
                                                <input type="radio" class="selectedOption" name="selectedOption" value="2" onclick="selectOption(this.value)">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-option">3
                                                <input type="radio" class="selectedOption" name="selectedOption" value="3" onclick="selectOption(this.value)">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-option">4
                                                <input type="radio" class="selectedOption" name="selectedOption" value="4" onclick="selectOption(this.value)">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-option">5
                                                <input type="radio" class="selectedOption" name="selectedOption" value="5" onclick="selectOption(this.value)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                        <script>
                                            // Function to set the selected option in a cookie
                                            function selectOption(value) {
                                                document.cookie = "selectedOption=" + value + "; path=/"; // Set cookie for the selected option
                                                displaySelectedOption(); // Display the selected option without reload
                                            }

                                            // Function to get a cookie value by name
                                            function getCookie(name) {
                                                const value = "; " + document.cookie;
                                                const parts = value.split("; " + name + "=");
                                                if (parts.length === 2) return parts.pop().split(";").shift();
                                            }

                                            // Function to display the selected option from the cookie
                                            function displaySelectedOption() {
                                                const selectedOption = getCookie("selectedOption");
                                                const buttonElement = document.querySelector('#toggleButton1'); // Replace with the actual button ID or class
                                                buttonElement.style.backgroundColor = 'rgba(196, 220, 51, 1)';

                                                document.getElementById('selectedValueDisplay').innerText = "Selected Value: " + (selectedOption || "None");
                                            }

                                            // Display the cookie value on page load if already set
                                            displaySelectedOption();
                                        </script>

                                    </div>
                                </div>
                                <div id="block3" class="flex flex-col w-100 space-y-4 mt-3 block2 hidden">
                                    <span>do you want use gem for more chance?</span>

                                    <div class="input-group mb-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">💎</span>
                                            </div>

                                            <input type="text" onchange="changeOption(this.value)" class="form-control" name="gems" placeholder="gems" aria-label="Username" aria-describedby="basic-addon1" value="0" id="gemInput">

                                            <!-- Increment, Decrement, and Max buttons -->
                                            <div class="input-group-append pl-2">
                                                <button class="btn btn-outline-secondary" type="button" onclick="decrement()">-</button>
                                                <button class="btn btn-outline-secondary" type="button" onclick="increment()">+</button>
                                                <button class="btn btn-outline-secondary" type="button" onclick="setMax()">Max</button>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <script>
                                        function increment() {
                                            const input = document.getElementById("gemInput");
                                            let value = parseInt(input.value, 10) || 0;
                                            input.value = value + 1;
                                            changeOption(input.value); // Call your onchange function if needed
                                        }

                                        function decrement() {
                                            const input = document.getElementById("gemInput");
                                            let value = parseInt(input.value, 10) || 0;
                                            if (value > 0) { // Optional: Prevent going below 0
                                                input.value = value - 1;
                                                changeOption(input.value);
                                            }
                                        }

                                        function setMax() {
                                            MAX_VALUE = <?php echo $usergems ?>

                                            const input = document.getElementById("gemInput");
                                            input.value = MAX_VALUE;
                                            changeOption(input.value);
                                        }
                                        // Function to set the entered gem count in a cookie
                                        function changeOption(value) {
                                            document.cookie = "inputOption=" + value + "; path=/"; // Set cookie for the entered gem count
                                            displaychangeOption(); // Display the entered gem count immediately
                                        }

                                        // Function to get a cookie value by name
                                        function getCookie(name) {
                                            const value = "; " + document.cookie;
                                            const parts = value.split("; " + name + "=");
                                            if (parts.length === 2) return parts.pop().split(";").shift();
                                        }

                                        // Function to display the entered gem count from the cookie
                                        function displaychangeOption() {
                                            const selectedOption = getCookie("inputOption");
                                            displayElement.textContent = selectedOption

                                        }

                                        // Display the cookie value on page load if already set
                                        displaychangeOption();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="flex-col md:flex-row flex bg-white englock shadow fixed bottom-0 w-full z-20 py-4 px-4 md:px-7 lg:px-28 rounded-t-lg justify-between lg:justify-end items-center">
        <div class="flex justify-between lg:justify-end w-full">
            <div class="flex flex-row md:flex-col justify-between w-full md:w-auto lg:mr-4 mb-2 md:mb-0">
                <div class="flex justify-end font-bold">from $<?= $_SESSION['pay'] ?> per line</div>
            </div>
        </div>
        <form action="" method="post">
            <div class="justify-between md:justify-end w-full flex flex-row w-full md:w-auto">
                <input type="button" value="Back" onclick="showBlock1()"
                    class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-full sm:w-44 md:w-48 lg:w-64 h-12 shadow-button hover:shadow-button-hov text-blue-800 bg-white active:bg-green-400"
                    data-selected="false">
                <input type="button" value="Continue" onclick="showBlock2()" id="toggleButton"
                    class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-full sm:w-44 md:w-48 lg:w-64 h-12 shadow-button hover:shadow-button-hov text-blue-800 bg-green-600 border-green-400 active:bg-green-400">
                <input type="button" value="Continue" onclick="showBlock3()" id="toggleButton1"
                    class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-full sm:w-44 md:w-48 lg:w-64 h-12 shadow-button hover:shadow-button-hov text-blue-800 bg-green-600 border-green-400 active:bg-green-400 hidden">
                <input type="submit" name="paysubmit" value="paysubmit" id="submitPay" data-selected="false"
                    class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase active font-bold w-full sm:w-44 md:w-48 lg:w-64 h-12 shadow-button hover:shadow-button-hov text-white bg-green-500 border-green-400  hidden">
                <?php
                if (isset($_POST['submitPay'])) {
                }
                ?>
            </div>
        </form>

        <?php
        if (isset($_POST['paysubmit'])) {
            if (isset($_SESSION['PayShop'])) {
                if (count($_SESSION['PayShop']) > 0) {
                    if (isset($_SESSION['emailc'])) {
                        $ordayid = rand(10000000, 99999999);
                        $now = time();
                        foreach ($_SESSION['PayShop'] as $paybu) {
                            $randCode = rand(1000, 9999);
                            $order = $reggg->InsertOrderTabel($_SESSION['emailc'], $paybu['bal1'], $paybu['bal2'], $paybu['bal3'], $paybu['bal4'], $paybu['bal5'], $paybu['bal6'], $ordayid, $randCode, $_GET['CardName'], $_SESSION['pay'], $now, $_COOKIE["selectedOption"], $_COOKIE["inputOption"] ? $_COOKIE["inputOption"] : 0);
                            if (is_string($order) && str_contains($order, "Error")) {
                                // If an error message is returned, set error flag and break the loop
                                $hasError = true;
                                echo $order; // Display the error message
                                break;
                            } else {
                                // If no error, print the order details for debugging or logging
                                print_r($order);
                            }
                        }
                        if (!$hasError) {
                            $rgb = count($_SESSION['PayShop']);
                            $_SESSION['payy'] = $pay11->oxPay($_SESSION['pay'] * $rgb, $_SESSION['emailc'], $ordayid, $_GET['CardName']);
                            $reggg->insertTrak($_SESSION['emailc'], $_SESSION['payy']->trackId, $ordayid);
                            unset($_SESSION['PayShop']);
                            header("Location:" . $_SESSION['payy']->payLink);
                        }
                    } else {
                        header("Location:login.php");
                    }
                }
            }
        }
        ?>
    </div>
    </div>
    <form action="" method="post">
        <div style="background: transparent; display: none" id="AddClo">
            <div class="Overlays_underlay__nUyk3 Overlays_is-open__xwDvf"></div>
            <div class="Overlays_modal-wrapper__G3WQL Overlays_is-open__xwDvf">
                <div data-ismodal="true"
                    class="Overlays_modal__X3QSB Overlays_is-open__xwDvf undefined overflow-y-auto"><span
                        data-focus-scope-start="true" hidden=""></span>
                    <div class="relative h-full">
                        <div class="flex flex-col h-24 md:h-28 lg:rounded-t-lg sticky top-0 z-1 bg-game-daily-light">
                            <div class="flex justify-center py-3 relative">
                                <p
                                    class="p-1 uppercase font-bold text-blue-900"
                                    aria-label="Daily Million line 1"></p>
                                <span class="m-4 absolute top-0 right-0 c-pointer close1">
                                    <svg class="transform rotate-45 w-3 h-3" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.59182 11.8214C8.59182 12.7002 7.8798 13.4122 7.00108 13.4122C6.57414 13.4122 6.17144 13.2417 5.87578 12.9461C5.58026 12.6506 5.41001 12.2478 5.41001 11.8212L5.40978 8.59098L2.17988 8.59098C1.75294 8.59098 1.35024 8.42055 1.05458 8.12489C0.75906 7.82937 0.588814 7.42658 0.588814 6.99992C0.588814 6.12119 1.30083 5.40918 2.17955 5.40918L5.41001 5.40918L5.41001 2.17872C5.41001 1.29999 6.12203 0.587978 7.00076 0.587977C7.87948 0.587978 8.59182 1.30031 8.59182 2.17904L8.59182 5.40895L11.822 5.40918C12.7007 5.40918 13.413 6.12151 13.413 7.00024C13.413 7.87897 12.701 8.59098 11.8223 8.59098H8.59182V11.8214Z"
                                            fill="#2D4550"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="relative text-center">
                                <div class="relative flex justify-center">
                                    <div class="absolute flex space-x-1">
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm"></span>
                                            <span aria-hidden="true" class="sp-1"></span>
                                            <input type="text" id="num1" hidden name="n1">
                                        </div>
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm "></span>
                                            <span
                                                aria-hidden="true" class="sp-2"></span>
                                            <input type="text" id="num2" hidden name="n2">
                                        </div>
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm "></span>
                                            <span aria-hidden="true" class="sp-3"></span>
                                            <input type="text" id="num3" hidden name="n3">
                                        </div>
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                aria-hidden="true"
                                                class="sp-4"></span>
                                            <input type="text" id="num4" hidden name="n4">
                                        </div>
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                aria-hidden="true"
                                                class="sp-5"></span>
                                            <input type="text" id="num5" hidden name="n5">
                                        </div>
                                        <div class="self-auto flex font-bold rounded-full justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white bg-game-daily NumberPicker_picked___UxMw">
                                            <span class="absolute opacity-0 w-full h-full text-x-sm "></span><span
                                                aria-hidden="true"
                                                class="sp-6"></span>
                                            <input type="text" id="num6" hidden name="n6">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="pb-24 overflow-y-auto w-full lg:w-168 no-scrollbar px-2">
                            <div class="bg-white px-2 mt-2">
                                <div class="border-gray-300 border-b-1 py-1 mb-2 flex justify-between"><span
                                        class="p-1 text-base text-left flex gap-x-3">
                                        <h6
                                            class="font-bold">Pick 6 numbers</h6>
                                    </span>
                                    <p class="py-1"><span><span id="count">0</span> of 6</span></p>
                                </div>
                            </div>


                            <div class="ml-3 flex flex-wrap gap-2">
                                <?php
                                for ($i = 1; $i <= 50; $i++) {
                                ?>
                                    <div for="<?= $i ?>"
                                        class="cursor-pointer flex items-center justify-center cursor-pointer  rounded-circle w-8 h-8 md:w-11 md:h-11 border border-gray-600 bg-white text-base font-bold">
                                        <div aria-hidden="true" class="ballss"><?= $i ?></div>
                                        <input style="height: 2.5rem;width: 2.5rem" type="checkbox" class="opacity-0 absolute ballss cursor-pointer" name="ballss[<?= $i ?>]" onclick="onc()"
                                            aria-label="1" id="<?= $i ?>"
                                            value="<?= $i ?>">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bg-white flex w-full justify-evenly p-3 mt-6 shadow-top fixed lg:absolute bottom-0 h-20 lg:rounded-b-lg resq">
                            <input type="reset" data-elem-reset-num-button="true" id="re2" value="Reset" onclick="oncr()"
                                class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-1/2 mx-2 cursor-default bg-white border-blue-800 border-gray-400"
                                data-selected="false">
                            <input type="submit" data-elem-add-num-button="true" value="add"
                                data-selected="false"
                                name="submitshop"
                                class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold w-1/2 mx-2 cursor-default bg-green-500 border-green-400 border-gray-400"
                                data-selected="false">
                        </div>
                    </div>
                    <span data-focus-scope-end="true" hidden=""></span>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const spanElement = document.querySelector('.sp-1');
                const buttonElement = document.querySelector('#toggleButton'); // Replace with the actual button ID or class


                function checkAndChangeButtonColor() {
                    const n3 = spanElement.innerText.trim(); // Trim any whitespace

                    // Check if span has a value and change button color accordingly
                    if (n3) {

                        buttonElement.style.backgroundColor = 'rgba(196, 220, 51, 1)';
                    }
                }

                // Set up MutationObserver to listen for changes in span content
                const observer = new MutationObserver(checkAndChangeButtonColor);
                observer.observe(spanElement, {
                    childList: true,
                    characterData: true,
                    subtree: true
                });

                // Debug: Log initial state
                checkAndChangeButtonColor();
            });



            // Alternatively, if using an input element to update span, add an input event listener

            function showBlock1() {
                document.getElementById('block1').classList.remove('hidden');
                document.getElementById('block2').classList.add('hidden');
                document.getElementById('block3').classList.add('hidden');
                const button1 = document.getElementById('toggleButton1').classList.add("hidden");

                document.getElementById('toggleButton').value = "Continue";
                document.getElementById('submitPay').classList.add('hidden'); // Hide submit button
                const button = document.getElementById('toggleButton').classList.remove("hidden");

            }

            function showBlock2() {
                // Get the value of n3 input
                const n3 = document.querySelector('.sp-1').innerText;
                // Check if n3 is empty
                if (!n3) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Value',
                        text: 'The span element does not have a value!',
                        confirmButtonText: 'OK'
                    });
                    return; // Stop function execution if n3 is missing
                }

                // Hide other blocks and show block2
                document.getElementById('block1').classList.add('hidden');
                document.getElementById('block2').classList.remove('hidden');

                // Toggle button visibility
                document.getElementById('toggleButton').classList.add('hidden');
                document.getElementById('toggleButton1').classList.remove('hidden');

            }

            function showBlock3() {
                const selectedoption = document.querySelectorAll(".selectedOption")
                let isSelected = false;
                selectedoption.forEach(option => {
                    if (option.checked) {
                        isSelected = true;
                    }
                });

                if (!isSelected) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Value',
                        text: 'The span element does not have a value!',
                        confirmButtonText: 'OK'
                    });
                    return; // Stop function execution if n3 is missing
                }
                document.getElementById('block1').classList.add('hidden');
                document.getElementById('block2').classList.add('hidden');
                document.getElementById('block3').classList.remove('hidden');

                const button = document.getElementById('toggleButton1').classList.add("hidden");
                const submitButton = document.getElementById('submitPay');
                submitButton.classList.remove('hidden');

                // Show submit button if moving to "Pay" step

            }
        </script>
        <script>
            let count = document.getElementById('count');
            let num = 0;

            function onc() {
                if (num < 6) {
                    num++;
                    count.innerText = num;
                }
            }

            function oncr() {
                num = 0;
                count.innerText = num;
            }
        </script>
    </form>
    <?php
    include_once 'inc/footer.php';
    ?>
    </div>

    </div>
    <script>
        let num1 = 1;

        function clickbals() {
            if (num1 < 6) {
                num1++;
            }
        }
    </script>
    <script>
        $('.balls').click(function() {
            $(this).parent().parent().parent().find('.countnum').text(num1);
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.ballss').click(function() {

                if ($(this).parent().parent().parent().parent().find('.sp-1').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-1').text(this.value);
                    $(this).parent().parent().parent().parent().find('#num1').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-2').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-2').text(this.value);
                    $(this).parent().parent().parent().parent().find('#num2').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-3').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-3').text(this.value);
                    $(this).parent().parent().parent().parent().find('#num3').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-4').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-4').text(this.value);
                    $(this).parent().parent().parent().parent().find('#num4').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-5').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-5').text(this.value);
                    $(this).parent().parent().parent().parent().find('#num5').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-6').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-6').text(this.value)
                    $(this).parent().parent().parent().parent().find('#num6').val(this.value);
                    $(this).parent().toggleClass('d-none');
                }
            })
            $('.balls').click(function() {
                if ($(this).parent().parent().parent().parent().find('.sp-1').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-1').text(this.value);
                    $(this).parent().parent().parent().parent().find('.num1').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-2').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-2').text(this.value);
                    $(this).parent().parent().parent().parent().find('.num2').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-3').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-3').text(this.value);
                    $(this).parent().parent().parent().parent().find('.num3').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-4').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-4').text(this.value);
                    $(this).parent().parent().parent().parent().find('.num4').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-5').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-5').text(this.value);
                    $(this).parent().parent().parent().parent().find('.num5').val(this.value);
                    $(this).parent().toggleClass('d-none');
                } else if ($(this).parent().parent().parent().parent().find('.sp-6').text() == '') {
                    $(this).hide();
                    $(this).parent().parent().parent().parent().find('.sp-6').text(this.value)
                    $(this).parent().parent().parent().parent().find('.num6').val(this.value);
                    $(this).parent().toggleClass('d-none');
                }


            })
            $('.reset').click(function() {
                $(this).parent().parent().parent().parent().find('.sp-1').text('');
                $(this).parent().parent().parent().parent().find('.sp-2').text('');
                $(this).parent().parent().parent().parent().find('.sp-3').text('');
                $(this).parent().parent().parent().parent().find('.sp-4').text('');
                $(this).parent().parent().parent().parent().find('.sp-5').text('');
                $(this).parent().parent().parent().parent().find('.sp-6').text('');
                $(this).parent().parent().find(".balls").show();
                $(this).parent().parent().find(".balls").parent().removeClass('d-none');
                $(this).parent().parent().find('.countnum').text('0')
            })
            $('#re2').click(function() {
                $(this).parent().parent().parent().parent().find('.sp-1').text('');
                $(this).parent().parent().parent().parent().find('.sp-2').text('');
                $(this).parent().parent().parent().parent().find('.sp-3').text('');
                $(this).parent().parent().parent().parent().find('.sp-4').text('');
                $(this).parent().parent().parent().parent().find('.sp-5').text('');
                $(this).parent().parent().parent().parent().find('.sp-6').text('');
                $(this).parent().parent().find(".ballss").show();
                $(this).parent().parent().find(".ballss").parent().removeClass('d-none');
            })
        })
        $(document).ready(function() {
            $('.addblock').click(function() {
                $(this).parent().find('form').show();
                $('.englock').hide();
            })
            $('.close').click(function() {
                $(this).parent().parent().parent().parent().parent().parent().parent().fadeOut();
                $('.englock').show();
            })
        })
        $(document).ready(function() {
            $('.block1').click(function() {
                $('#AddClo').css('display', 'block')
            })
            $('.close1').click(function() {
                $(this).parent().parent().parent().parent().parent().parent().fadeOut();
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.addblock').click(function() {
                $(this).find('.AddClo').show();
            })
            $('.close').click(function() {
                $('.AddClo').hide();
            })
        })
    </script>
    <script>
    </script>
<?php

} else {
    header("Location:basket.php");
}
?>
<?php
include_once '../clases/Cheak.php';
$shop = new readingData();
$cheak = new Cheak();
$res111 = $shop->SelTrack($_SESSION['emailc']);
$test = $shop->selectTrackk($_SESSION['emailc']);

$orders = $shop->getallorder($_SESSION['emailc']);
foreach ($res111 as $alw) {
    foreach ($test as $test2) {
        if ($test2['orderId'] == $alw['orderId']) {
            if ($test2['Status'] == 1) {
                $update->UpdateOrder($test2['orderId']);
            }
        }
    }
}
$AllShop1 = $shop->ReadShop($_SESSION['emailc']);
?>


    <?php
                    foreach ($orders as $ord) {
                        $card = $shop->selCarsWithName($ord["CardName"]);
                        $cardhead = $shop->selCarsWithName1($ord["CardName"]);
                        if ($card) {

                ?>
                            <div style="background-image: url('/image/CardsImage/<?= htmlspecialchars($card['cardImage']) ?>');">
                                <div class="position-relative">
                                    <img class="position-absolute top-0 start-0" width="40px" height="40px" src="/image/CardsImage/<?= $card['cardHeader'] ?>">
                                </div>
                                <div class="d-flex pt-5 px-2">
                                    <?php echo $ord["CardName"] ?>
                                </div>
                                <div class=" d-flex justify-center z-2 pt-1 mx-1 space-x-1">
                                    <div class="self-auto flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div
                                            class="self-auto flex font-bold rounded-full justify-center bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-1"><?php echo $ord["balls1"] ?></span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full  bgs2 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-2"><?php echo $ord["balls2"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs3 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-3"><?php echo $ord["bals3"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs4 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-4"><?php echo $ord["balls4"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs5 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-5"><?php echo $ord["balls5"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs6 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-6"><?php echo $ord["balls6"] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-5 pt-4 pb-4">
                                    <div class="d-grid">
                                        <label>date</label>
                                        <span>
                                            <?php echo $ord["Datet"] ?>
                                        </span>
                                    </div>
                                    <div class="d-grid">
                                        <label>trace id</label>
                                        <span>
                                            <?php echo $ord["orderId"] ?>
                                        </span>
                                    </div>
                                    <div class="d-grid">
                                        <label>price</label>
                                        <span>
                                            <?php echo $ord["price"] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div style="background-image: url('/image/CardsImage/<?= htmlspecialchars($cardhead['cardImage']) ?>');">

                                <div class="position-relative">
                                    <img class="position-absolute top-0 start-0" width="40px" height="40px" src="/image/CardsImage/<?= $cardhead['cardHeadImage'] ?>">
                                </div>
                                <div class="d-flex pt-5 px-2">
                                    <?php echo $ord["CardName"] ?>
                                </div>
                                <div class="position-relative">
                                    <img class="position-absolute top-0 end-0" width="60px" height="60px" src="/image/CardsImage/<?= $card['cardImage'] ?>">
                                    <img class="position-absolute top-0 start-0" width="40px" height="40px" src="/image/CardsImage/<?= $card['cardHeader'] ?>">
                                </div>
                                <div class="d-flex pt-5 px-2">
                                    <?php echo $ord["CardName"] ?>
                                </div>
                                <div class=" d-flex justify-center z-2 pt-1 mx-1 space-x-1">
                                    <div class="self-auto flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div
                                            class="self-auto flex font-bold rounded-full justify-center bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-1"><?php echo $ord["balls1"] ?></span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full  bgs2 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-2"><?php echo $ord["balls2"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs3 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-3"><?php echo $ord["bals3"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs4 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-4"><?php echo $ord["balls4"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs5 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-5"><?php echo $ord["balls5"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $cardhead["color"] ?>">
                                        <div style="background-color: unset"
                                            class="self-auto flex font-bold rounded-full bgs6 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                            <span class="absolute  w-full h-full text-x-sm "></span><span
                                                aria-hidden="true" class="sp-6"><?php echo $ord["balls6"] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid justify-content-center gap-5 pt-4 pb-4">

                                    <div class="d-flex">
                                        <label>date:</label>
                                        <span>
                                            <?php echo $date = date("Y-m-d H:i:s", $ord["Datet"]);?>
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <label>trace id:</label>
                                        <span>
                                            <?php echo $ord["orderId"] ?>
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <label>price:</label>
                                        <span>
                                            <?php echo $ord["price"] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <hr>
                <?php
                    }

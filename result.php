<?php
include_once 'clases/db_connect.php';
include_once 'inc/header.php';
include_once 'clases/readingData.php';
$v_Reading = new readingData();
if (isset($_GET['cardName'])){
    $vc = $v_Reading->selCarsWithName($_GET['cardName']);
    if (empty($vc)){
        $vc = $v_Reading->selCarsWithName1($_GET['cardName']);
    }
    $v_res = $v_Reading->selWinnerCardName($_GET['cardName']);
    if (!empty($v_res) || !empty($vc)){
        ?>
<div id="__next">
    <div class="bg-results-gradient pb-8  p-0">
        <svg class="w-full absolute h-1/2 md:h-90 lg:h-1/2" viewBox="0 0 1375 321" fill="none" style="height: 10%"
             xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1375 240.444C989.428 240.444 659.272 260.583 659.272 260.583C659.272 260.583 413.605 270.652 0.00012207 321L5.6863e-05 81.7989L0.000106401 -126.587L3.48253e-05 -339C3.48253e-05 -339 114.475 -339 389.884 -339C665.292 -339 747.915 -339 976.716 -339C1205.52 -339 1375 -339 1375 -339L1375 240.444Z"
                  fill="#E7EFF3"></path>
        </svg>
        <div class="relative z-1">
            <div class="w-screen">
                <div class="flex w-full flex-row max-w-screen-lg mx-auto pt-4"><h1
                            class="ml-4 lg:ml-0 capitalize mb-6 font-black text-3xl">Latest <?=$_GET['cardName']?> Results</h1></div>
            </div>
            <?php
            if (!empty($v_res)){
            foreach ($v_res as $v_re){
            ?>

            <div class="lg:container mx-auto  grid sm:grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-4 ">
                <div class="md:px-0 col-start-1 col-span-full lg:col-start-3 lg:col-span-8">
                    <div class="Overlays_modal-wrapper__G3WQL">
                        <div class="Overlays_modal__X3QSB">
                            <div id="datePicker"
                                 class="w-80 h-82 my-0 mx-auto rounded-xl border-0 border-grey-100 pb-5 pt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-start-1 col-span-full lg:col-start-3 lg:col-span-8">
                    <div class="my-4"><h2
                                          class="font-black text-2xl"><?=$v_re['Date']?></h2>
                        <div class="relative shadow my-2 lg:flex lg:justify-between bg-white rounded-t-md">
                            <div class="lg:w-full flex flex-col justify-evenly">
                                <div class="px-4 md:px-9">
                                    <div class="bg-white flex justify-between pt-3 pb-3 rounded-t-lg">
                                        <div class="w-22 -mb-1"><img src="image/CardsImage/<?=$vc['Basket_Image']?>"
                                                                     alt="Lotto logo" class="w-full h-full"></div>
                                        <div class="text-right"><p class="text-bold text-base "><span class="font-bold"></span>
                                            </p>
                                            <p class="font-black text-xl"><?=$vc['winnermoney']?></p></div>
                                    </div>
                                    <div class="pb-5 flex justify-center items-center lg:block">
                                        <div class="justify-center flex flex-row flex-wrap gap-6 lg:gap-10">
                                            <div class="flex-col">
                                                <div class="leading-5 font-bold py-1.5">Winning numbers</div>
                                                <div class="flex flex-col space-y-4">
                                                    <div class="flex gap-1.5 md:gap-2 flex-wrap">
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">
                                                            <?=$v_re['BALLS1']?>
                                                        </div>
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">
                                                            <?=$v_re['BALLS2']?>
                                                        </div>
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">
                                                            <?=$v_re['BALLS3']?>
                                                        </div>
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">
                                                            <?=$v_re['BALLS4']?>
                                                        </div>
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">

                                                            <?=$v_re['BALLS5']?>
                                                        </div>
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl" style="background-color:<?php echo $vc['color'] ?>">
                                                            <?=$v_re['BALLS6']?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <div class="leading-5 font-bold py-1.5">Random Kay</div>
                                                <div class="flex flex-col space-y-4">
                                                    <div class="flex gap-1.5 md:gap-2 flex-wrap">
                                                        <div class="flex font-bold rounded-full justify-center items-center relative text-white w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl ring-red-800 ring-2 ring-offset-4 mx-0.5 md:mx-auto">
                                                            <?=$v_re['random']?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="lg:w-full border-solid border-t-1 border-gray-300 relative p-0"
                                    aria-hidden="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        <?php
            }
            }else{

                ?>

                <div class="lg:container mx-auto  grid sm:grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-4 ">
                    <div class="md:px-0 col-start-1 col-span-full lg:col-start-3 lg:col-span-8">
                        <div class="Overlays_modal-wrapper__G3WQL">
                            <div class="Overlays_modal__X3QSB">
                                <div id="datePicker"
                                     class="w-80 h-82 my-0 mx-auto rounded-xl border-0 border-grey-100 pb-5 pt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-start-1 col-span-full lg:col-start-3 lg:col-span-8">
                        <div class="my-4"><h2
                                    class="font-black text-2xl"></h2>
                            <div class="relative shadow my-2 lg:flex lg:justify-between bg-white rounded-t-md">
                                <div class="lg:w-full flex flex-col justify-evenly">
                                    <div class="px-4 md:px-9">
                                        <div class="bg-white flex justify-between pt-3 pb-3 rounded-t-lg">
                                            <div class="w-22 -mb-1"><img src="image/CardsImage/<?=$vc['Basket_Image']?>"
                                                                         alt="Lotto logo" class="w-full h-full"></div>
                                            <div class="text-right d-flex align-items-center"><p class="text-bold text-base " style="font-size: 35px"><span class="font-bold"></span>
                                                    Noting To Show
                                                </p>
                                        </div>
                                        <div class="pb-5 flex justify-center items-center lg:block">
                                            <div class="justify-center flex flex-row flex-wrap gap-6 lg:gap-10">
                                                <div class="flex-col">
                                                    <div class="flex flex-col space-y-4">
                                                        <div class="flex gap-1.5 md:gap-2 flex-wrap">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="lg:w-full border-solid border-t-1 border-gray-300 relative p-0"
                                        aria-hidden="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
            }
    ?>
        </div>
    </div>

</div>
        <?php
        include_once 'inc/footer.php'
        ?>
        <?php
    }
}
?>
<?php
ob_start();
session_start();
include_once 'inc/header.php';

include_once 'clases/register.php';

include_once 'clases/viwe.php';

$viwe = new viwe();

$dddd = $viwe->DayViwe();
$viwe->MonthViwe();
$resssss = $pdo->selAllby();
$res = $pdo->readCards();
$result1 = $pdo->selCard();
$now = time();
$tt = $result1['times'] - $now;
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

    <section>
        <div class="flex flex-col pb-12 lg:pt-4 max-w-6xl mx-auto">
            <div class="px-4 pt-4 flex flex-col space-y-4">
                <div class="flex cardl flex-col lg:flex-row gap-4 lg:items-stretch lg:h-120">
                    <button role="link"
                            class="HeroBanner_halfBasis__d_3Ul group rounded-lg lg:basis-3/6 lg:flex-grow transition-shadow duration-200 hover:shadow-cardHov relative overflow-hidden grid grid-rows-hero-banner lg:flex lg:flex-col cursor-pointer">
                        <div style="background-image:url(image/CardsImage/<?=$result1['cardHeadImage']?>)"
                             class="-z-1 bg-no-repeat bg-cover lg:bg-right md:bg-top bg-bottom rounded-t-lg w-full h-full flex-grow bg-gradient-to-t from-blue-hero-from to-blue-hero-to"></div>
                        <div class="relative flex flex-col text-white rounded-lg md:rounded-l-lg flex-shrink w-full">
                            <div class="absolute -top-8 md:-top-14 lg:-top-8 w-full -z-1 bottom-0"><img
                                        src="image/CardsImage/<?=$result1['bg_Image']?>"
                                        alt="logo background" class="w-full h-full object-cover object-top"></div>
                            <div class="w-full flex flex-row flex-wrap md:flex-nowrap lg:flex-col items-center lg:items-start px-4 pb-4 justify-between md:space-y-4 relative">
                                <div class="self-start md:self-center w-1/2 md:w-1/3 lg:w-full"><img
                                            alt="white Eurodreams logo" class="h-12 lg:h-16 filter drop-shadow"
                                            src="image/CardsImage/<?=$result1['cardImage']?>" role="img"></div>
                                <div class="flex-col text-left md:mt-0 w-1/2 md:w-1/3 lg:w-full"
                                     <?php
                                     if ($cnt1>0 || $tt> 1){
                                         ?>
                                     style="text-shadow: rgba(0, 0, 0, 0.3) 1px 1px;"><h1
                                            class="leading-none text-sm md:text-base font-bold"><?=$result1['cardHeader']?></h1>
                                        <?php
                                     }
                                     ?>

                                    <h2 class="text-base md:text-lg shadow-text leading-5 font-black text-lg" <?php if ($cnt1 ==0 || $cnt1<0){
                                                    ?>
                                                    style="width: 100%;
    margin-top: 15px;
    text-align: center;
    font-size: 24px;
    margin-bottom: 15px;
}"
                                        <?php

                                                }
                                                ?>
>
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
                                                            echo floor($ssss/(60*60)) .' Hours To Go';
                                                        }elseif ($ssss>$sec) {
                                                            echo floor($ssss / (60)) . ' Minute To Go';
                                                        }
                                                        else {
                                                            echo '<div>Drawing in process</div>';
                                                        }

                                                    }else{
                                                        if ($cnt1 == 0 || $cnt1<0){
                                                            echo 'Drawing in process ...';
                                                        }else{
                                                            echo $cnt1 .' To go';

                                                        }
                                                    }
                                                    ?>
                                   </h2>
                                    <?php
                                    if ($cnt1>0 || $tt> 1){
                                        ?>
                                        <h3 class=" pr-1 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black pt-1"
                                            aria-label="€20,000 per month for 30 years*"><span
                                                    class="text-5xl d-flex align-items-center leading-none md:text-5xl-xtra lg:text-5xl-xtra">$<?=$result1['winnermoney']?> <div
                                                        class="block leading-none lg:inline text-base md:text-2xl lg:text-lg" style="font-size: 22px">&nbsp<?=$result1['winnermoney_head']?></div></span>
                                        </h3>
                                        <?php
                                    }
                                    ?>

                                    <div class="w-full text-white" style="text-shadow: rgba(0, 0, 0, 0.3) 1px 1px;"><p
                                                class="text-left text-white text-x-sm font-bold absolute md:right-3 bottom-3 w-1/2 md:w-auto md:pt-10 text-end pe-2">
                                            *guaranteed</p></div>
                                </div>
                                <?php
                                if ($cnt1>0 || $tt> 1){
                                    ?>
                                    <div class="flex flex-row w-1/2 md:w-1/3 lg:w-auto md:justify-end lg:justify-start"><a
                                                aria-label="Play from €2.50 link"
                                                class="flex justify-center self-end cursor-pointer transition-colors duration-200 group-hover:text-blue-900 shadow-boxButton hover:shadow-boxButtonHov group-hover:bg-white rounded-full"
                                                href="baskettttt.php?CardName=<?=$result1['CardName']?>">
                                            <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
                                                <div class="uppercase text-sm font-bold leading-none xsm:text-sm"><span
                                                            aria-label="play from €2.50" class="ar">Play from $<?=$result1['Money']?></span></div>
                                            </div>
                                        </a></div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </button>
                    <div class="flex flex-col items-center lg:grid min-w-0 lg:basis-3/6 lg:flex-grow lg:grid-cols-2 lg:grid-flow-row gap-4 lg:auto-rows-fr HomePageDrawBasedGames_halfBasis__Bu_sf">
                        <?php
                        foreach ($res as $result_C){

                            $time = $result_C['times'] - $now;
                            $cnt= $result_C['countstamp'];
                            foreach ($resssss as $allby){
                                if ($allby['CardName']==$result_C['CardName']){
                                    $cnt--;
                                }
                            }
                        ?>

                        <div class="xsm:h-30 md:min-h-30 lg:min-h-0 h-full w-full lg:w-auto lg:h-full onhover">

                            <button class="group cursor-pointer text-left w-full h-full cardl" role="link">
                                <div class=" bg-left bg-cover bg-no-repeat text-white rounded-lg relative py-3 px-3 w-full h-full transition-shadow duration-200 hover:shadow-cardHov overflow-hidden" style="background-image: url('image/CardsImage/<?=$result_C['bg_Image']?>')">
                                    <div class="flex flex-col md:flex-row flex-wrap md:no-wrap items-center lg:items-start lg:flex-col h-full justify-between md:justify-start lg:space-y-4">
                                        <div class="self-start md:self-center lg:self-start filter drop-shadow w-1/2 md:w-1/3 lg:w-auto">
                                            <img alt="white Daily Million logo" class="h-12"
                                                 src="image/CardsImage/<?=$result_C['cardImage']?>" role="img">
                                        </div>
                                        <?php
                                        if ($cnt>0 || $time> 1){
                                            ?>

                                        <div class="flex flex-start h-auto -mt-3 md:mt-0 bottom-4 w-1/2 md:w-1/3 md:order-last lg:w-auto md:justify-end lg:justify-start lg:absolute false">
                                            <a aria-label="Play from €1 link"
                                               class="flex justify-center self-end cursor-pointer transition-colors duration-200 group-hover:text-blue-900 shadow-boxButton hover:shadow-boxButtonHov group-hover:bg-white rounded-full"
                                               href="baskettttt.php?CardName=<?=$result_C['CardName']?>">
                                                <div class="m-auto rounded-full border border-solid text-center px-3 py-1.5 border-white text-white group-hover:text-blue-900 bg-blue-900 bg-opacity-20 group-hover:shadow-hover group-hover:bg-white">
                                                    <div class="uppercase text-sm font-bold leading-none xsm:text-sm colors " id="cn4">
                                                        <span class="ar" aria-label="play from €1">Play from $<?=$result_C['Money']?></span></div>
                                                </div>
                                            </a></div>
                                            <?php
                                        }
                                        ?>
                                        <p class="text-white text-x-sm font-bold pr-4 absolute bottom-0 right-0 pb-2.5 w-1/2 md:w-auto text-end pe-2">
                                            *guaranteed</p>
                                        <div class="flex flex-col space-y-1 w-1/2 md:w-1/3 lg:w-auto">
                                            <div class="flex flex-col">
                                                <?php if ($cnt>0 ||  $time > 1){
                                                    ?>
                                                    <h1 class="text-sm md:text-base shadow-text font-bold text-lg"><?=$result_C['cardHeader']?></h1>
                                                <?php
                                                }
                                                ?>
                                                <h2 class="text-base md:text-lg shadow-text leading-5 font-black text-lg" <?php if ($cnt ==0 || $cnt<0){
                                                    ?>
                                                    style="width: 100%;
    font-size: .875rem;
}"
                                                        <?php
                                                }?>
>
                                                    <?php
                                                    if ($result_C['times'] != 0){
                                                        $ssss   = $result_C['times'] - time();
                                                        $wick =7*24*60*60;
                                                        $day = 24*60*60;
                                                        $min = 60*60;
                                                        $sec = 60;
                                                        if ($ssss > $wick){
                                                            echo  date("l--d-M, Ha",$result_C['times']) ;
                                                        }elseif ($ssss>$day){
                                                            echo floor($ssss/(24*60*60)) .' Days To Go';
                                                        }elseif ($ssss>$min){
                                                            echo floor($ssss/(60*60)) .' hours To Go';
                                                        }elseif ($ssss>$sec) {
                                                            echo floor($ssss / (60)) . ' min To Go';
                                                        }
                                                        else{
                                                            echo '<div>Drawing in process</div>';
                                                        }

                                                    }else{
                                                        if ($cnt == 0 || $cnt<0){
                                                            echo '<div>Drawing in process</div>';
                                                        }else{
                                                            echo $cnt .' To go';
                                                        }

                                                    }
                                                    ?></h2></div>
                                            <?php if ($cnt>0 ||  $time >  1){
                                                ?>
                                                <h3 aria-label="1 Million Euro *"
                                                class="shadow-text break-words text-xl sm:text-2xl md:text-3xl font-black text-lg">
                                                <span aria-hidden="true" class="text-lg md:text-3xl pb-2"><span>
                                                        <strong class="text-4xl md:text-4xl-xtra lg:text-4xl">$<?=$result_C['winnermoney']?></strong>
                                                        <span style="font-size: 22px;font-weight: normal">
                                                        <?= $result_C['winnermoney_head']?>

                                                        </span>
                                                                </span>
                                            </h3>

                                            <?php
                                            }
                                            ?>
                                        </div>
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
    </section>
<script src="js/jquery-3.6.0.min.js"></script>
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
<?php
include_once 'inc/footer.php';
?>


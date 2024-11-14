<div class="row justify-content-center align-items-center pt-4">
    <div class="col-lg-6 text-center">
        <img src="../image/status.svg" alt="status Image" width="300" height="300">
    </div>
    <div class="col-lg-6">
        <h5 class="text-center text-uppercase fw-semibold">Your Price Status</h5>
        <div class="bg-white w-100 h-75 d-flex border justify-content-center">
    <?php
    include_once '../clases/readingData.php';
    $red = new readingData();
    $Winners = $red->selWinnerEmail($_SESSION['emailc']);
    $orders = $red->getallorder($_SESSION['emailc']);

    // Debugging: Print structure to verify data
?>
<div class="d-grid w-100">
<?php 
if (empty($orders)) {
        echo "no card.";
    } else if($Winners) {
        foreach($orders as $ord){
            $card = $red->selCarsWithName($ord["CardName"]);
            $cardhead = $red->selCarsWithName1($ord["CardName"]);
            if($card){

                ?>
        <div  class="position-relative">
            <img class="position-absolute top-0 end-0" width="60px" height="60px" src="/image/CardsImage/<?=$card['cardImage']?>">
            <img class="position-absolute top-0 start-0" width="40px" height="40px" src="/image/CardsImage/<?=$card['cardHeader']?>">
        </div>
        <div class="d-flex pt-5 px-2">
                <?php echo $ord["CardName"] ?>
        </div>                                       
         <div class=" d-flex justify-center z-2 pt-1 mx-1 space-x-1">
        <div class="self-auto flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div 
                                                    class="self-auto flex font-bold rounded-full justify-center bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" >
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-1">2</span>
                                                </div>
                                                </div>
                                                <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full  bgs2 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-2">
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs3 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-3">
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs4 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-4">1
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs5 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-5">
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="self-auto d-flex font-bold rounded-full justify-center  bgs1 items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw" style="background-color:<?php echo $card["color"] ?>">
                                                <div style="background-color: unset"
                                                    class="self-auto flex font-bold rounded-full bgs6 justify-center items-center relative  w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white  NumberPicker_picked___UxMw">
                                                    <span class="absolute  w-full h-full text-x-sm "></span><span
                                                        aria-hidden="true" class="sp-6">
                                                    </span>
                                                </div>
                                                </div>
                                        </div>
                <?php
            }else{
                ?>
        <div  class="position-relative">
        <img class="position-absolute top-0 end-0" width="60px" height="60px" src="/image/CardsImage/<?=$cardhead['cardImage']?>">
            <img class="position-absolute top-0 start-0" width="40px" height="40px" src="/image/CardsImage/<?=$cardhead['cardHeadImage']?>">
            </div>
            <div class="d-flex pt-5 px-2">
                <?php echo $ord["CardName"] ?>
        </div>
            <?php
            }
            ?>
<hr>
            <?php
        }
    }
        else{
            echo "wait for wining";
        }
    
    ?>
    </div>
</div>

    </div>
</div>

<div class="row justify-content-center align-items-center">
    <div class="col-lg-6 mt-5">
        <p class="text-success">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium commodi consequuntur dolorem eum exercitationem explicabo facere placeat provident ratione, suscipit? Accusantium aperiam architecto dolore hic minima nulla praesentium sit veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam ea excepturi explicabo mollitia praesentium quasi, reprehenderit voluptatem? A accusamus aliquid deleniti enim ex excepturi ipsam necessitatibus optio placeat quia.</p>
    </div>
    <div class="col-lg-6 mt-5">
        <img src="../image/Success%20factors-rafiki.svg" alt="">
    </div>
</div>
<div class="row justify-content-center align-items-center pt-4">
    <div class="col-lg-6 text-center">
        <img src="../image/status.svg" alt="status Image" width="300" height="300">
    </div>
    <div class="col-lg-6">
        <h5 class="text-center text-uppercase fw-semibold">Your Price Status</h5>
        <div class="bg-white w-100 h-75 d-flex border justify-content-center">
    <?php
    include_once '../clases/readingData.php';
    $shop = new readingData();
    $Winners = $shop->selWinnerEmail($_SESSION['emailc']);
    $orders = $shop->getallorder($_SESSION['emailc']);
    // Debugging: Print structure to verify data


    if (empty($orders)) {
        echo "no card.";
    } else if($Winners) {
        echo "win";
    }
        else{
            echo "wait for wining";
        }
    
    ?>
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
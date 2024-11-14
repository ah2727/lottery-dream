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

    // Debugging: Print structure to verify data


    if (empty($Winners)) {
        echo "no card.";
    } else {
        foreach ($Winners as $res) {
            if (empty($res['CardName']) && empty($res['BALLS1']) && empty($res['BALLS2']) && empty($res['BALLS3']) && empty($res['BALLS4']) && empty($res['BALLS5']) && empty($res['BALLS6']) && empty($res['WIN_STATUS'])) {
                echo "No card";
            } else {
                // Display card name if it exists
                if (!empty($res['CardName'])) {
                    echo "Card Name: " . htmlspecialchars($res['CardName']) . "<br>";
                }

                // Display balls if available
                if (!empty($res['BALLS1']) || !empty($res['BALLS2']) || !empty($res['BALLS3']) || !empty($res['BALLS4']) || !empty($res['BALLS5']) || !empty($res['BALLS6'])) {
                    echo "Balls: " . htmlspecialchars($res['BALLS1']) . '-' . htmlspecialchars($res['BALLS2']) . '-' .
                         htmlspecialchars($res['BALLS3']) . '-' . htmlspecialchars($res['BALLS4']) . '-' .
                         htmlspecialchars($res['BALLS5']) . '-' . htmlspecialchars($res['BALLS6']) . "<br>";
                }

                // Check win status
                if (!empty($res['WIN_STATUS']) && $res['WIN_STATUS'] === "won") {
                    echo "Status: Winner";
                } else {
                    echo "Status: Haven't won yet";
                }
            }
            echo "<hr>"; // Separator for each record
        }
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
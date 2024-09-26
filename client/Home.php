<div class="row justify-content-center align-items-center pt-4">
    <div class="col-lg-6 text-center">
        <img src="../image/status.svg" alt="status Image" width="300" height="300">
    </div>
    <div class="col-lg-6">
        <h5 class="text-center text-uppercase fw-semibold">Your Price Status</h5>
        <table class="table table-bordered mt-4 display" id="myTable">
            <thead>
            <tr>
                <th class="fw-semibold text-uppercase size-13 text-center">id</th>
                <th class="fw-semibold text-uppercase size-13 text-center">Card Name</th>
                <th class="fw-semibold text-uppercase size-13 text-center">Token</th>
                <th class="fw-semibold text-uppercase size-13 text-center">order Id</th>
                <th class="fw-semibold text-uppercase size-13 text-center">Win Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($Winners as $res){

                ?>
                <tr>
                    <td class="text-center"><?=$res['id']?></td>
                    <td class="text-center"><?=$res['CardName']?></td>
                    <td class="text-center"><?=$res['BALLS1'].'-'.$res['BALLS2'].'-'.$res['BALLS3'].'-'.$res['BALLS4'].'-'.$res['BALLS5'].'-'.$res['BALLS6'].'-'.$res['BALLS1']?></td>
                    <td class="text-center"><?=$res['ORDERID']?></td>
                    <td class="text-center text-success">
                        <?php
                        echo "Winnneer"
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table></div>
</div>

<div class="row justify-content-center align-items-center">
    <div class="col-lg-6 mt-5">
        <p class="text-success">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium commodi consequuntur dolorem eum exercitationem explicabo facere placeat provident ratione, suscipit? Accusantium aperiam architecto dolore hic minima nulla praesentium sit veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam ea excepturi explicabo mollitia praesentium quasi, reprehenderit voluptatem? A accusamus aliquid deleniti enim ex excepturi ipsam necessitatibus optio placeat quia.</p>
    </div>
    <div class="col-lg-6 mt-5">
        <img src="../image/Success%20factors-rafiki.svg" alt="">
    </div>
</div>
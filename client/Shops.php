<?php
include_once '../clases/Cheak.php';
$cheak = new Cheak();
$res111 = $shop->SelTrack($_SESSION['emailc']);
$test = $shop->selectTrackk($_SESSION['emailc']);
foreach ($AllShop as $alw) {
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

<table class="table table-bordered mt-4" id="myTable">
    <thead>
    <tr>
        <th class="fw-semibold text-uppercase size-13 text-center">id</th>
        <th class="fw-semibold text-uppercase size-13 text-center">Date</th>
        <th class="fw-semibold text-uppercase size-13 text-center">Token</th>
        <th class="fw-semibold text-uppercase size-13 text-center">Card Name</th>

        <th class="fw-semibold text-uppercase size-13 text-center">order Id</th>
        <th class="fw-semibold text-uppercase size-13 text-center">Price</th>
        <th class="fw-semibold text-uppercase size-13 text-center">Order Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($AllShop1 as $alw){
        ?>
        <tr>
            <td class="fw-semibold text-uppercase size-13 text-center"><?=$alw['id']?></td>
            <td class="fw-semibold text-uppercase size-13 text-center"><?php $sss = date('Y-m-d H:i:s',$alw['Datet']);
            echo $sss?></td>
            <td>
                <?php
                foreach ($AllShop1 as $allll) {
                    if ($allll['orderId'] == $alw['orderId']){
                        ?>

                        <p><?=$allll['balls1'].'-'.$allll['balls2'].'-'.$allll['bals3'].'-'.$allll['balls4'].'-'.$allll['balls5'].'-'.$allll['balls6'].'-'.$allll['randcode']?></p>

                <?php

                    }else{
                        ?>

            <?php
                    }
                }
                ?>

            </td>
            <td class="fw-semibold text-uppercase size-13 text-center"><?=$alw['CardName']?></td>
            <td class="fw-semibold text-uppercase size-13 text-center"><?=$alw['orderId']?></td>
            <td class="fw-semibold text-uppercase size-13 text-center"><?=$alw['price']?></td>
            <td class="fw-semibold text-uppercase size-13 text-center   <?php
            if ($alw['status']==0){
                echo " text-warning ";
            }else{
                echo "text-success";
            }
            ?>"><?php
                if ($alw['status']==0){
                    echo "undefined";
                }else{
                    echo "successful";
                }
                ?></td>
        </tr>
    <?php
    }
    ?>

    </tbody>
</table>
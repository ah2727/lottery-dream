<?php
include_once '../clases/readingData.php';
include_once '../clases/delete_data.php';
$DeleteWinners = new delete_data();
$data = new readingData();
$winners = $data->selWinner();
?>
<div style="overflow-x:auto;">

<table class="table table-bordered mt-5 display" id="myTable">
    <thead>
    <tr>
        <th class="fw-normal text-uppercase text-center">id</th>
        <th class="fw-normal text-uppercase text-center">Email</th>
        <th class="fw-normal text-uppercase text-center">Winner Code</th>
        <th class="fw-normal text-uppercase text-center">Random Code</th>
        <th class="fw-normal text-uppercase text-center">orderId</th>
        <th class="fw-normal text-uppercase text-center">CardName</th>
        <th class="fw-normal text-uppercase text-center">Delete Winner</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($winners as $win){
        ?>
        <tr>
            <td class="text-center"><?=$win['id']?></td>
            <td class="text-center"><?=$win['Email']?></td>
            <td class="text-center"><?=$win['BALLS1'] .'-'. $win['BALLS2'].'-'. $win['BALLS3'].'-'. $win['BALLS4'].'-'. $win['BALLS5'].'-'. $win['BALLS6']?></td>
            <td class="text-center"><?=$win['random']?></td>
            <td class="text-center"><?=$win['ORDERID']?></td>
            <td class="text-center"><?=$win['CardName']?></td>
            <td class="text-center"><a href="?type=WinnerStatus&Delete=<?=$win['id']?>"><i class="bi bi-trash"></i></a></td>
        </tr>
    <?php

    }
    ?>

    </tbody>
</table>
</div>

<?php if (isset($_GET["Delete"])){
    ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for Delete?</h5>
                    <a  href="?type=WinnerStatus" onclick="close1()" type="button" class="close border p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <a href="?type=WinnerStatus" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                    </a>
                    <a  href="?type=WinnerStatus&ConfirmDeleteWin=<?=$_GET["Delete"]?>" type="button" class="btn btn-primary ">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if (isset($_GET)){
    if (isset($_GET['ConfirmDeleteWin'])){
        $DeleteWinners->DeleteWinners($_GET['ConfirmDeleteWin']);
        header("Location:?type=WinnerStatus");
    }
}
?>

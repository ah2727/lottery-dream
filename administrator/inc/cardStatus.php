<?php
include_once '../clases/readingData.php';
include_once '../clases/delete_data.php';
include_once '../clases/Update_Database.php';
$deleteData = new delete_data();
$pdo = new readingData();
$update = new Update_Database();
$result = $pdo->readCardsAll();
$selHead = $pdo->selCard();
?>
<table class="table table-bordered mt-5 display" id="myTable">
    <thead class="bg-danger">
    <tr>
        <th class="text-center size-20">Id</th>
        <th class="text-center size-20">bg Image</th>
        <th class="text-center size-20">cardImage</th>
        <th class="text-center size-20">cardHeader</th>
        <th class="text-center size-20">money</th>
        <th class="text-center size-20">winnermoney</th>
        <th class="text-center size-20">management</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($selHead)){
        ?>

    <tr>
        <td class="text-center" style="vertical-align: middle"><?=$selHead['id']?></td>
        <td class="text-center" style="vertical-align: middle"><img src="../image/CardsImage/<?=$selHead['bg_Image']?>" alt="" width="100"></td>
        <td class="text-center" style="vertical-align: middle; background-color: #0dcaf0"><img src="../image/CardsImage/<?=$selHead['cardImage']?>" alt="" width="100"></td>
        <td class="text-center" style="vertical-align: middle"><?=$selHead['cardHeader']?></td>
        <td class="text-center" style="vertical-align: middle">$<?=$selHead['Money']?></td>
        <td class="text-center" style="vertical-align: middle">$<?=$selHead['winnermoney']?></td>
        <td class="text-center" style="vertical-align: middle"><a href="?type=cardsStatus&UpdateCardHead=<?=$selHead['id']?>" class="size-20 mx-2"><i class="bi bi-pencil-square"></i></a>
            <a href="?type=cardsStatus&deletehead=<?=$selHead['id']?>" id="delete" class="size-20 mx-2 text-danger c-pointer"><i class="bi bi-trash"></i></a></a></td>
    </tr>
        <?php
    }
    ?>
    <?php
    foreach ($result as $res){
    ?>
    <tr>
        <td class="text-center" style="vertical-align: middle"><?=$res['id']?></td>
        <td class="text-center" style="vertical-align: middle"><img src="../image/CardsImage/<?=$res['bg_Image']?>" alt="" width="100"></td>
        <td class="text-center" style="vertical-align: middle; background-color: #0dcaf0"><img src="../image/CardsImage/<?=$res['cardImage']?>" alt="" width="100"></td>
        <td class="text-center" style="vertical-align: middle"><?=$res['cardHeader']?></td>
        <td class="text-center" style="vertical-align: middle">$<?=$res['Money']?></td>
        <td class="text-center" style="vertical-align: middle">$<?=$res['winnermoney']?></td>
        <td class="text-center" style="vertical-align: middle"><a href="?type=cardsStatus&UpdateCard=<?=$res['id']?>" class="size-20 mx-2"><i class="bi bi-pencil-square"></i></a>
            <a href="?type=cardsStatus&delete=<?=$res['id']?>" id="delete" class="size-20 mx-2 text-danger c-pointer"><i class="bi bi-trash"></i></a></a></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<?php if (isset($_GET["delete"])){
    ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for Delete?</h5>
                    <a  href="?type=cardsStatus" onclick="close1()" type="button" class="close border p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <a href="?type=cardsStatus" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                    </a>
                    <a  href="?type=cardsStatus&ConfirmDeleteCard=<?=$_GET["delete"]?>" type="button" class="btn btn-primary">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php if (isset($_GET["deletehead"])){
    ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for Delete?</h5>
                    <a  href="?type=cardsStatus" onclick="close1()" type="button" class="close border p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <a href="?type=cardsStatus" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                    </a>
                    <a  href="?type=cardsStatus&ConfirmDeletehead=<?=$_GET["deletehead"]?>" type="button" class="btn btn-primary">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php
if (isset($_GET['ConfirmDeleteCard'])){
    $deleteData->DaleteCard($_GET['ConfirmDeleteCard']);
    header("Location:?type=cardsStatus");
}

if (isset($_GET['ConfirmDeletehead'])) {
    $deleteData->DeletecardHead($_GET['ConfirmDeletehead']);
    header("Location:?type=cardsStatus");
}
?>
<?php
if (isset($_GET['UpdateCard'])){
    $redCardId = $pdo->redCardById($_GET['UpdateCard']);
    $restime = date('Y-m-d\TH:i',$redCardId['times']);
    ?>
    <div class="row justify-content-center">
        <h5 class="text-center mt-3 text-danger" style="font-size: 30px">Add New Card</h5>
        <form action="" method="post" class="col-lg-6" enctype="multipart/form-data">
            <div class="mt-3">
                <label for="" class="text-primary size-20">Card Name</label>
                <input type="text" class="form-control mt-2" name="CardName" required value="<?=$res['CardName']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20"  >Card Header</label>
                <input type="text" class="form-control mt-2" id="input_header" name="card_Header" required value="<?=$res['cardHeader']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Pick Date To Go</label>
                <input type="datetime-local" class="form-control mt-2" id="time" name="date" value="<?php
                if (!empty($restime)){
                    echo $restime;
                }
                ?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Count Down</label>
                <input type="number" class="form-control mt-2" id="time" name="count" required value="<?=$res['countstamp']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Card Price</label>
                <input type="number" class="form-control mt-2" id="money" name="money" required value="<?=$res['Money']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">winner money For Game</label>
                <input type="text" class="form-control mt-2" id="winner" name="winner_money" required value="<?=$res['winnermoney']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">color</label>
                <input type="text" class="form-control mt-2" id="color" name="color" required value="<?=$res['color']?>">
            </div>
            <div class="d-flex justify-content-center mt-4">
                <input type="submit" class="btn btn-outline-success mx-2" value="confirm" name="confirm_Card">
                <input type="reset" class="btn btn-outline-danger mx-2" value="cancel">
            </div>
    </div>
    <?php
}
?>
<?php
if (isset($_GET['UpdateCardHead'])){
    $redCardHeadId = $pdo->redCardHeadById($_GET['UpdateCardHead']);
    $restime = date('Y-m-d\TH:i',$redCardHeadId['times']);
    ?>
    <div class="row justify-content-center">
        <h5 class="text-center mt-3 text-danger" style="font-size: 30px">edite Card</h5>
        <form action="" method="post" class="col-lg-6" enctype="multipart/form-data">
            <div class="mt-3">
                <label for="" class="text-primary size-20">Card Name</label>
                <input type="text" class="form-control mt-2" onchange="number()" name="CardName" required value="<?=$redCardHeadId['CardName']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20"  >Card Header</label>
                <input type="text" class="form-control mt-2" id="input_header" onkeyup="number()" name="card_HeaderUpdate" required value="<?=$redCardHeadId['cardHeader']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Pick Date To Go</label>
                <input type="datetime-local" class="form-control mt-2" id="time" onchange="number()" name="dateUpdate" value="<?php
                if (!empty($restime)){
                    echo $restime;
                }
                ?>
                ?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Count Down</label>
                <input type="number" class="form-control mt-2" id="time" name="countUpdate" required value="<?=$redCardHeadId['countstamp']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">Money For Game</label>
                <input type="number" class="form-control mt-2" id="money" onkeyup="number()" name="moneyUpdate" required value="<?=$redCardHeadId['Money']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">winner money For Game</label>
                <input type="number" class="form-control mt-2" id="winner" onkeyup="number()" name="winner_moneyUpdate" required value="<?=$redCardHeadId['winnermoney']?>">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary size-20">winnermoney_head</label>
                <input type="text" class="form-control mt-2" id="winner" onkeyup="number()" name="winnermoney_head" required value="<?=$redCardHeadId['winnermoney_head']?>">
            </div>
            <div class="d-flex justify-content-center mt-4">
                <input type="submit" class="btn btn-outline-primary fw-bold mx-2" value="Confirm" name="cardUpdate11">
                <input type="reset" class="btn btn-outline-danger fw-bold mx-2" value="Cancel">
            </div>
        </form>
    </div>
    <?php
}
?>
<?php
if (isset($_POST['confirm_Card'])){
    $CardName = $_POST['CardName'];
    $card_HeaderUpdate =$_POST['card_Header'];
    $color = $_POST['color'];
    if (!empty($_POST['date'])){
        $newTime = new DateTime($_POST['date']);
        $newTimeStamp =  $newTime->getTimestamp();
    }
    $moneyUpdate = $_POST['money'];
    $winner_moneyUpdate = $_POST['winner_money'];
    $count = $_POST['count'];
    if (!empty($newTimeStamp)){
        $update->UpdateCard($_GET['UpdateCard'],$card_HeaderUpdate,$newTimeStamp,$moneyUpdate,$winner_moneyUpdate,$CardName,$color );
        header("Location:?type=cardsStatus");
    }else{
        $update->UpdateCardCount($_GET['UpdateCard'],$card_HeaderUpdate,$count,$moneyUpdate,$winner_moneyUpdate,$CardName);
        header("Location:?type=cardsStatus");
    }
}
?>
<?php
if (isset($_POST['cardUpdate11'])){
    $CardNameHead = $_POST['CardName'];
    $card_HeaderUpdate =$_POST['card_HeaderUpdate'];
    if (!empty($_POST['dateUpdate'])){
        $dateUpdate = $_POST['dateUpdate'];
    }
    $moneyUpdate = $_POST['moneyUpdate'];
    $winner_moneyUpdate = $_POST['winner_moneyUpdate'];
    $winnermoney_head = $_POST['winnermoney_head'];
    $count = $_POST['countUpdate'];
    if (!empty($dateUpdate)){
        $update->UpdateCardHead($_GET['UpdateCardHead'],$card_HeaderUpdate,$dateUpdate,$moneyUpdate,$winner_moneyUpdate,$CardNameHead,$winnermoney_head);
        header("Location:?type=cardsStatus");
    }else{
        $update->UpdateCardCountHead($_GET['UpdateCardHead'],$card_HeaderUpdate,$count,$moneyUpdate,$winner_moneyUpdate,$CardNameHead,$winnermoney_head);
        header("Location:?type=cardsStatus");
    }
}
?>
<?php
include_once "../clases/db_connect.php";
include_once "../clases/register.php";
$pdo1 = new register();
?>
<div class="row justify-content-center">
    <h5 class="text-center mt-3 text-danger" style="font-size: 30px">Add New Card</h5>
    <form action="" method="post" class="col-lg-6" enctype="multipart/form-data">
        <div class="mt-3">
            <label for="" class="text-primary size-20">Card Name</label>
            <input type="text" class="form-control mt-2" name="CardName" required >
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">background Image</label>
            <input type="file" class="form-control mt-2" id="pick" name="Bg_Image" required>
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Result Image</label>
            <input type="file" class="form-control mt-2" id="pick" name="result" required>
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Basket Image</label>
            <input type="file" class="form-control mt-2" id="pick" name="Basket" required>
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Header Card Image</label>
            <input type="file" class="form-control mt-2" name="image" required>
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20"  >Card Header</label>
            <input type="text" class="form-control mt-2" id="input_header" name="card_Header" required>
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Pick Date To Go</label>
            <input type="datetime-local" class="form-control mt-2" id="time" name="date">
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Count Down</label>
            <input type="number" class="form-control mt-2" id="time" name="count" >
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">card color</label>
            <input type="text" class="form-control mt-2" id="time" name="color" >
        </div>
        <div class="mt-3">
            <label for="" class="text-primary size-20">Card Price</label>
            <input type="number" class="form-control mt-2" id="money" name="money" required >
        </div>
        <div class="mt-3">
            <label for=""  class="text-primary size-20">winner money For Game</label>
            <input type="number"  class="mt-2 form-control" id="winner" name="winner_money" required>
        </div>
        <div class="mt-3">
            <label for=""  class="text-primary size-20">winner money Head</label>
            <input type="text"  class="mt-2 form-control" id="winner" name="winnermoney_Head" required>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <input type="submit" class="btn btn-outline-success mx-2" value="confirm" name="confirm">
            <input type="reset" class="btn btn-outline-danger mx-2" value="cancel">
        </div>
</div>
<?php
if (isset($_POST['confirm'])){
    $card_Header = $_POST['card_Header'];
    $money = $_POST['money'];
    $color = $_POST['color'];
    $winner_money = $_POST['winner_money'];
    $bg_image = $_FILES['Bg_Image']['name'];
    $Basket = $_FILES['Basket']['name'];
    $imageName = $_FILES['image']['name'];
    $ResultName = $_FILES['result']['name'];
    $winnermoney_Head = $_POST['winnermoney_Head'];
    if (!empty($_POST['date'])){
        $newTime = new DateTime($_POST['date']);
        $newTimeStamp =  $newTime->getTimestamp();
    }else{
        $newTimeStamp = 0;
    }
    if (!empty($_POST['count'])){
        $count = $_POST['count'];
     }else{
        $count =0;
    }

    $CardName = $_POST['CardName'];
    if ( empty($imageName) || empty($card_Header) || empty($money) || empty($winner_money)||empty($CardName)){
    }else{
        $token = bin2hex(openssl_random_pseudo_bytes(20));
        move_uploaded_file($_FILES['Basket']["tmp_name"],"../image/CardsImage/".$_FILES['Basket']['name']);
        move_uploaded_file($_FILES['result']["tmp_name"],"../image/CardsImage/".$_FILES['result']['name']);
        move_uploaded_file($_FILES['Bg_Image']["tmp_name"],"../image/CardsImage/".$_FILES['Bg_Image']['name']);
        move_uploaded_file($_FILES['image']["tmp_name"],"../image/CardsImage/".$_FILES['image']['name']);
        $pdo1->addnewCard($imageName,$card_Header,$newTimeStamp,$money,$winner_money,$token,$CardName,$bg_image,$ResultName,$count,$Basket,$winnermoney_Head,$color);
        header("Location:".$_SERVER['PHP_SELF'] ."?type=addNewCards");
    }
}

?>
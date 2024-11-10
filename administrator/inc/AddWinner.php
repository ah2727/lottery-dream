
<?php
include_once '../clases/readingData.php';
include_once '../clases/register.php';
$redT = new readingData();
$selcard = $redT->readCardsAll();
$cardHead = $redT->selCard();
$ins = new register();
?>
<?php
if (isset($_POST['random'])){
    $C_Name = $_POST['C_Name'];
    if (empty($C_Name)){

    }else{

        $res = $redT->ReadToken($C_Name,$_POST["count"],$_POST["gems"]);
        print_r($res);
        if (!empty($res)){
            $_SESSION['winner'] = $res;

        }
    }
}
?>
<div class="row justify-content-center">
    <div class="col-lg-3 mt-5">
    <img  class="img-fluid mt-3" src="../image/Add.svg" alt="">
    </div>
</div>
<div class="row justify-content-center mt-3">
    <form action="" class="col-lg-6" method="post" onsubmit="return minToken()">
        <div class="row justify-content-center">
            <select class="form-select" name="C_Name" required>
                <option value="" disabled hidden selected>Please Select Card</option>
                <option class="form-control"  value="<?=$cardHead['CardName']?>"><?=$cardHead['CardName']?></option>
                <?php
                foreach ($selcard as $ssl){
                    ?>
                    <option class="form-control" value="<?=$ssl['CardName']?>"><?=$ssl['CardName']?></option>
                <?php
                }
                ?>

            </select>
            <div class="d-flex justify-content-center pt-2">
                <div>
            <label for="count">count of users?</label>
                <input type="text" class="form-control" name="count" placeholder="enter count of winner" value="1">
                </div>
                <div class="px-4 d-grid justify-center items-center">
                <label for="gems">use gems?</label>
                <input type="checkbox"  name="gmes">
                </div>
            </div>
                <div class="d-flex justify-content-center pt-2">
                <input type="submit" class="btn btn-outline-success mt-3 mx-3" value="Random" name="random" >
                </div>

        </div>
    </form>
</div>
<div style="overflow-x:auto;">


<table class="table table-bordered mt-5 ">
    <thead>
    <tr>
        <th class="fw-normal text-uppercase text-center">id</th>
        <th class="fw-normal text-uppercase text-center">Email</th>
        <th class="fw-normal text-uppercase text-center">Winner Code</th>
        <th class="fw-normal text-uppercase text-center">Random Code</th>
        <th class="fw-normal text-uppercase text-center">orderId</th>
        <th class="fw-normal text-uppercase text-center">CardName</th>
        <th class="fw-normal text-uppercase text-center">gems</th>
        <th class="fw-normal text-uppercase text-center">division</th>
        <th class="fw-normal text-uppercase text-center">Confirm winner</th>
    </tr>
    </thead>
    <thead>
        <?php
    foreach ($res as $re){
    ?>
    <tr>
        <td class="text-center">
            <?php if (isset($re['id'])) {
                echo $re['id'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['Email'])) {
                echo $re['Email'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['balls1'])) {
                echo $re['balls1'] . '-' . $re['balls2'] . '-' . $re['bals3'] . '-' . $re['balls4'] . '-' . $re['balls5'] . '-' . $re['balls6'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['randcode'])) {
                echo $re['randcode'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['orderId'])) {
                echo $re['orderId'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['CardName'])) {
                echo $re['CardName'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['gems'])) {
                echo $re['gems'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['division'])) {
                echo $re['division'];
            } ?>
        </td>
        <td class="text-center">
            <?php if (isset($re['CardName'])) { ?>
                <a href="?type=AddWinner&ConWinner=1"><i class="bi bi-check-circle text-success m-2" style="font-size: 20px"></i></a>
            <?php } ?>
        </td>
    </tr>
    <?php
}
?>

    </thead>
</table>
</div>
<script>
    let minTok = document.getElementById('MinTok');
    let minToken=()=>{
        let password = document.getElementById('token').value;
        if (password.length >= 16){
            minTok.style.color ="#3AA545";
            return true;
        }else {
            minTok.style.color = "red";
            return  false;
        }
    }
</script>
<?php
if (isset($_GET['ConWinner'])){

?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for Delete?</h5>
                <a  href="?type=AddWinner" onclick="close1()" type="button" class="close border p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-footer">
                <a href="?type=AddWinner" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                </a>
                <a  href="?type=AddWinner&confirmWiner=1" type="button" class="btn btn-primary ">Add New Winner</a>
            </div>
        </div>
    </div>
</div>
<?php
}

?>
<?php
if (isset($_GET['confirmWiner'])){
    if (!empty($res)){
        $ins->addnewWinner($_SESSION['EmailWinner'],$_SESSION['CardName'],$_SESSION['balls1'],$_SESSION['balls2'],$_SESSION['bals3'],$_SESSION['balls4'],$_SESSION['balls5'],$_SESSION['balls6'],$_SESSION['randcode'],$_SESSION['orderId']);
        unset($_SESSION['EmailWinner']);
        unset($_SESSION['CardName']);
        unset($_SESSION['balls1']);
        unset($_SESSION['balls2']);
        unset($_SESSION['bals3']);
        unset($_SESSION['balls4']);
        unset($_SESSION['balls5']);
        unset($_SESSION['balls6']);
        unset($_SESSION['randcode']);
        unset($_SESSION['orderId']);
;        header("Location:index.php");
    }else{
        $eror= "Pleses enter data";
    }
}
?>
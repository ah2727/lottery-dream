<?php
include_once "../clases/eariningandreferral.php";
$earnref = new Eariningandreferral();
$data = $earnref->getreearningandreferral()

?>


<div class="d-flex justify-content-center pt-5">
    <form method="POST">
        <div class=" d-grid">
            <div class="form-control  mb-3">
                <label>earning</label>
                <input name="earning" type="number" class="form-control" placeholder="earning" aria-label="Username" value="<?php echo $data['earning'] ?>">
            </div>
            <div class="form-control  mb-3">
                <label>referral</label>
                <input name="referral" type="number" class="form-control" placeholder="referral" aria-label="Username" value="<?php echo $data['referral'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </form>
</div>

<?php 
if($_POST){
    $earning = $_POST["earning"];
    $referal = $_POST["referral"];
    $response= $earnref->updatereearningandreferral($referal,$earning);
    header('Location:' . "/administrator?type=earning");
}

?>
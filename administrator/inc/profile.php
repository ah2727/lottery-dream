<?php
include_once "../clases/readingData.php";
$sel = new readingData();
$res = $sel->LoginAdministrator($_SESSION['email']);
?>
    <div class="row justify-content-center mt-5">
        <form action="" method="post" class="col-lg-6">
            <div class="mt-2">
                <label for="" class="text-primary">Full Name</label>
                <input type="text" class="form-control mt-2" value="<?= $res['FullName'] ?>" required name="FullName">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary">Email</label>
                <input type="email" class="form-control mt-2" value="<?= $res['Email'] ?>" required name="Email">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary">Password</label>
                <input type="text" class="form-control mt-2" name="password">
            </div>
            <div class="mt-3">
                <label for="" class="text-primary">ConfirmPassword</label>
                <input type="text" class="form-control mt-2" name="confirmPassword">
            </div>
            <div class="mt-3">
                <h5 class="size-20">two steps status: <span class="text-danger">Disable</span></h5>
                <a href="?menu=SiteSetting&type=Profile&TwoSteps=on" class="btn btn-outline-warning mt-3">Active</a>
            </div>
            <select name="select" id="" class="form-select mt-3" disabled>
                <option><?php if ($res['Role'] == "FullAdmin") {
                        echo "Full Admin";
                    } else {
                        echo "New Admin";
                    } ?></option>
            </select>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-outline-success mt-3 mx-2" value="change" id="ProfileSubmit">
                <input type="reset" class="btn btn-outline-danger mt-3 mx-2" value="cancel">
            </div>
        </form>
    </div>
<?php
if (isset($_POST["ProfileSubmit"])) {
    if (empty($_POST['FullName']) || empty($_POST['Email']) || empty($_POST['select'])) {
        $errorMsg = "pls enter all filed";
    } else {
        if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
            if ($_POST['password'] != $_POST['confirmPassword']) {
                $errorMsg = "password not match";
            } else{
                //Password And profile Update
            }
        }else{
        }
    }
}
if (isset($_GET['TwoSteps'])){
    //sendConfirmCode
    header("Location:tw");
}
?>
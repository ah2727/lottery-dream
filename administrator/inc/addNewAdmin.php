<?php
include_once '../clases/register.php';
$pdo = new register();
$errorMsg = '';
$msg = '';
if (isset($_SESSION['email'])){

}else{
    header("Location:../login.php");
}
if (isset($_POST['submit'])){
    if (empty($_POST['Email']) || empty($_POST['FullName']) || empty($_POST['Password']) || empty($_POST['ConfirmPassword']) || empty($_POST['role'])){
        $errorMsg = "please Enter All field";
    }elseif ($_POST['Password'] !== $_POST['ConfirmPassword']){
        $errorMsg = "passwords Not match";
        echo "1";
    }elseif (strlen($_POST['Password']) < 8){
        $errorMsg = 'min password len 8 number';
    }
    else{
        try {
            $phash = password_hash($_POST['Password'],PASSWORD_ARGON2I);
            $res = $pdo->AddNewAdmin($_POST['FullName'],$_POST['Email'],$phash,$_POST['role']);
            $msg = "add new admin success Full";
        }catch (Exception $e){
            $errorMsg = "can not add  but      :" . $e->getMessage();
        }
    }
}
?>
    <div class="registration-form">
        <form method="post" action="">
            <div class="row justify-content-center">
                <div class="col-lg-6">
            <div class="form-group">
                <input type="email" class="form-control mt-4" id="username" placeholder="Email" name="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control mt-4" id="password" placeholder="FullName" name="FullName">
            </div>
            <div class="form-group">
                <input type="password" class="form-control mt-4" id="password" placeholder="Password" name="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control mt-4" id="password" placeholder="ConfirmPassword" name="ConfirmPassword">
            </div>
            <select name="role" id="" class="form-control mt-3" required>
                <option selected hidden disabled>please enter Admin Role</option>
                <option value="FullAdmin">Full Admin</option>
                <option value="newAdmin">New Admin</option>
            </select>
                <input type="submit" name="submit" class="btn bnt btn-outline-primary mt-3" value="Create Account">
            <div class="alert alert-danger mt-3 <?php if (!empty($errorMsg)){
                echo "d-block";
            }else{
                echo "d-none";
            }?>">
                <p><?=$errorMsg?></p>
            </div>
            <div class="alert alert-success mt-3 <?php if (!empty($msg)){
                echo "d-block";
            }else{
                echo "d-none";
            }?>">
                <p><?=$msg?></p>
            </div>
                </div>

        </form>
    </div>
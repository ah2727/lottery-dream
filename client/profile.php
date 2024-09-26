<?php
include_once '../clases/readingData.php';
include_once '../clases/Update_Database.php';
$pdo = new readingData();
$res1 = $pdo->selProfile($_SESSION['emailc']);
$Update = new Update_Database();
$msg='';
if (isset($_POST['submitUpdate'])) {
    if (empty($_POST['FirstName']) || empty($_POST['LastName']) || empty($_POST['address']) || empty($_POST['postal_code'])) {
        echo "Not empty";
    } else {
        if (!empty($_POST["Password1"]) && !empty($_POST["confirmPassword1"])) {
            if ($_POST['Password1'] == $_POST["confirmPassword1"]){
                if (strlen($_POST['Password1']) >= 8){
                    try {
                        $pw = password_hash($_POST['Password1'],PASSWORD_ARGON2I);
                        $Update->UpdateProfilePassword($res1['email'],$_POST['FirstName'],$_POST['LastName'],$_POST['address'],$_POST['mother'],$_POST['mother'],$_POST['birthDay'],$pw);
                        session_destroy();
                        header("Location:../login.php");
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }else{
                    $msg = "MINIMUM PASSWORD LENGTH 8 CHARACTERS";
                }

            }else{
                $msg = "Both passwords must be the same";
            }

        } else {
            try {
                $Update->UpdateProfile($_POST['FirstName'], $_POST['LastName'], $_POST['address'],$_POST['mother'],$_POST['place'],$_POST['birthDay'],$res1['email']);
                header("Location:index.php");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}

?>
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-lg-6 mt-5">
        <form class="" action="" method="post" onsubmit="return passwordSame()">
            <div class="input-group pt-4">
                <input type="text" class="form-control mx-4 rounded-0" placeholder="First Name" name="FirstName" required value="<?=$res1['fristName']?>">
                <input type="text" class="form-control mx-4 rounded-0" placeholder="Last Name" name="LastName" required value="<?=$res1['latName']?>">
            </div>
            <div class="mt-3 mx-4">
                <input type="email" class="form-control rounded-0" placeholder="Email" required value="<?=$res1['email']?>" readonly disabled>
            </div>
            <div class="mt-3 mx-4">
                <input type="text" class="form-control rounded-0" placeholder="Address" name="address" required value="<?=$res1['Address']?>">
            </div>
            <div class="mt-3 mx-4">
                <input type="text" class="form-control rounded-0" placeholder="Your mother's maiden name" name="mother" required value="<?=$res1['mother']?>">
            </div>
            <div class="mt-3 mx-4">
                <input type="text" class="form-control rounded-0" placeholder="Your place of birth" name="place" required value="<?=$res1['place']?>">
            </div>
            <div class="mt-3 mx-4">
                <input type="date" class="form-control rounded-0" placeholder="birthDay" name="birthDay" required value="<?=$res1['birthDay']?>">
            </div>
            <div class="mt-3 mx-4">
                <input type="text" class="form-control rounded-0" placeholder="Postal Code" name="postal_code" required value="<?=$res1['phone']?>">
            </div>
            <div class="mt-5 mx-4">
                <input type="password" class="form-control rounded-0" placeholder="Password" onkeyup="minPassword()" id="password" name="Password1">
            </div>
            <div class="mt-3 mx-4">
                <input type="password" class="form-control rounded-0" placeholder="Confirm Password" id="confirmPassword" onkeyup="passwordSame()"  name="confirmPassword1">
                <span class="d-block text-start mt-4 mx-2 size-12 fw-semibold text-uppercase " id="minPw">Minimum password length 8 characters</span>
                <span class="d-block text-start mt-2 mx-2 size-12 fw-semibold text-uppercase " id="pwSame">Both passwords must be the same</span>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <input type="button" class="btn btn-outline-primary fw-bold mx-2" value="Confirm"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                <input type="reset" class="btn btn-outline-danger fw-bold mx-2" value="Cancel">
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are sure for Save Change??
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-primary fw-bold mx-2" value="Confirm" name="submitUpdate" ">
                            <input type="reset" class="btn btn-outline-danger fw-bold mx-2" value="Cancel">
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger p-2 mt-3 <?php if (empty($msg)){
                echo "d-none";
            }else{
                echo "d-block";
            }?>">
                <p><?=$msg?></p>
            </div>
        </form>
    </div>
    <div class="col-lg-6 mt-5 text-center">
        <img src="../image/profile.svg" alt="" width="300">
        <p class="mt-4 text-success">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus deleniti dolore facilis, id inventore neque odit optio quaerat quos repellat voluptatem. Ad cumque distinctio doloribus esse incidunt rem tempora.</p>
    </div>
</div>
<script>
    let minPw = document.getElementById("minPw");
    let pwSame = document.getElementById("pwSame");
    let minPassword =()=>{
        let password = document.getElementById('password').value;
        if (password.length >= 8){
            minPw.style.color ="#3AA545"
        }else {
            minPw.style.color = "red";
        }
    }
    let passwordSame=()=>{
        let password = document.getElementById('password').value;
        let  confirmPassword = document.getElementById('confirmPassword').value;
        if (password === confirmPassword && password.length >= 8){
            pwSame.style.color = "#3AA545";
        }else {
            pwSame.style.color = "red";
        }
    }
</script>

<script>
    let id = document.getElementById('exampleModal');
    function show_confirm(){
        if ()
    }
</script>


<?php
include_once '../clases/readingData.php';
include_once '../clases/delete_data.php';
include_once "../clases/Update_Database.php";
$errorMsg = '';
$pdo = new readingData();
$pdo1 = new Update_Database();
$allAdmin = $pdo->readAllAdmin();
$deleteData = new delete_data();
?>
<?php
if (isset($_GET['ConfirmDelete'])){
    $deleteData->DeleteAdmin($_GET['ConfirmDelete']);
    header("Location:?type=adminSetting");
}
if (isset($_POST['updateConfirm'])){
    if (empty($_POST['fullName']) || empty($_POST['email']) ||empty($_POST['select'])){
        $errorMsg = "pls enter All filed";
    }else{
        if (!empty($_POST['password'])&& !empty($_POST['ConfirmPassword'])){
            if ($_POST['password'] == $_POST['ConfirmPassword']){

                $Ph = password_hash($_POST['password'],PASSWORD_ARGON2I);
                $pdo1->UpdateAdminSettingFull($_POST['fullName'],$_POST['email'],$Ph,$_POST['select'],$_GET['id']);
                header("Location:?type=adminSetting");

            }else{
                $errorMsg = "password not match";
            }
        }else{
            $pdo1 = new Update_Database();
            $pdo1->UpdateAdminSetting($_POST['fullName'],$_POST['email'],$_POST['select'],$_GET['id']);
            header("Location:?type=adminSetting");
        }
    }
}
?>
<div class="mt-5">
<table class="table table-bordered mt-5 display" id="myTable">
    <thead class="bg-primary">
    <tr>
        <th class="text-center size-15">id</th>
        <th class="text-center size-15">Email</th>
        <th class="text-center size-15">FullName</th>
        <th class="text-center size-15">Role</th>
        <th class="text-center size-15">Two steps</th>
        <th class="text-center size-15">online Status</th>
        <th class="text-center size-15">ManageAdmin</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($allAdmin as $res){
        ?>
    <tr style="font-family: sans-serif">
        <td class="fw-bold text-center"><?=$res['id']?></td>
        <td class="fw-bold text-center"><?=$res['Email']?></td>
        <td class="fw-bold text-center"><?=$res['FullName']?></td>
        <td class="fw-bold text-center"><?=$res['Role']?></td>
        <td class="fw-bold text-center"><a href="">
                <?php if($res['TwoSteps'] == 0){
                    echo "off";
                }else{
                    echo "on";
                }?>
            </a>

        </td>
        <td class="fw-bold text-center "><?php if ($res['onlineStatus'] == 0){
                echo "<i class='bi bi-circle-fill text-danger'></i>";
            }else{
                echo "<i class='bi bi-circle-fill text-success'></i>";
            }?></td>
        <td class="text-center"><a href="?type=adminSetting&id=<?=$res['id']?>&Update=1" class="size-20 mx-2"><i class="bi bi-pencil-square"></i></a>
            <a href="?type=adminSetting&delete=<?=$res['Email']?>" id="delete" class="size-20 mx-2 text-danger c-pointer"><i class="bi bi-trash"></i></a></a></td>
    </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<div>
</div>

</div>
<?php
if (isset($_GET['Update']) && isset($_GET['id'])){
    $selById = $pdo->selectbyId($_GET['id']);
    if (!empty($selById)){
        ?>
        <form action="" method="post">
            <div class="row justify-content-center">
                <div class="col-lg-6 mt-5 col-md-9 col-sm-12">
                    <h5 class="text-center" style="font-size: 30px">Update Admin</h5>
                        <div class=" mt-4">
                            <label for="" class="size-20">FullName</label>
                            <input type="text" class="form-control rounded-0 mt-2" required  value="<?=$selById['FullName']?>"  name="fullName">
                        </div>
                        <div class="input-data mt-4">
                            <label for="" class="size-20">Email</label>
                            <input type="text" class="form-control rounded-0 mt-2" required value="<?=$selById['Email']?>" name="email">
                        </div>
                        <div class="input-data mt-4">
                            <label for="" class="size-20">password</label>
                            <input type="password"  class="form-control rounded-0 mt-2"  name="password">
                        </div>
                        <div class="input-data mt-4">
                            <label for="" class="size-20" >ConfirmPassword</label>
                            <input type="password"  name="ConfirmPassword"  class="form-control rounded-0 mt-2">
                        </div>
                        <div class="mt-3 mx-3">
                            <h5 class="size-20">Two steps status:<?php
                                if ($selById['TwoSteps'] == 0){
                                    ?>
                                    <span class="text-danger">Disable</span>
                                        <?php
                                }else{
                                    ?>
                                    <span class="text-success">Enabled</span>
                                        <?php
                                }
                                ?>

                            </h5>
                                <?php
                                if ($selById['TwoSteps'] == 0){

                                    ?>
                            <a href="?type=adminSetting&id=14&Update=1&TwoSteps=1" class="btn btn-outline-success mt-3 ">
                                Enabled
                            </a>
                                    <?php
                                }else{
                                    ?>
                                <a href="?type=adminSetting&id=14&Update=1&TwoSteps=1" class="btn  btn-outline-danger mt-3 ">
                                    Disable
                                </a>
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                        <div class="input-data mt-4">
                            <select name="select" id="" class="item form-select">
                                <option value="FullAdmin">FullAdmin</option>
                                <option value="newAdmin">new Admin</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <input type="submit" value="confirm" class="btn btn-primary mx-3" name="updateConfirm">
                            <input type="reset" value="cancel" class="btn btn-danger mx-3">
                        </div>
                    <div>
                        <p class="mt-5 alert alert-info <?php if (!empty($errorMsg)){
                            echo "d-block";
                        }else{
                            echo "d-none";
                        }
                        ?>"><?php
                                echo $errorMsg;
                            ?></p>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}
    ?>
<?php
if (isset($_GET['TwoSteps'])){
    $pdo1->TwoSteps($_SESSION['email']);
    header("location:?type=adminSetting");
}
?>
<?php if (isset($_GET["delete"])){
    ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block; opacity: 1; background-color: rgba(0,0,0,0.2)">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">are you sure for Delete?</h5>
                    <a  href="?type=adminSetting" onclick="close1()" type="button" class="close border p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <a href="?type=adminSetting" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close1()">Close
                    </a>
                    <a  href="?type=adminSetting&ConfirmDelete=<?=$_GET["delete"]?>" type="button" class="btn btn-primary ">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
    ?>


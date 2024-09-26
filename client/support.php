<?php
include_once '../clases/register.php';
$pdo = new register();
$msg = '';
?>


<div class="row justify-content-center">
    <div class="col-lg-6 text-center mt-5 mb-5">
        <h5 class="fw-bold ">contact to admin</h5>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control rounded-0 mt-3" placeholder="Email" value="<?=$_SESSION['emailc']?>" readonly disabled>
            <input type="text" class="form-control rounded-0 mt-3" placeholder="subject" name="subject" required>
            <input type="text" class="form-control rounded-0 mt-3" placeholder="Card Token" name="CardToken" required>
            <input type="file" class="form-control mt-3 rounded-0" name="file">
            <textarea class="form-control mt-3" style="resize: none;" rows="10" cols="50" name="text" required>
            </textarea>
            <input type="submit" class="btn btn-outline-primary mt-3" value="confirm" name="sub">
            <input type="reset" class="btn btn-outline-danger mt-3" value="cancel">
        </form>
        <div class="alert alert-success mt-3 <?php  if (empty($_SESSION['msgs'])){
            echo "d-none";
        }else{
            echo "d-block";
        } ?>">
            <p class="text-start"><?php echo $_SESSION['msgs']; unset($_SESSION['msgs'])?></p>
        </div>
    </div>
    <div class="col-lg-6 text-center mt-5">
        <img src="../image/message.svg" alt="" width="500">
    </div>
</div>

<?php
if (isset($_POST['sub'])){
    if (empty($_POST['subject']) || empty($_POST['CardToken']) || empty($_POST['text'])){
        $msg = "input can not empty";
    }else{
        if (!empty($_FILES['file']['name'])){
            try {
                move_uploaded_file($_FILES['file']["tmp_name"],"../TcketFile/".$_FILES['file']['name']);
                $pdo->addnewTcket($_SESSION['emailc'],$_POST['subject'],$_POST['CardToken'],$_FILES['file']['name'],$_POST['text']);
                $msgs = "Ticket sent. Your answer will be sent to your email shortly";
            }catch (Exception $e){
                echo  $e->getMessage();
            }

        }else{
            $pdo->addnewTcketP($_SESSION['emailc'],$_POST['subject'],$_POST['CardToken'],$_POST['text']);
            $_SESSION['msgs'] = "Ticket sent. Your answer will be sent to your email shortly";
            header("Location:index.php?menu=support");
        }
    }
}
?>
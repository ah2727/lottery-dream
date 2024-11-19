<?php
include_once '../clases/readingData.php';
include_once '../clases/register.php';

$redT = new readingData();
$selcard = $redT->readCardsAll();
$cardHead = $redT->selCard();
$ins = new register();
$avfwinner = $redT->getAverageDivision();
$res = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['random'])) {
        $C_Name = $_POST['C_Name'];
        if (!empty($C_Name)) {
            $res = $redT->ReadToken($C_Name, $_POST["count"], $_POST["gems"]);
        }
    }

    if (isset($_POST['confirmWinner'])) {
        $ins->addnewWinner(
            $_POST['EmailWinner'],
            $_POST['CardName'],
            $_POST['balls1'],
            $_POST['balls2'],
            $_POST['balls3'],
            $_POST['balls4'],
            $_POST['balls5'],
            $_POST['balls6'],
            $_POST['randcode'],
            $_POST['orderId']
        );
        header("Location:index.php");
        exit;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-lg-3 mt-5">
        <img class="img-fluid mt-3" src="../image/Add.svg" alt="">
    </div>
</div>

<div class="row justify-content-center mt-3">
    <form action="" class="col-lg-6" method="post" onsubmit="return minToken()">
        <div class="row justify-content-center">
            <select class="form-select" name="C_Name" required>
                <option value="" disabled hidden selected>Please Select Card</option>
                <option class="form-control" value="<?= $cardHead['CardName'] ?>"><?= $cardHead['CardName'] ?></option>
                <?php foreach ($selcard as $ssl): ?>
                    <option class="form-control" value="<?= $ssl['CardName'] ?>"><?= $ssl['CardName'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="d-flex justify-content-center pt-2">
                <div>
                    <label for="count">Count of users?</label>
                    <input type="text" class="form-control" name="count" placeholder="Enter count of winner" value="1">
                </div>
                <div class="px-4 d-grid justify-center items-center">
                    <label for="gems">Use gems?</label>
                    <input type="checkbox" name="gems">
                </div>
                <div class="px-4 d-grid justify-center items-center">
                    <label for="avg">Division avg?</label>
                    <span name="avg"><?= $avfwinner ?></span>
                </div>
                <div class="px-4 d-grid justify-center items-center">
                    <label for="avg">Division</label>
                    <input type="text" class="form-control" name="count" placeholder="Enter count of winner" value="1">
                </div>
            </div>
            <div class="d-flex justify-content-center pt-2">
                <input type="submit" class="btn btn-outline-success mt-3 mx-3" value="Random" name="random">
            </div>
        </div>
    </form>
</div>

<div style="overflow-x:auto;">
    <table class="table table-bordered mt-5 ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Winner Code</th>
                <th>Random Code</th>
                <th>Order ID</th>
                <th>Card Name</th>
                <th>Gems</th>
                <th>Division</th>
                <th>Confirm Winner</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($res as $re): ?>
                <tr>
                    <td><?= $re['id'] ?? '' ?></td>
                    <td><?= $re['Email'] ?? '' ?></td>
                    <td><?= $re['balls1'] . '-' . $re['balls2'] . '-' . $re['bals3'] . '-' . $re['balls4'] . '-' . $re['balls5'] . '-' . $re['balls6'] ?></td>
                    <td><?= $re['randcode'] ?? '' ?></td>
                    <td><?= $re['orderId'] ?? '' ?></td>
                    <td><?= $re['CardName'] ?? '' ?></td>
                    <td><?= $re['gems'] ?? '' ?></td>
                    <td><?= $re['division'] ?? '' ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="EmailWinner" value="<?= $re['Email'] ?>">
                            <input type="hidden" name="CardName" value="<?= $re['CardName'] ?>">
                            <input type="hidden" name="balls1" value="<?= $re['balls1'] ?>">
                            <input type="hidden" name="balls2" value="<?= $re['balls2'] ?>">
                            <input type="hidden" name="balls3" value="<?= $re['bals3'] ?>">
                            <input type="hidden" name="balls4" value="<?= $re['balls4'] ?>">
                            <input type="hidden" name="balls5" value="<?= $re['balls5'] ?>">
                            <input type="hidden" name="balls6" value="<?= $re['balls6'] ?>">
                            <input type="hidden" name="randcode" value="<?= $re['randcode'] ?>">
                            <input type="hidden" name="orderId" value="<?= $re['orderId'] ?>">
                            <button type="submit" name="confirmWinner" class="btn btn-link">
                                <i class="bi bi-check-circle text-success" style="font-size: 20px"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function minToken() {
        const password = document.getElementById('token').value;
        const minTok = document.getElementById('MinTok');
        if (password.length >= 16) {
            minTok.style.color = "#3AA545";
            return true;
        } else {
            minTok.style.color = "red";
            return false;
        }
    }
</script>

<?php
include_once '../clases/readingData.php';
$pdo = new readingData();
$result = $pdo->ReadMessage();
?>
<div style="overflow-x:auto;">

<table class="table table-striped mt-5 display" id="myTable">
    <thead>
    <tr>
        <th scope="col" class="text-uppercase size-12 text-center">#</th>
        <th scope="col" class="text-uppercase size-12 text-center">email</th>
        <th scope="col" class="text-uppercase size-12 text-center">subject</th>
        <th scope="col" class="text-uppercase size-12 text-center">card Token</th>
        <th scope="col" class="text-uppercase size-12 text-center">File</th>
        <th scope="col" class="text-uppercase size-12 text-center">show Text</th>
        <th scope="col" class="text-uppercase size-12 text-center">delete</th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result as $res){
        ?>
        <tr>
            <td class="text-center"><?=$res['id']?></td>
            <td class="text-center"><?=$res['email']?></td>
            <td class="text-center"><?=$res['subject']?></td>
            <td class="text-center"><?=$res['cardToken']?></td>
            <td class="text-center"><?=$res['email']?></td>
            <td class="text-center"><a href="?type=messages&showText=<?=$res['id']?>"><i class="bi bi-layout-text-window"></i></a></td>
            <td class="text-center"><a href="?type=messages&deleteMessage=<?=$res['id']?>""><i class="bi bi-trash text-danger"></i></a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
<?php
if (isset($_GET['showText'])){
    if (!empty($_GET['showText'])){
        try {
            $resId = $pdo->ReadMessageByid($_GET['showText']);
        ?>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-6 mt-4">
                    <h5 class="text-center text-uppercase text-success">Text messages</h5>
                    <p class="text-center mt-4"><?=$resId['text']?></p>
                </div>
            </div>
<?php
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }
}
if (isset($_GET['deleteMessage'])){
    if (!empty($_GET['deleteMessage'])){
        try {
            include_once "../clases/delete_data.php";
            $del = new delete_data();
            $del->deleteMessage($_GET['deleteMessage']);
            header("Location:?type=messages");
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
?>

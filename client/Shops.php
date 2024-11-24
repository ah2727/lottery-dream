<?php
include_once '../clases/Cheak.php';

$shop = new readingData();
$cheak = new Cheak();
$res111 = $shop->SelTrack($_SESSION['emailc']);
$test = $shop->selectTrackk($_SESSION['emailc']);
$orders = $shop->getallorder($_SESSION['emailc']);
$allShop1 = $shop->ReadShop($_SESSION['emailc']);

// Update order statuses
foreach ($res111 as $alw) {
    foreach ($test as $test2) {
        if ($test2['orderId'] === $alw['orderId'] && $test2['Status'] === 1) {
            $update->UpdateOrder($test2['orderId']);
        }
    }
}

// Group orders by orderId
$groupedOrders = [];

// Step 1: Group the orders by `orderId`
foreach ($orders as $order) {
    $groupedOrders[$order['orderId']][] = $order;
}

// Step 2: Sort the grouped orders by date
foreach ($groupedOrders as &$group) {
    usort($group, function ($a, $b) {
        return strtotime($a['Datet']) <=> strtotime($b['Datet']);
    });
}
unset($group); // Unset reference to avoid unintended modifications

// Optional: Sort the whole `$groupedOrders` by keys (orderId), if needed
ksort($groupedOrders); 
// Render grouped orders
foreach ($groupedOrders as $orderId => $groupedItems) {
    $firstOrder = $groupedItems[0]; // Use the first item for shared details
    $card = $shop->selCarsWithName($firstOrder['CardName']);
    $cardHead = $shop->selCarsWithName1($firstOrder['CardName']);
    $isCardAvailable = $card !== null;

?>
    <div>
        <!-- Card Header Image -->
        <div class="position-relative">
            <img class="position-absolute top-0 start-0" width="40px" height="40px"
                src="/image/CardsImage/<?= $isCardAvailable ? $card['cardHeader'] : $cardHead['cardHeadImage'] ?>">
        </div>

        <!-- Card Name -->
        <div class="d-flex pt-5 px-2">
            <?= htmlspecialchars($firstOrder['CardName']) ?>
        </div>

        <!-- Balls Section -->
        <div class="d-flex justify-center z-2 pt-1 mx-1 space-x-1">
            <div class="d-grid">
                <?php foreach ($groupedItems as $order) { ?>

                    <div class="d-flex">
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['balls1']) ?></span>
                            </div>
                        </div>
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['balls2']) ?></span>
                            </div>
                        </div>
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['bals3']) ?></span>
                            </div>
                        </div>
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['balls4']) ?></span>
                            </div>
                        </div>
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['balls5']) ?></span>
                            </div>
                        </div>
                        <div class="self-auto d-flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw"
                            style="background-color:<?= $isCardAvailable ? $card['color'] : $cardHead['color'] ?>">
                            <div class="self-auto flex font-bold rounded-full justify-center items-center relative w-7 md:w-10 h-7 md:h-10 text-base md:text-2xl text-white NumberPicker_picked___UxMw">
                                <span class="absolute w-full h-full text-x-sm"></span>
                                <span aria-hidden="true"><?= htmlspecialchars($order['balls6']) ?></span>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                </div>
            </div>

            <!-- Order Details -->
            <div class="d-flex justify-content-center gap-5 pt-4 pb-4">
                <div class="d-grid">
                    <label>Date:</label>
                    <span><?= htmlspecialchars(date("Y-m-d H:i:s", $firstOrder['Datet'])) ?></span>
                    </div>
                <div class="d-grid">
                    <label>Trace ID:</label>
                    <span><?= htmlspecialchars($orderId) ?></span>
                </div>
                <div class="d-grid">
                    <label>Price:</label>
                    <span><?= htmlspecialchars($firstOrder['price']) ?></span>
                </div>
                <div class="d-grid">
                    <label>Gems:</label>
                    <span><?= htmlspecialchars($firstOrder['gems']) ?></span>
                </div>
                <div class="d-grid">
                    <label>Division:</label>
                    <span><?= htmlspecialchars($firstOrder['division']) ?></span>
                </div>
            </div>
        </div>
        <hr>
    <?php
}
    ?>
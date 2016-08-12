<h1>History for <b><?= $_SESSION["username"] ?></b></h1>

<div class="row">
    <div class="col-xs-12">
        <?php 
            foreach ($_SESSION["history"] as $item) {
                print("<p><i>" . date("D, M dS g:ia", strtotime($item["timestamp"] . " - 14400 seconds")) . "</i> " . $item["type"] . " " . floor($item["shares"]) . " share(s) of <b>" . htmlspecialchars($item["symbol"]) . "</b> for $"  . number_format($item["amount"], $decimals = 2, $dec_point = ".", $thousands_sep = ","));
            }
        ?>
    </div>
</div>

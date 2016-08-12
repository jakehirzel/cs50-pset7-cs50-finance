<h1>Sell</h1>

<div class="row">
    <div class="col-xs-12">
        <?php 
            foreach ($_SESSION["portfolio"] as $i => $stock) {
                
                print("<form action='sell.php' method='post'><p><b>" . htmlspecialchars($stock["symbol"]) . "</b> " . $stock["shares"] . " @ $" . number_format($stock["current_price"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") . " = $" . number_format($stock["shares"] * $stock["current_price"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") . " <input type='hidden' name='index' value='" . $i . "'><input type='hidden' name='id' value='" . $stock["id"] . "'><button class='btn btn-default' type='submit'>Sell " . $stock["symbol"] . "</button></p></form>");
                
            }
        ?>
    </div>
    <div class="col-xs-12">
        <p><b>Cash Available for Investing: $<?= number_format($_SESSION["cash_available"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") ?></b></p>
    </div>
</div>
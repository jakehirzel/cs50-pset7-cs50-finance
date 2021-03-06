<h1>Portfolio for <b><?= $_SESSION["username"] ?></b></h1>

<div class="row">
    <div class="col-xs-12">
        <?php 
            foreach ($_SESSION["portfolio"] as $stock) {
                print("<p class = 'list_name'>" . $stock["name"] . "</p><p><b>" . htmlspecialchars($stock["symbol"]) . "</b> " . $stock["shares"] . " @ $" . number_format($stock["current_price"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") . " = $" . number_format($stock["shares"] * $stock["current_price"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") . "</p>");
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <p><b>Cash Available for Investing: $<?= number_format($_SESSION["cash_available"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") ?></b></p>
    </div>
</div>
    
<?php
    if (isset($_SESSION["confirmation"])) {
        print ("
            <div class='row'>
                <div class='col-xs-12'>
                    <p class='bg-info'><b>" . $_SESSION["confirmation"] . "</b></p>
                </div>
            </div>"
        );
        unset($_SESSION["confirmation"]);
    }
?>

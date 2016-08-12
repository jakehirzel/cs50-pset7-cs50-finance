<h1>History for <b><?= $_SESSION["username"] ?></b></h1>

<div class="row">
    <div class="col-xs-12">
        <?php 
            foreach ($_SESSION["history"] as $item) {
                
                // Format deposit items
                if ($item["type"] == "DEP") {
                    print("<p><span class='timestamp'>" . $item["timestamp"] . " </span> DEPOSIT of " . number_format($item["amount"], $decimals = 2, $dec_point = ".", $thousands_sep = ","));
                }
                
                // Format buy and sell items
                else {
                    print("<p class = 'list_name'>" . $item["name"] . "</p><p><span class='timestamp'>" . $item["timestamp"] . " </span> " . $item["type"] . " " . floor($item["shares"]) . " share(s) of <b>" . htmlspecialchars($item["symbol"]) . "</b> for $"  . number_format($item["amount"], $decimals = 2, $dec_point = ".", $thousands_sep = ","));
                }

            }
        ?>
    </div>
</div>

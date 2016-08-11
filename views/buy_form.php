<h1>Buy</h1>

<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="symbol" placeholder="Stock Ticker" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="quantity" placeholder="Quantity of Shares" type="number" min="1"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                Buy
            </button>
        </div>
    </fieldset>
</form>
<div class="row">
    <div class="col-xs-12">
        <p><b>Cash Available for Investing: $<?= number_format($_SESSION["cash_available"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") ?></b></p>
    </div>
</div>
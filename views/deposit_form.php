<h1>Make a Deposit</h1>
<form action="deposit.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="amount" placeholder="Enter an Amount" type="text"/>
        </div>

        <div class="form-group">
            <button class="btn btn-default" type="submit">
                Deposit Funds
            </button>
        </div>
    </fieldset>
</form>
<div class="row">
    <div class="col-xs-12">
        <p><b>Cash Available for Investing: $<?= number_format($_SESSION["cash_available"], $decimals = 2, $dec_point = ".", $thousands_sep = ",") ?></b></p>
    </div>
</div>
<h1>Portfolio for <b><?= $_SESSION["username"] ?></b></h1>

<div class="row">
    <div class="col-xs-12">
        <b><?= $_SESSION["portfolio"][0]["symbol"] ?></b> <?= $_SESSION["portfolio"][0]["shares"] ?> @ <?= $_SESSION["portfolio"][0]["current_price"] ?> = <?= $_SESSION["portfolio"][0]["shares"] * $_SESSION["portfolio"][0]["current_price"] ?>
    </div>
</div>
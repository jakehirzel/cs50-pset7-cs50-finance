<h1>Results for <b><?= htmlspecialchars($_SESSION["symbol"]) ?></b></h1>
<p>Name: <?= htmlspecialchars($_SESSION["name"]) ?></p>
<p>Price: $<?= htmlspecialchars(number_format($_SESSION["price"], $decimals = 2, $dec_point = ".", $thousands_sep = ",")) ?></p>
<div>
    <p><a href="quote.php">Get another quote</a></p>
</div>
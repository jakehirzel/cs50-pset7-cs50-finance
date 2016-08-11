<?php

    // configuration
    require("../includes/config.php");
    
    // look for current session id, otherwise push to login
    if ($_SESSION["id"] == null) {
            redirect(".login.php");
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        // Query for portfolio and save to session
        $portfolio = CS50::query("SELECT * FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
        $_SESSION["portfolio"] = $portfolio;
        
        // Update share prices
        foreach ($_SESSION["portfolio"] as &$stock) {
            
            // Validate
            $current_price = lookup($stock["symbol"]);
            if ($current_price == 0) {
                apologize("Invalid stock symbol. Unable to refresh portfolio.");
            }
            
            // Assign return value of lookup to current_price
            else {
                $stock["current_price"] = $current_price["price"];
            }
        }
    
    // Unset the referenced value
    unset($stock);
    
    // Query for cash available and save to session
    $cash_available = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $_SESSION["cash_available"] = $cash_available[0]["cash"];
    
    // Render sell form
    render("sell_form.php", ["title" => "Sell"]);

    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Store sale value to return to cash
        $portfolio_index = $_POST["index"];
        $sale_value = $_SESSION["portfolio"][$portfolio_index]["shares"] * $_SESSION["portfolio"][$portfolio_index]["current_price"];

        // Delete the row from the portfolio
        CS50::query("DELETE FROM portfolios WHERE id = ?", $_POST["id"]);
        
        // Update cash available
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $sale_value, $_SESSION["id"]);
        
        // Redirect to portfolio
        redirect("index.php");
        
    }
?>

<?php

    // configuration
    require("../includes/config.php");
    
    // look for current session id, otherwise push to login
    if ($_SESSION["id"] == null) {
            redirect(".login.php");
    }

    else {
        
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
        
        // Render portfolio
        render("portfolio.php", ["title" => "Portfolio"]);
    }
?>

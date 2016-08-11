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
        
        // Update share prices in portfolio
        foreach ($_SESSION["portfolio"] as $stock) {
            
            // Validate
            if (lookup($stock["symbol"]) == 0) {
                apologize("Invalid stock symbol. Unable to refresh portfolio.");
            }
            
            // Assign return value of lookup to current_price
            else {
                $stock["current_price"] = lookup($stock["symbol"] );
            }
        }
        
        // Render portfolio
        render("portfolio.php", ["title" => "Portfolio"]);
    }
?>

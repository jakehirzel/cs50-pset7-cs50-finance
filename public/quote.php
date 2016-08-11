<?php

    // configuration
    require("../includes/config.php");
    
    // if user reaches page via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("quote_form.php", ["title" => "Quote Search"]);
    }
    
    // if user reaches page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate
        if (empty($_POST["symbol"])) {
            apologize("Please enter a valid stock symbol.");
        }

        // If valid, search
        else if (lookup($_POST["symbol"]) == 0) {
            apologize("Invalid stock symbol.");
        }
        
        else {
            
            // Search for the stock price
            $stock = lookup($_POST["symbol"]);
            
            // Store the values in $_SESSION
            $_SESSION["symbol"] = $stock["symbol"];
            $_SESSION["name"] = $stock["name"];
            $_SESSION["price"] = $stock["price"];
            
            // Render quote_display.php
            render("quote_display.php", ["title" => "Quote Results"]);
            
        }
    }
?>

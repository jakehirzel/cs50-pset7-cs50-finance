<?php

    // configuration
    require("../includes/config.php");
    
    // dump($_POST);
    // dump($_SESSION);
    
    // look for current session id, otherwise push to login
    if ($_SESSION["id"] == null) {
            redirect(".login.php");
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("buy_form.php", ["title" => "Buy"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate
        if (empty($_POST["symbol"])) {
            apologize("Please enter a valid stock symbol.");
        }
        else if (empty($_POST["quantity"])) {
            apologize("Please enter a non-negative, whole number quantity.");
        }
        
        else if (preg_match('/^\d+$/', $_POST["quantity"]) != 1) {
            apologize("Please enter a non-negative, whole number quantity.");
        }
        
        else if (lookup($_POST["symbol"]) == 0) {
            apologize("Invalid stock symbol.");
        }
        
        else {
            
            // Search for the stock price
            $stock = lookup($_POST["symbol"]);
            
            // Store the values in $_SESSION
            $_SESSION["symbol"] = strtoupper($stock["symbol"]);
            $_SESSION["name"] = $stock["name"];
            $_SESSION["price"] = $stock["price"];
            $_SESSION["quantity"] = $_POST["quantity"];
            
            // Store purchase value
            $purchase_value = $_SESSION["price"] * $_POST["quantity"];
            
            // Check for sufficient funds
            if ($purchase_value > $_SESSION["cash_available"]) {
                apologize("Insufficient funds.");
            }
            
            else {
                
                // Add line to database
                CS50::query("INSERT INTO portfolios (user_id, symbol, name, shares) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_SESSION["symbol"], $_SESSION["name"], $_SESSION["quantity"]);
                
                // Update cash available
                CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $purchase_value, $_SESSION["id"]);
                
                // Log transaction in history
                CS50::query("INSERT INTO history (user_id, type, symbol, name, shares, amount) VALUES(?, 'BUY', ?, ?, ?, ?)", $_SESSION["id"], $_SESSION["symbol"], $_SESSION["name"], $_SESSION["quantity"], $purchase_value);
                
                // Set confirmation message
                $_SESSION["confirmation"] = $_SESSION["quantity"] . " share(s) of " . $_SESSION["name"] . " successfully purchased.";
                
                // Redirect to portfolio
                redirect("index.php");
                
            }
        }
    }
?>

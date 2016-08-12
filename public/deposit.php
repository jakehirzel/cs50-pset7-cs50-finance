<?php

    // configuration
    require("../includes/config.php");
    
    // if user reaches page via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("deposit_form.php", ["title" => "Deposit Funds"]);
    }
    
    // if user reaches page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate
        if (empty($_POST["amount"])) {
            apologize("Please enter a dollar amount.");
        }
        
        else if (preg_match('/^[0-9]+(\.[0-9]{2,2})?$/', $_POST["amount"]) != 1) {
            apologize("Please enter a valid dollar amount to two decimal places.");
        }
        
        // If valid:
        else {
    
            // Update cash available
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["amount"], $_SESSION["id"]);
            
            // Log transaction in history
            CS50::query("INSERT INTO history (user_id, type, symbol, shares, amount) VALUES(?, 'DEP', 'N/A', 'N/A', ?)", $_SESSION["id"], $_POST["amount"]);
            
            // Set confirmation message
            $_SESSION["confirmation"] = "$" . $_POST["amount"] . " successfully deposited.";
            
            // Redirect to portfolio
            redirect("index.php");// If valid, update cash balance
            
        }
    }
?>

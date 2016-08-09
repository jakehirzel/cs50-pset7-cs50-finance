<?php

    // configuration
    require("../includes/config.php");
    
    // if user reaches page via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("register_form.php", ["title" => "Register"]);
    }
    
    // if user reaches page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate
        if (empty($_POST["username"])) {
            apologize("Please enter a username.");
        }
        else if (empty($_POST["password"])) {
            apologize("Please enter a password.");
        }
        else if ($_POST["confirmation"] != $_POST["password"]) {
            apologize("Passwords do not match.");
        }
        
        // If valid, add new user
        else if (CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) != 0 ) {
            
            // Query for id and save in session
            $query_row = CS50::query("SELECT id FROM users WHERE username = ?", $_POST["username"]);
            $id = $query_row[0]["id"];
            $_SESSION["id"] = $id;
            
            // Redirect to index.php
            redirect("index.php");
            
        }
        else {
            apologize("Username is not available.");
        }
    }
?>

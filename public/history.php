<?php

    // configuration
    require("../includes/config.php");
    
    // look for current session id, otherwise push to login
    if ($_SESSION["id"] == null) {
            redirect(".login.php");
    }

    else {
        
        // Query for history and save to session
        $history = CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
        $_SESSION["history"] = $history;
        
        // Render history display
        render("history_display.php", ["title" => "History"]);
        
    }
?>

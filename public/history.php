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
        
        // Get timezone offset (per http://bit.ly/2bcg4tt)
        $new_timezone = new DateTimeZone('America/New_York');
        $time_in_timezone = new DateTime('now', $new_timezone);
        $offset = $new_timezone->getOffset($time_in_timezone);
        
        // Update timezone and format date
        foreach ($_SESSION["history"] as &$item) {
            $time_adjusted = date("D, M dS g:ia", strtotime($item["timestamp"] . $offset . " seconds"));
            $item["timestamp"] = $time_adjusted;
            
        }
        
        // Unset referenced value
        unset($item);
        
        // Render history display
        render("history_display.php", ["title" => "History"]);
        
    }
?>

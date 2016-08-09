<?php

    // configuration
    require("../includes/config.php");
    
    // if user reaches page via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("register_form.php", ["title" => "Register"]);
    }
    
    // if user reaches page via POST
    else if ($_SERVER["REQUEST METHOD"] == "POST") {
        // TODO
    }

?>
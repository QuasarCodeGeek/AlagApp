<?php
    require("./api/connector.php");
    
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    echo "<script>window.location='./index.php'</script>";//Successfully Logged Out
?>
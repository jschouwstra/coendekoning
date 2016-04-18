<?php
    $user = new User($db);
    if(!$user->getID( $db )) {
        header("location: index.php?view=login"); // Redirecting To Other Page
    }
?>
home, you are not logged in
<?php

/**
 * Redirect to given url
 *
 * @param string $whereTo
 * @return void
 */
function redirect($whereTo)
{
    header("Location: " . URLROOT . $whereTo);
}

function isLoggedIn()
{

    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

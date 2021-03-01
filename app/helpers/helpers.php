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

    if (isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}

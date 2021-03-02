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

/**
 * Checks is user is logged in
 *
 * @return boolean
 */
function isLoggedIn()
{

    if (isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}

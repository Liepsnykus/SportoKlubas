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

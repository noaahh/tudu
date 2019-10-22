<?php

/**
 * Returns the correct date depending on the correct format of the date
 * @param $date The date which should be checked
 * @return false|string The correct date or null
 * @throws Exception
 */
function validateDate($date)
{
    $time = strtotime($date);
    if ($time) {
        return true;
    }
    return false;
}

/**
 * @param $string Input string
 * @return string Sanitized string
 */
function sanitizeInput($string)
{
    return htmlspecialchars(trim(stripslashes($string)));
}
<?php

function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function json_safe($data)
{
    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

<?php

function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}

function getTitle($url)
{
    return ucfirst(substr(explode('?', $url)[0], 1));
}

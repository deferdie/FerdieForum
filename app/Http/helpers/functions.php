<?php

function process($string, $replacement_array)
{
    // dd($replacement_array);
    return $string_processed = preg_replace_callback(
    '~\{\[\$(.*?)\]\}~si',
    function($match) use ($replacement_array)
    {
        foreach($replacement_array as $var)
        {
            if($var->name == $match[1])
            {
                return str_replace($match[0], $var->value, $match[0]);
            }
        }
    },
    $string);
}

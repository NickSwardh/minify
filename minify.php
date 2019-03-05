<?php

/*
    Pass in the html string into the Minify() function and
    it will return a clean minified version of your HTML.

    Visit https://vpnks.nswardh.com or https://kraken.nswardh.com for example.

*/

function Minify($html)
    {
        /*
            Minify HTML output for faster loading.
            By Nick Swardh - nswardh.com
        */

        return preg_replace_callback_array(
            [
                // Remove all line breaks and spaces to single ' '.
                '/\s+/s' => function($match)
                {
                    return ' ';
                },

                // Remove all space between > and <.
                '/>\s+</s' => function($match)
                {
                    return '><';
                },
                
                // Remove all space inside <style> tags and style-attributes.
                '/(<?style\s*(?:>|=\s*")(.*?)(?:"|<\/style>))/is' => function($match)
                {
                    return preg_replace('/(?<=[:;{])\s+|\s+(?=[;}])|(?<=[},])\s+|\s+(?={)|^\s+|\s+$|(?<=[:;])\s+|\s+(?=[;"])/m', '',$match[1]);
                },
                
                // Remove space between attributes, before the end of > and around all tags.
                '/\s*<.*?\s+.*?>\s*/s' => function($match)
                {
                    return preg_replace('/(?<=")\s+|\s+(?=\/\s*>)|\s+(?=>)/s', '', trim($match[0]));
                },
                
                // Remove comments.
                '/<!--.*?-->/s' => function($match)
                {
                    return '';
                }

            ], $html);
    }

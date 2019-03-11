<?php
/**
 * Created by PhpStorm.
 * User: ronnibaslund
 * Date: 24/09/15
 * Time: 09.01
 */

function renderMenu($node)
{
    //TODO: get language_id from session or global
    $description = $node->descriptions()->language(1)->first();

    $html = '<li>' . $description->name;
        $html .= '<ul>';

        foreach ($node->children as $child)
            $html .= renderMenu($child);
        $html .= '</ul>';

    $html .= '</li>';

    return $html;
}
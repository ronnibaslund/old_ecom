<?php
/**
 * Created by PhpStorm.
 * User: ronnibaslund
 * Date: 24/09/15
 * Time: 09.01
 */

function renderSelectTree($node, $selected = '', $spacer = '')
{
    $description = $node->descriptions()->language(1)->first();

    if(!isset($html)) {
        $html = '';
    }

    // Check to see if selected is array or object
    if(is_array($selected) or is_object($selected)) {
        foreach($selected as $s) {
            if(is_object($s)) {

                if($node->id == $s->category_id) {
                    $html .= '<option value="' . $node->id . '" selected>'. $spacer . $description->name . '</option>';
                } else {
                    $html .= '<option value="' . $node->id . '">'. $spacer . $description->name . '</option>';
                }
            }

            if(is_array($s)) {
                if($node->id == $s) {
                    $html .= '<option value="' . $node->id . '" selected>'. $spacer . $description->name . '</option>';
                } else {
                    $html .= '<option value="' . $node->id . '">'. $spacer . $description->name . '</option>';
                }
            }
        }

    } else {
        if($node->id == $selected) {
            $html .= '<option value="' . $node->id . '" selected>'. $spacer . $description->name . '</option>';
        } else {
            $html .= '<option value="' . $node->id . '">'. $spacer . $description->name . '</option>';
        }

    }

    foreach ($node->children as $child)
        $html .= renderSelectTree($child, $selected, $spacer . '--');

    return $html;
}
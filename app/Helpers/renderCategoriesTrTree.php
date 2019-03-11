<?php
/**
 * Created by PhpStorm.
 * User: ronnibaslund
 * Date: 24/09/15
 * Time: 09.01
 */

function renderCategoriesTrTree($node, $spacer = '')
{
    $description = $node->descriptions()->language(1)->first();

    if($node->status == 0) {
        $status = "Ikke aktiv";
    } else {
        $status = "Aktiv";
    }

    $html = '
    <tr>
        <td>'. $node->id .'</td>
        <td>' . $spacer . $description->name .'</td>
        <td>'. $status .'</td>
        <td class="text-right">
            <a href="' . url("admin/category/$node->id/edit") . '" class="btn btn-link" title="Edit"><i class="fa fa-pencil"></i></a>
            <button class="btn btn-link" title="Delete"><i class="fa fa-trash"></i></button>
        </td>
    </tr>';

    foreach ($node->children as $child)
        $html .= renderCategoriesTrTree($child, $spacer . '--');

    return $html;
}
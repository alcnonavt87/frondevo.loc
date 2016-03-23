<?php
$countLangs = count($langs);
if($countLangs) {
    $navMenu .= '<fieldset class="select-wrap sidebar_select"><select class="select" name="language" data-module="select">';
    for($i = 0; $i < $countLangs; $i++)     {
        if($pageLang == $langs[$i]['sName'])         {
            $navMenu .= '<option data-href="formedit" data-action="/'.$id1Uri.'/'.$idPage.'/'.$langs[$i]['sName'].'" selected value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
        } else {
            $navMenu .= '<option data-href="formedit" data-action="/'.$id1Uri.'/'.$idPage.'/'.$langs[$i]['sName'].'" value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
        }
    }
    $navMenu .= '</select></fieldset>';
}
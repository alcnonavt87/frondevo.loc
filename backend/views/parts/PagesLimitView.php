<?php
//Количество записей на странице
$limitList = '';
if($limit == 3) {
    $limitList .= '<option selected="">3</option>';
} else {
    $limitList .= '<option>3</option>';
}
if($limit == 5) {
    $limitList .= '<option selected="">5</option>';
} else {
    $limitList .= '<option>5</option>';
}
if($limit == 10) {
    $limitList .= '<option selected="">10</option>';
} else {
    $limitList .= '<option>10</option>';
}
if($limit == 20) {
    $limitList .= '<option selected="">20</option>';
} else {
    $limitList .= '<option>20</option>';
}
$limitList = $this->createSelect(['width' => 400, 'text' => 'Количество записей', 'name' => 'limit', 'attr' => 'id="limit"', 'value' => $limitList]);
//Количество записей на странице
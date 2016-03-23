<?php
//$page - Текущая страница
//$totalPages - Общее число страниц
//$radius - число отображаемых номеров страниц слева и справа от текущй

$pagePrev = $pageNext = [];
for($i = 0; $i < $radius; $i++) {
    $pagePrev[$i] = $page - $i - 1;
    $pageNext[$i] = $page + $i + 1;
}

$pagination = '<ul class="pagination">';
if($page > 1) {
    $pagination.='<li class="pagination__item" id="prevProdPage">&lt;</li>';
}
if(($page - $radius) > 1) {
    $pagination.='<li class="pagination__item">1</li>';
}
if(($page - $radius) > 2) {
    $pagination.='<li class="pagination__item">...</li>';
}
for($i = ($radius -1); $i >= 0; $i--) {
    if($pagePrev[$i] > 0) {
        $pagination.='<li class="pagination__item">'.$pagePrev[$i].'</li>';
    }
}
if($totalPages > 1) {
    $pagination.='<li class="pagination__item pagination__active">'.$page.'</li>';
}
for($i = 0; $i < $radius; $i++) {
    if($pageNext[$i] <= $totalPages) {
        $pagination.='<li class="pagination__item">'.$pageNext[$i].'</li>';
    }
}

if(($totalPages - ($page + $radius)) > 1) {
    $pagination.='<li class="pagination__item">...</li>';
}
if(($totalPages - ($page + $radius)) >= 1) {
    $pagination.='<li class="pagination__item">'.$totalPages.'</li>';
}
if($page < $totalPages) {
    $pagination.='<li class="pagination__item" id="nextProdPage">&gt;</li>';
}
$pagination.='</ul>';
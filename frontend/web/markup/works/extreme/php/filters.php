<?php

/*
     var obj = {
        id: 'itemId',
        title: 'Карлсберг',
        about: 'Ирландская классика свареная в стиле сухих ирландских стаутов.',
        img: 'pic/goods-list/img2-small.png',
        boxing: [
            {
                size: '0,5',
                sizeUnit: 'л',
                price: '75',
                priceUnit: 'руб'
            },
            {
                size: '1',
                sizeUnit: 'л',
                price: '90',
                priceUnit: 'руб'
            },
            {
                size: '2',
                sizeUnit: 'л',
                price: '120',
                priceUnit: 'руб'
            }
        ],
        pins: [ 90, 360 ]
    };
*/

/*sleep(2);*/

/*$answer = array();

for ( $i = 0; $i < 10; $i++ ) {

    $item[ 'id' ] = 'item'.$i;
    $item[ 'title' ] = 'Белый медведь';
    $item[ 'about' ] = 'Ирландская классика свареная в стиле сухих ирландских стаутов.';
    $item[ 'img' ] =  array( src => 'pic/goods-list/img2-small.png', width => 'auto', height => 'auto', alt => 'Белый медведь' );
    $item[ 'boxing' ] = array(
        array(
            size => '0,5',
            sizeUnit => 'л',
            price => rand(90,180),
            priceUnit => 'руб'
        ),
        array(
            size => '1',
            sizeUnit => 'л',
            price => rand(90,180),
            priceUnit => 'руб'
        ),
        array(
            size => '2',
            sizeUnit => 'л',
            price => rand(90,180),
            priceUnit => 'руб'
        )
    );
    $item[ 'pins' ] = array( rand(0,360), rand(0,360) );

    array_push( $answer, $item );
}
echo json_encode( $answer );*/

/*$answer = array();
$item[ 'link' ] = '#';
$item['img'] = 'pic/lightbox/box0.jpg';
$item[ 'title' ] = 'Название тура';
$item[ 'date' ] =  array('12.06.2014', '2014-06-12');
$item[ 'description' ] = '<p>Краткое описание, дающее о нем небольшое представления. Описание совместно с фото и заголовком, должно стимулировать посмотреть детали тура</p>';
array_push( $answer, $item );
echo json_encode( $answer );*/

sleep(1);
$answer = array();
$num = rand(5,10);
for ( $i = 0; $i < $num; $i++ ) {
    $item[ 'link' ] = '#';
    $item['img'] = 'pic/lightbox/box0.jpg';
    $item['imgalt'] = 'Описание для картинки';
    $item[ 'title' ] = 'Название тура';
    $item[ 'date' ] =  array('12.06.2014', '2014-06-12');
    $item[ 'description' ] = '<p>Краткое описание, дающее о нем небольшое представления. Описание совместно с фото и заголовком, должно стимулировать посмотреть детали тура</p>';
    array_push( $answer, $item );
}
echo json_encode( $answer );
?>



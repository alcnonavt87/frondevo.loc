<?php

namespace corpsepk\yii2emt;

/**
 * @see EMT_Tret
 */

class EMT_Tret_OptAlign extends \corpsepk\yii2emt\EMT_Tret
{

    public $classes = array(
        'oa_obracket_sp_s' => "",
        "oa_obracket_sp_b" => "",
        "oa_obracket_nl_b" => "",
        "oa_comma_b"       => "",
        "oa_comma_e"       => "",
        'oa_oquote_nl' => "",
        'oa_oqoute_sp_s' => "",
        'oa_oqoute_sp_q' => "",
    );

    /**
     * Базовые параметры тофа
     *
     * @var array
     */
    public $title = "Оптическое выравнивание";
    public $rules = array(
        'oa_oquote' => array(
            'description'	=> 'Оптическое выравнивание открывающей кавычки',
            //'disabled'      => true,
            'pattern' 		=> array(
                '/([a-zа-яё\-]{3,})(\040|\&nbsp\;|\t)(\&laquo\;)/uie',
                '/(\n|\r|^)(\&laquo\;)/ei'
            ),
            'replacement' 	=> array(
                '$m[1] . $this->tag($m[2], "span", array("class"=>"oa_oqoute_sp_s")) . $this->tag($m[3], "span", array("class"=>"oa_oqoute_sp_q"))',
                '$m[1] . $this->tag($m[2], "span", array("class"=>"oa_oquote_nl"))',
            ),
        ),
        'oa_oquote_extra' => array(
            'description'	=> 'Оптическое выравнивание кавычки',
            //'disabled'      => true,
            'function'	=> 'oaquote_extra'
        ),
        'oa_obracket_coma' => array(
            'description'	=> 'Оптическое выравнивание для пунктуации (скобка и запятая)',
            //'disabled'      => true,
            'pattern' 		=> array(
                '/(\040|\&nbsp\;|\t)\(/ei',
                '/(\n|\r|^)\(/ei',
                '/([а-яёa-z0-9]+)\,(\040+)/iue',
            ),
            'replacement' 	=> array(
                '$this->tag($m[1], "span", array("class"=>"oa_obracket_sp_s")) . $this->tag("(", "span", array("class"=>"oa_obracket_sp_b"))',
                '$m[1] . $this->tag("(", "span", array("class"=>"oa_obracket_nl_b"))',
                '$m[1] . $this->tag(",", "span", array("class"=>"oa_comma_b")) . $this->tag(" ", "span", array("class"=>"oa_comma_e"))',
            ),
        ),

    );

    /**
     * Если стоит открывающая кавычка после <p> надо делать её висячей
     *
     * @return  void
     */
    protected function oaquote_extra()
    {
        $this->_text = $this->preg_replace_e(
            '/(<' .self::BASE64_PARAGRAPH_TAG . '>)([\040\t]+)?(\&laquo\;)/e',
            '$m[1] . $this->tag($m[3], "span", array("class"=>"oa_oquote_nl"))',
            $this->_text);
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: reinhurd
 * Date: 08.12.2018
 * Time: 13:30
 */

class canongenerator
{
    private $current_url;
    public $final_canon;
    private $check_income_url = true;

    public function __construct($url=null)
    {
        if($url){
            $this->current_url = 'https://'.$_SERVER['SERVER_NAME'].$url;
            $this->check_income_url = false;
        } else {
            $this->current_url = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            $this->check_income_url = true;
        }
    }

    public function checksUrlandReplace()
    {
        ##Очищаем гет-запросы
        if($this->check_income_url){
            $this->current_url = preg_replace('/\?(.*)/', '', $this->current_url);
        }
        ##Проверим, применен ли фильтр
        if(strpos($this->current_url, '/filter/')!==false){
            $this->final_canon = mb_strtolower(preg_replace('/filter(.*)apply\//','', $this->current_url));
            return true;
        }

        return false;
    }

    public function getCanonUrl(){
        ##Если фильтр был заменен, возравщаем чистый url
        if($this->checksUrlandReplace()){
            echo $this->final_canon;
            return $this->final_canon;
        } else {
            echo mb_strtolower($this->current_url);
            return $this->current_url;
        }
    }
}
<?php

namespace App\Http;
use App\Models\Page;
use Mockery\Exception;
use Auth;
use URL;
use App;

class Helpers {

    public static function getTranslatedSlugRu($text)
    {
        $cyr2lat_replacements = array (
            "А" => "a","Ә" => "a", "Б" => "b","В" => "v","Г" => "g","Ғ" => "gh","Д" => "d",
            "Е" => "e","Ё" => "yo","Ж" => "dg","З" => "z","И" => "i","І" => "i",
            "Й" => "y","К" => "k","Қ" => "q","Һ" => "q","Л" => "l","М" => "m","Н" => "n","Ң" => "nh",
            "О" => "o","Ө" => "o","П" => "p","Р" => "r","С" => "s","Т" => "t",
            "У" => "u","Ұ" => "u","Ү" => "u","Ф" => "f","Х" => "kh","Ц" => "ts","Ч" => "ch",
            "Ш" => "sh","Щ" => "csh","Ъ" => "","Ы" => "y","Ь" => "",
            "Э" => "e","Ю" => "yu","Я" => "ya","?" => "",

            "а" => "a","ә" => "a","б" => "b","в" => "v","г" => "g","ғ" => "gh","д" => "d",
            "е" => "e","ё" => "yo","ж" => "dg","з" => "z","и" => "i","і" => "i",
            "й" => "y","к" => "k","қ" => "q","һ" => "q","л" => "l","м" => "m","н" => "n","ң" => "nh",
            "о" => "o","ө" => "o","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "u","ұ" => "u","ү" => "u","ф" => "f","х" => "kh","ц" => "ts","ч" => "ch",
            "ш" => "sh","щ" => "sch","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
            "(" => "", ")" => "", "," => "", "." => "",

            "-" => "-","%" => "-"," " => "-", "+" => "", "®" => "", "«" => "", "»" => "", '"' => "", "`" => "", "&" => "","/" => "-"
        );

        $str = strtr (trim($text),$cyr2lat_replacements);
        $str =  substr($str, 0, 80);
        return $str;
    }
    
    public static function getSessionLang(){
        $lang = 'ru';
        if (isset($_COOKIE['site_lang'])) {
            $lang = $_COOKIE['site_lang'];
        }
        return $lang;
    }

    public static function getIdFromUrl($url){
        $url = strrev($url);
        $id = strstr($url,'/',true);
        $id = strrev($id);
        return $url;
    }

    public static function getUserId(){
        $user_id = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->user_id;
        }
        return $user_id;
    }

    public static function send_mime_mail($name_from, // имя отправителя
                            $email_from, // email отправителя
                            $name_to, // имя получателя
                            $email_to, // email получателя
                            $data_charset, // кодировка переданных данных
                            $send_charset, // кодировка письма
                            $subject, // тема письма
                            $body // текст письма
    ) 
    {
        $to = Helpers::mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email_to . '>';
        $from = Helpers::mime_header_encode($name_from, $data_charset, $send_charset)
            .' <' . $email_from . '>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: $from\r\n";
        
        return mail($to, $subject, $body, $headers);
    }

    public static function mime_header_encode($str, $data_charset, $send_charset) {
        if($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset, $str);
        }
        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }
    

    public static function replaceGetUrl($param) {
        $parsed = parse_url("http://example?" .http_build_query($_GET));
        $query = '';
        if(isset($parsed['query'])){
            $query = $parsed['query'];
        }

        parse_str($query, $new_url);
        $param = explode(',', $param);
        $new_val = '';

        foreach($param as $key => $value){
            if($key % 2 == 0){
                unset($new_url[$value]);
                $new_val = $value;
            }
            else {
                $new_url[$new_val] = $value;
            }
        }

        $string = http_build_query($new_url);
        return $string;
    }

    public static function getMonthName($number) {
        $lang = 'ru';
        if (isset($_COOKIE['site_lang'])) {
            $lang = $_COOKIE['site_lang'];
        }

        if($lang == 'ru'){
            $monthAr = array(
                1 => array('Январь', 'Января'),
                2 => array('Февраль', 'Февраля'),
                3 => array('Март', 'Марта'),
                4 => array('Апрель', 'Апреля'),
                5 => array('Май', 'Мая'),
                6 => array('Июнь', 'Июня'),
                7 => array('Июль', 'Июля'),
                8 => array('Август', 'Августа'),
                9 => array('Сентябрь', 'Сентября'),
                10=> array('Октябрь', 'Октября'),
                11=> array('Ноябрь', 'Ноября'),
                12=> array('Декабрь', 'Декабря')
            );
        }
        else if($lang == 'kz'){
            $monthAr = array(
                1 => array('Январь', 'Қаңтар'),
                2 => array('Февраль', 'Ақпан'),
                3 => array('Март', 'Наурыз'),
                4 => array('Апрель', 'Сәуір'),
                5 => array('Май', 'Мамыр'),
                6 => array('Июнь', 'Маусым'),
                7 => array('Июль', 'Шілде'),
                8 => array('Август', 'Тамыз'),
                9 => array('Сентябрь', 'Қыркүйек'),
                10=> array('Октябрь', 'Қазан'),
                11=> array('Ноябрь', 'Қараша'),
                12=> array('Декабрь', 'Желтоқсан')
            );
        }
        else {
            $monthAr = array(
                1 => array('Январь', 'January'),
                2 => array('Февраль', 'February'),
                3 => array('Март', 'March'),
                4 => array('Апрель', 'April'),
                5 => array('Май', 'May'),
                6 => array('Июнь', 'June'),
                7 => array('Июль', 'July'),
                8 => array('Август', 'August'),
                9 => array('Сентябрь', 'September'),
                10=> array('Октябрь', 'October'),
                11=> array('Ноябрь', 'November'),
                12=> array('Декабрь', 'December')
            );
        }
        if(!isset($monthAr[(int)$number][1])){
            return '';
        }
        return $monthAr[(int)$number][1];
    }

    public static function getPhoneFormat($phone){
        if(!is_numeric($phone)) return '';
        $phone = substr($phone, -10);
        $phone = '+7' .$phone;
        $phone = substr_replace($phone, '(', 2, 0);
        $phone = substr_replace($phone, ')', 6, 0);
        return $phone;
    }

    public static function getParamByPosition($params,$param_name) {
        $params = explode('/',$params);
        foreach($params as $key => $value){
            if($key % 2 == 0 && $value == $param_name)
                return isset($params[$key + 1])?$params[$key + 1]:'';
        }
    }

    
    public static function getPageText($id){
        $page = Page::find($id);
        if($page == null){
            return '';
        }
        return $page['page_text_'.App::getLocale()];
    }

    public static function getPageImage($id){
        $page = Page::find($id);
        if($page == null){
            return '';
        }
        return $page->getPageImage();
    }

    public static function getPageUrl($id){
        $page = Page::find($id);
        if($page == null){
            return '';
        }
        return $page->getPageUrl();
    }

    public static function getPageName($id){
        $page = Page::find($id);
        if($page == null){
            return '';
        }
        return $page->getPageName();
    }

    public static function setSessionLang($lang,$request){
        $locale = $request->segment(1);
        $lang_list = ['ru','kz','en'];
        $url_path = $request->path();
        if (in_array($locale, $lang_list))
        {
            $url_path = str_replace($locale ."/","",$url_path);
            $url_path = str_replace($locale,"",$url_path);
        }
        if($url_path != '' && $url_path != '/') $url_path = '/'.$url_path;
        $lang = URL::to('/') . '/'  .$lang .$url_path;
        return $lang;
    }

    public static function make_signature($input_data, $key) {
        foreach ($input_data as $name => $value) {
            if ($name !== "PAYMENT_HASH") $params[$name] = $value;
        }
        uksort($params, "strcasecmp");
        $values = "";

        foreach ($params as $name => $value) {
            $values .= $value;
        }

        $signature = base64_encode(pack("H*", md5($values . $key)));

        return $signature;
    }

    public static function send_request($url, $data) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = trim($response);

        return json_decode($response);
    }
} 
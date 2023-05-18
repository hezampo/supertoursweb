<?php

/**
 * Description of I18nController
 *
 * @author ivgallo
 */
class I18nController extends DooController {

    //var $langs = array('es', 'en');

    function __construct() {
        if (isset($_GET['lang'])) {
            if (in_array($_GET['lang'], Doo::conf()->langs)) {
                setcookie('lang', $_GET['lang'], time() + 14400 * 240, '/');
                Doo::conf()->lang = $_GET['lang'];
            } else {
                setcookie('lang', 'es');
                Doo::conf()->lang = 'es';
            }
        } else if (!isset($_COOKIE['lang'])) {
            //if user doesn't specify any language, check his/her browser language
            //check if the visitor language is supported
            //$this->language(true) to return the country code such as en-US zh-CN zh-TW
            if (in_array($this->language(), Doo::conf()->langs)) {
                //setcookie('lang', $this->language(), time() + 3600 * 240, '/');
                Doo::conf()->lang = $this->language();
            } else {
                setcookie('lang', 'es', time() + 14400 * 240, '/');
                Doo::conf()->lang = 'es';
            }
        } else {
            Doo::conf()->lang = ($_COOKIE['lang'] == "" ? "es" : $_COOKIE['lang']);
        }
    }

}

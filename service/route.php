<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/12
 * Time: 21:08
 */

class Route {
    public static $view = 'index';
    public static $action = 'index';
    public static $queryString = array();
    public static function parseUrl2(){
        if(isset($_REQUEST['view'])){
            self::$view = $_REQUEST['view'];
        }
        if(isset($_REQUEST['action'])){
            self::$action = $_REQUEST['action'];
        }
        if(isset($_REQUEST['queryString'])){
            self::$queryString = $_REQUEST['queryString'];
        }
    }

    public static function parseUrl(){
        $GLOBALS['view'] = 'index';
        $GLOBALS['action'] = 'index';
        $GLOBALS['queryString'] = array();
        if (isset($_SERVER['PATH_INFO'])){
            $pathInfo = explode('/', $_SERVER['PATH_INFO']);
            array_shift($pathInfo);
            if(sizeof($pathInfo) >= 1){
                $GLOBALS['view'] = $pathInfo[0];
            }
            if(sizeof($pathInfo) >= 2){
                $GLOBALS['action'] = $pathInfo[1];
            }
            if(sizeof($pathInfo) >= 3){
                array_shift($pathInfo);
                array_shift($pathInfo);
                $GLOBALS['queryString'] = $pathInfo;
            }
        }
    }

    public static function parseQueryString(array$aQueryString){
        $queryString = array();
        // view 与 action 为默认值时
        if ($GLOBALS['view'] == 'index' && $GLOBALS['action'] == 'index'){
            $GLOBALS['queryString'] = $queryString;
            return true;
        }
        global $urlRule;
        if (isset($urlRule[$GLOBALS['view']][$GLOBALS['action']])){
            $aActionRule = &$urlRule[$GLOBALS['view']][$GLOBALS['action']];
            foreach ($aActionRule as $key=>$val){
                // 规则值为 '' 时
                if ($val == '') {
                    $queryString[$key] = '';
                    continue;
                }
                if (isset($aQueryString[0])){
                    // 取得正则表达式
                    $pattern = '/'.substr($val, strpos($val, ',')+1).'/';
                    // 模式匹配
                    if (preg_match($pattern, $aQueryString[0])){
                        // 取值
                        $queryString[$key] = $aQueryString[0];
                        // 弹出值
                        array_shift($aQueryString);
                    }else {
                        // 取默认值
                        $queryString[$key] = substr($val, 0, strpos($val, ','));
                    }
                }else {
                    // 取默认值
                    $queryString[$key] = substr($val, 0, strpos($val, ','));
                }
            }
            $GLOBALS['queryString'] = $queryString;
        }else {
            throw new Exception('试图访问不存在的页面');
        }
    }
}
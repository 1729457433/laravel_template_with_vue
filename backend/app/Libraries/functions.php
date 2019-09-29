<?php
function get_curl($url){
    $ch = curl_init();
    curl_setopt( $ch , CURLOPT_URL , $url );
//    curl_setopt ($ch, CURLOPT_REFERER, "");
    curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
    @curl_setopt( $ch , CURLOPT_FOLLOWLOCATION , 1 );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
    curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , false );
    curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , false );

//        $result = file_get_contents('/Public/cacert.pem');
//        $result = readfile('../../test.txt');
//        addWeixinLog('file_get_contents',$result);
//        curl_setopt($ch,CURLOPT_CAINFO,'__PUBLIC__/cacert.pem');
    $res =  curl_exec( $ch );
    curl_close( $ch );
    return $res;
}

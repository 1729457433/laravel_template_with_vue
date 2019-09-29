<?php
namespace App\Libraries;

use App\Constants\Code;

final class Tools{
//    public static function responseData(int $code, string $msg='', array $response=[]){
//        return ['code'=>$code, 'msg'=>$msg, 'response'=>!empty($response) ? $response: new \stdClass()];
//    }
//
//    public static function returnSuccess(string $msg='', array $response=[]){
//        return self::responseData(Code::OK,$msg,$response);
//    }
//
//    public static function returnError(string $msg='', array $response=[]){
//        return self::responseData(Code::ERR,$msg,$response);
//    }


    public static function returnJsonSuccess(array $data=[], string $msg=''){
        return self::returnJson(Code::OK, $data, $msg);
    }

    public static function returnJsonError(array $data=[], string $msg=''){
        return self::returnJson(Code::OK, $data, $msg);
    }


    public static function returnJson(int $code, array $data=[], string $msg=''){
//        return response()->json(
//            [
//                'code'=>$code,
//                'data'=>$data,
//                'msg'=>$msg,
//            ]
//            ,200);

        return ['code'=>$code, 'msg'=>$msg, 'data'=>!empty($data) ? $data: new \stdClass()];
    }


}

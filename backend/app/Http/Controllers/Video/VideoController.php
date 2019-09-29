<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Libraries\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VideoController extends Controller
{
    public function list(Request $request){
        $json = get_curl('http://cj.156zy.me/inc/feifei3/index.php?wd='.$request->get('wd').'&cid='.$request->get('cid').'&p='.$request->get('p'));
        $data = json_decode($json,true);
        $data['tag'] = [
            '特别行动',
            '空降利刃',
            '陆战之王',
            '阿斯蒂芬',
        ];
//        dd(Tools::returnJsonSuccess($data));
        return Tools::returnJsonSuccess($data);
    }

}

<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Libraries\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VideoController extends Controller
{
    public function list(Request $request){

//        $json = get_curl('http://cj.156zy.me/inc/feifei3/index.php?wd='.$request->get('wd').'&cid='.$request->get('cid').'&p='.$request->get('p'));
//        $json = get_curl('http://www.zdziyuan.com/inc/feifei3.4/index.php?wd='.$request->get('wd').'&cid='.$request->get('cid').'&p='.$request->get('p'));
        $json = get_curl('http://cj.baiwanzy.com/inc/feifei3/index.php?wd='.$request->get('wd').'&cid='.$request->get('cid').'&p='.$request->get('p'));
//        $json = get_curl('http://api.kbzyapi.com/inc/feifei3.4/index.php?wd='.$request->get('wd').'&cid='.$request->get('cid').'&p='.$request->get('p'));
        $data = json_decode($json,true);
        $data['list'] = array_values(array_filter($data['list'],function($item){

            if(in_array($item['list_name'],['伦理片','写真视频','美女写真','美女视频','街拍系列','高跟赤足视频','VIP视频秀'])) return false;
            return true;
        }));
        $data['tag'] = [
            '中国机长',
            '我和我的祖国',
            '攀登者',
            '银河补习班',
            '铤而走险',
            '沉默的证人',
            '哪吒',

        ];//搜索提示
        $data['show_video'] = true;//是否显示播放
//        if($request->get('version') == '1.0.4')$data['show_video'] = false;

        $data['search'] = '大家都在搜：哪吒';//搜索提示

        $data['newsList']=['大家多转发，押韵随便押','维护不容易，目标一个亿','看完来个赞，年年一千万','顺便点收藏，不秃也变强'];
//        $data['newsList']=false;//公告
        $data['copyright']='本站所有资源来源于网友交流,只供网络测试，请大家支持正版到影院观看!';//底部信息
//        $data['copyright']='';//底部信息
//        dd(Tools::returnJsonSuccess($data));
        return Tools::returnJsonSuccess($data);
    }

}

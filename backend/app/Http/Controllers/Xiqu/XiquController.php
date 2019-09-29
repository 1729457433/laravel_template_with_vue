<?php

namespace App\Http\Controllers\Xiqu;

use App\Http\Controllers\Controller;
use App\Libraries\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class XiquController extends Controller
{


    public function listTxVideo(){
        for ($i=1;$i<2;$i++){
            $data = get_curl('http://access.video.qq.com/pc_client/GetUserVidListPage?vappid=50662744&vsecret=64b037e091deae75d3840dbc5d565c58abe9ea733743bbaf&page_index='.$i.'&stUserId=3522689006&page_size=20');
            $data = json_decode(trim($data, 'data='), true);
            $data = $data['data']['vecVidInfo'];
            $data = array_filter(array_map(function ($item) {
                $data = [];
                $data['title'] = $item['mapKeyValue']['title'];
                $data['img_url'] = $item['mapKeyValue']['pic_640x360'];
                $data['src'] = 'https://v.qq.com/x/page/' . $item['vid'] . '.html';
                $data['time'] = $item['mapKeyValue']['create_time'];
                $data['add_time'] = time();
                $res = DB::table('xiqu_list')->where([['title','=',$data['title']]])->get();
                if ($res->isEmpty()) {
                    return $data;
                }
            }, $data));
            dd($data);
//            DB::table('xiqu_list')->insert($data);
//            var_dump('第'.$i.'次成功');
        }

    }

    public function list(){


    }

}

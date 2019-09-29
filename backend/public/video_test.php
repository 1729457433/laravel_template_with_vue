<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/23 0023
 * Time: 18:13
 */





//http://cj.156zy.me/inc/feifei3/index.php?wd=关键字&cid=分类&p=分页

if($_GET['action'] == 'getVideoList'){
//    getVideoList($_GET['wd'],$_GET['cid'],$_GET['p']);
    getVideoList($_GET['search']);
}
if($_GET['action'] == 'getVideoDetail'){
    getVideoDetail($_GET['src']);
}

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

[
    '',//0
    '电影',//1
    '连续剧',//2
    '综艺',//3
    '动漫',//4
    '动作片',//5
    '喜剧片',//6
    '爱情片',//7
    '科幻片',//8
    '恐怖片',//9
    '剧情片',//10
    '战争片',//11
    '国产剧',//12
    '香港剧',//13
    '韩国剧',//14
    '欧美剧',//15
    '伦理片',//16
    '微电影',//17
    '海外剧',//18
    '日本剧',//19
    '台湾剧',//20
    '福利',//21
    '音乐',//22
    '纪录片',//23
    '',//24
    '',//25
    '',//26

];

function getVideoList2($wd='',$cid='',$p=''){
    $json = get_curl('http://cj.156zy.me/inc/feifei3/index.php?wd='.$wd.'&cid='.$cid.'&p='.$p);

    exit($json);

}

function getVideoList($search){
    $url_arr=[
        "http://www.156zy.co",
        "http://www.zuidazy.net",
        "http://www.baiwanzy.com",
        "http://www.okokzy.cc",
        "http://www.ziyuanpian.com",
        "http://www.kubozy.net",
        "http://www.go1977.com",
        "http://api.88gc.net",
        "http://www.605zy.com",
        "http://www.8laoye.com",
        "http://www.kukuzy.com",
        "http://zy.itono.cn",
        "http://zy.itono.cn",
        "http://zy.ataoju.com",
        "http://www.okokzy.cc"
    ];
    $url=$url_arr[0];
    if($search){
        $url = $url.'/index.php?m=vod-search&wd='.$search;
    }else{
        $url = $url.'/index.php/?m=vod-type-id-1.html';
    }
    $html = get_curl($url);

    $rule='#<span class="xing_vb4"><a href="(.*)" target="_blank">(.*)</a></span> <span class="xing_vb5">(.*)</span> <span class="xing_vb\S">(.*)</span>#';
    preg_match_all($rule,$html,$data);

    $mit = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
    $mit->attachIterator(new ArrayIterator($data[2]),'title');
    $mit->attachIterator(new ArrayIterator($data[1]),'src');
    $mit->attachIterator(new ArrayIterator($data[3]),'type');
    $data = [];
    foreach ($mit as $k=>$v){
        $v['src'] = $url_arr[0].$v['src'];
        $data[] = $v;
    }
//    $data = array_filter($data,function($item){
//        if($item['type'] == '伦理类'){
//            return false;
//        }else{
//            return true;
//        }
//    });
    echo json_encode($data);
}

function getVideoDetail($src){
    $seach=file_get_contents($src);

    $szz='#<li><input type="checkbox" name="copy_sel" value="(.*)" checked="" />(.*)</li>#';
    $szzz='#<li>类型：<span><!--类型开始-->(.*)<!--类型结束--> </span></li>#';

    $szz1='#<img class="lazy" src="(.*)" alt="(.*)" />#';

    $szz2='#<li>导演：<span><!--导演开始-->(.*)<!--导演结束--></span></li> #';

    $szz3='#<li>主演：<span><!--主演开始-->(.*)<!--主演结束--></span></li>#';
    $szz4='#<div class="vodplayinfo"><!--介绍开始-->(.*)<!--介绍结束--></div>#';

    preg_match_all($szz,$seach,$sarr);
    preg_match_all($szzz,$seach,$sarrr);
    preg_match_all($szz1,$seach,$sarr1);
    preg_match_all($szz2,$seach,$sarr2);
    preg_match_all($szz3,$seach,$sarr3);
    preg_match_all($szz4,$seach,$sarr4);
    $data['title']=array_values(array_filter( array_map(function($item){
        return explode('$',$item);
    },$sarr[2]),function($item){
        if(strpos($item[1],'m3u8') !== false || strpos($item[1],'mp4')){
            return true;
        }else{
            return false;
        }
    })); //地址
    $data['title_src'] = array_values(array_filter( array_map(function($item){
        return explode('$',$item);
    },$sarr[2]),function($item){
        if(strpos($item[1],'m3u8') !== false || strpos($item[1],'mp4')){
            return false;
        }else{
            return true;
        }
    })); //标题

    $data['name']=$sarr1[2][0];//名称
    $data['image']=$sarr1[1][0];//图片
    $data['dy']=$sarr2[1][0];//导演
    $data['zy']=$sarr3[1][0];//主演
    $data['content']=$sarr4[1][0];//剧情介绍
    $data['type']=$sarrr[1][0];//类型
    echo json_encode($data);

}




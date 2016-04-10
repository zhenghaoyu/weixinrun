<?php
  //判断是否存在uid和step
  if(isset($_POST['uid']) && isset($_POST['steps']) && $_POST['uid'] != "" && $_POST['steps'] != ""){
      //设置时区
      ini_set('date.timezone','Asia/Shanghai');
      //去掉所有空格
      //初始化cURL资源
      $cURL = curl_init();
      $url = "http://pl.api.ledongli.cn/xq/io.ashx";
      $step = $_POST['steps'];
      $date = date('y-m-d');
      $timestamp = strtotime($date);  //今天凌晨的时间邮戳
      $list = '[{"distance":0,"duration":0,"report":"[]","calories":0,"steps":'.$step.',"pm2d5":0,"date":'.$timestamp.',"activeValue":225}]'; //拼接list
      //post数据
      $data=array(
        'pc' => 'z',
        'uid' => $_POST['uid'],
        'step' => $step,
        'action' => 'profile',
        'cmd' => 'updatedaily',
        'list' => $list
      );
      //浏览器UA
      $UA = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 UBrowser/5.5.9703.2 Safari/537.36";
      curl_setopt($cURL,CURLOPT_URL,$url);
      curl_setopt($cURL,CURLOPT_POST,1);
      curl_setopt($cURL,CURLOPT_SSL_VERIFYPEER,false);
      curl_setopt($cURL,CURLOPT_USERAGENT,$UA);
      curl_setopt($cURL,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($cURL,CURLOPT_POSTFIELDS,$data);
      $return=curl_exec($cURL);
      curl_close($cURL);  //关闭cURL资源
      header('Content-type:text/json'); //告诉浏览器输出json格式
      header("Access-Control-Allow-Origin:*");  //允许ajax访问
      echo $return;  //把结果去掉所有空格
  }


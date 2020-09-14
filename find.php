<?php
/*
  Coded by Zeerx7
*/
echo "
Coded by Zeerx7 (XploitSec-ID)

Input List-> ";
$i = readline();
$a = "https://tools.hack.co.id/subdomain/";
if(file_exists($i)){
   $d = trim(file_get_contents($i));
   $p = explode("\n",$d);
   foreach($p as $s){
     $s = preg_replace("~http://|https://|/|www\.~","",$s);
     $post = "domain=$s";
     echo ">>> $s\n";
     $data = curl($a,$post);
     if($data){
       sub($data);
     }
   }
}

function sub($data){
$x = $data; //file_get_contents('ex.html');
$z = str_replace("\n",'~_|_~',$x);
preg_match_all("`<tr>(.+?)</tr>`i",$z,$r);
//print_r($r[1]);
foreach($r[1] as $w){
  $w = str_replace("~_|_~","\n",$w);
  //echo $w;
  preg_match_all("`\">(.+?)</a></td>`",$w,$f);                                                         preg_match_all("`<td>(.+?)</td>`",$w,$h);
  $dom =  $f[1][0];
  $ip  =  $h[1][2];
  if(!empty($dom) and $ip !== '<span></span>'){
    if($dom){
      echo $dom." [$ip]\n";
      fwrite(fopen("sub.txt","a+"),$dom."\n");
    }
  }else{
    echo "(Ip Empty) ".$dom."\n";
  }
}
}
function curl($url,$post){
$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) QtWebEngine/5.13.1 Chrome/73.0.3683.105 Safari/537.36"); // UA mein browser
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post);
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$output = curl_exec($curlHandle);
curl_close($curlHandle);
return $output;
}

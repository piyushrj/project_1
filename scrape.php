<?php
    $link=$_GET["url"];
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$link);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/56.0.2924.76 Chrome/56.0.2924.76 Safari/537.36");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $ret=curl_exec($ch);
    if($ret===false)
    {
        echo("Could not fetch the url provided");
        exit();
    }
    if(preg_match_all('@<h2\s*class="tuple-clg-heading"><a\s*href="[^"]+"\s*target="_blank">(.+)<\/a>@',$ret,$matches))
    {
        var_dump($matches);
    }
    else
    echo("failed to pare the college data");
?>
    
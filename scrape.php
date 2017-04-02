<?php
    $link=$_GET["url"];
    $flag=true;$counter=1;
    require("connect.php");
    while($flag)
    {
        $link1=$link."-".urlencode($counter);
        $n_pages=getdata($link1);
        if($counter>=$n_pages)
        {
            $flag=false;
        }
        $counter++;
        sleep(2);
    }
    
    function getdata($link)
    {
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
        
        if(preg_match_all('@<h2\s*class="tuple-clg-heading"><a\s*href="[^"]+"\s*target="_blank">(.+)+<\/a>\s*<p>\|\s*(.+)<\/p><\/h2>\s*(?:<ul class="facility-icons">\s*(?:<li class="emptyDesc">\s*<i class="[^"]+">\s*<div class="srpHoverCntnt2">\s*<h3>(.+)<\/h3>\s*<p><\/p>\s*<\/div>\s*<\/i>\s*<\/li>\s*)+<\/ul>)?\s*<\/section>\s*@',$ret,$matches))
        {
            if(count($matches[2])==count($matches[1]))
            {
                
                for($i=0;$i<count($matches[1]);$i++)
                {
                    
                    $a=$matches[1][$i];
                    $b=$matches[2][$i];
                    $query="INSERT INTO college VALUES ('','$a','$b')";
                    mysql_query($query);
                    
                    
                    $query1="SELECT col_id FROM college WHERE name='".mysql_real_escape_string($a)."'";
                    
                    $idt=($query1);
                    
                    
                    
                    
                    if(preg_match_all('@<h3>(.+)<\/h3>@',$matches[0][$i],$facilities)&&preg_match_all('@<h2\s*class="tuple-clg-heading"><a\s*href="[^"]+"\s*target="_blank">(.+)+<\/a>\s*<p>[^<]+<\/p>@',$matches[0][$i],$name))
                    {  
                        foreach($name[1] as $nm)
                        {
                        
                        foreach($facilities[1] as $f)
                        {
                            
                                $fac=$f;
                                $query2="INSERT INTO facilities VALUES ('$nm','$fac')";
                                mysql_query($query2);
                                
                                
                            
                        }
                        }
                    }
                    
                    
                }
                
            }
            
            
        }
        else
        echo("failed to parse the college data");
        
        preg_match('@<div class="added-clgs"><div class="num-to-add">(.+)<\/div><\/div>\s<\/div>@',$ret,$pages);
        return($pages[1]);
        
    }
    
    
    
?>
    

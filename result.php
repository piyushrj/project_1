<?php
    $q="SELECT name,location FROM college WHERE 1";
    $rows=mysql_query($q);
    echo("<table  id=\"colleges\">");
    echo("<tr>");
    echo("<th><b>Name</b></th>");
    echo("<th><b>Location</b></th>");
    echo("<th><b>Facilities</b></th>");
    echo("</tr>");
    while($row=mysql_fetch_array($rows))
    {
        echo("<tr>");
        echo("<td>".$row["name"]."</td>");
        echo("<td>".$row["location"]."</td>");
        echo("<td>");
        $fclts=mysql_query("SELECT facility FROM facilities WHERE cname='".mysql_real_escape_string($row["name"])."'");
        while($f=mysql_fetch_array($fclts))
        echo($f["facility"]."\t\t");
        
        echo("</td>");
        echo("</tr>");
    }
    echo("</table>");
?>
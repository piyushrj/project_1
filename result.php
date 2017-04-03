<?php
    $q="SELECT name,location FROM college WHERE 1";
    $rows=mysql_query($q);
    echo("<table>");
    echo("<tr>");
    echo("<td><h2>Name</h2></td>");
    echo("<td><h2>Location</h2></td>");
    echo("<td><h2>Facilities</h2></td>");
    echo("</tr>");
    while($row=mysql_fetch_array($rows))
    {
        echo("<tr>");
        echo("<td>".$row["name"]."</td>");
        echo("<td>".$row["location"]."</td>");
        echo("<td>");
        $fclts=mysql_query("SELECT facility FROM facilities WHERE cname='".mysql_real_escape_string($row["name"])."'");
        while($f=mysql_fetch_array($fclts))
        echo($f["facility"].",");
        
        echo("</td>");
        echo("</tr>");
    }
    echo("</table>");
?>
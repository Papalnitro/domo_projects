<?php

require_once 'ds18b20_reader_class.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("HTTP/1.1 200 OK");

$probe_reader= new ds18b20_reader();
$res = $probe_reader->get_list();
$i=0;

echo "<table border=1><tr><th>Reading w1 probes</th></tr>";
foreach ($res as $probe_id) {
    // Try a little stress test ...
    while ($i++ < 60 ) {
        echo "<tr>";
        echo "<td>$i - $probe_id is </td><td>". $probe_reader->get_temp($probe_id)."</td>";
        echo "</TR>";
    }
    echo "</table>";
}   
?>
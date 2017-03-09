<?php

require_once 'ds18b20_reader_class.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("HTTP/1.1 200 OK");

$probe_reader= new ds18b20_reader();

$res = json_decode(file_get_contents("http://localhost/ds18b20_get_list.php"));
$i=0;

echo "<table border=1><tr><th>Reading w1 probes</th></tr>";
foreach ($res as $probe_id) {
    // Try a little stress test ...
    while ($i++ < 5 ) {
        echo "<tr>";
        echo "<td>$i - $probe_id is </td><td>". $probe_reader->get_temp($probe_id)."</td>";
        echo "</TR>";
    }
    echo "</table>";
}   
?>
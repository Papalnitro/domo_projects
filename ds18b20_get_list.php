<?php

require_once 'ds18b20_reader_class.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// This is the web service to call to get a list of probes

$probe_reader= new ds18b20_reader();
$res = $probe_reader->get_list();

header('Content-type: application/json');
echo json_encode($res);

?>
<?php

// 1-wire class to read temperatures

class ds18b20_reader {
    
    // Dummy constructor
    function __construct() {		
    }
    
    // This member function returns the IDs found on the 1-wire
    // Simply by reading the correct directory
    public function get_list()
    {
        if ($handle = opendir('/')) {
            while (false !== ($entry = readdir($handle))) {
                $probe_list[]=$entry;
            }
            closedir($handle);
        } else {
            $probe_list=NULL;
        }
        
        return $probe_list;
    }
}

$probe= new ds18b20_reader();
$res = $probe->get_list();

var_dump($res);


?>
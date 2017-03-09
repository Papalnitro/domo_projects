<?php

// 1-wire class to read temperatures

class ds18b20_reader {

    const W1_DEVICE_ROOT = '/sys/bus/w1/devices/';
    const W1_SLAVE = '/w1_slave';

    // Dummy constructor
    function __construct() {		
    }
    
    // This member function returns the IDs found on the 1-wire
    // Simply by reading the correct directory
    public function get_list()
    {
        if ($handle = opendir(self::W1_DEVICE_ROOT)) {
            while (false !== ($entry = readdir($handle))) {
                if (strncmp($entry, '28-', 3)==0) {
                    $probe_list[]=$entry;
                }
            }
            closedir($handle);
        } else {
            $probe_list=NULL;
        }
        
        return $probe_list;
    }
    
    // This member function returns the temperature reading
    public function get_temp($probe)
    {
        $w1_file=self::W1_DEVICE_ROOT.$probe.self::W1_SLAVE;
        $temp_ok=false;
        
        if ($fp = fopen($w1_file, "r")) {
            while (!$temp_ok) {
                $l1=fgets($fp);
                $l2=fgets($fp);
                
                if (preg_match('/.*YES/', $l1)) {
                    $temp=substr($l2, strpos($l2,'t=')+2, 7)/1000;
                    $temp_ok=true;
                }else{
                    fclose($fp);
                    die ("Error reading temperature... pausing...<BR>");
                    usleep(200);
                    $fp = fopen($w1_file, "r");
                }
            }
            fclose($fp);
        } else {
            $temp=null;
        }
        return $temp;        
    }
}

?>
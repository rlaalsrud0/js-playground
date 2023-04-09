<?php

    function rec($access_token, $expires_in){
        $i = 1;
    for($n = 0; $n < 5; $n++)
    {
        if(file_exists('user'.$i.'.json'))
        {
            
        } 
        else {
            file_put_contents('user'.$i.'.json', $access_token, $expires_in);
            if(0 == filesize('table.json'))
            {
                $tt = array("user".$i => $access_token, $expires_in);
                $json = file_get_contents('table.json');
                $getData= json_decode($json,true);
                if(empty($getData))
                {
                    $getData= array();
                    $totalData = array_merge($getData,$tt);
                    file_put_contents('table.json', json_encode($totalData));
                } else {
                    $totalData = array_merge($getData,$tt);
                    file_put_contents('table.json', json_encode($totalData));
                }
                $i++;
            }
        }

    }
    return $json;
    }
?>
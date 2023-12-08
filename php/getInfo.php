<?php

 $id = file_get_contents("_info.txt",true,null,0);
 $array = [];
 $array[] = $id;
 $lines = explode("\n", $id);
$res = array_pop($lines);
echo json_encode($res);



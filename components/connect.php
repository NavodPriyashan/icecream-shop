<?php
$db_name = 'mysql:host=localhost;dbname=icecream_db';
$user_name = 'root';
$user_password = '1234';

$conn = new PDO($db_name, $user_name, $user_password);

if(!$conn){
    echo "not connect";
}

function unique_id(){
    $char = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charLength = strlen($char);
    $randomString = '';
    for ($i=0; $i < 20; $i++) {
        $randomString.=$char[mt_rand(0, $charLength -1)];
    }
    return $randomString;
}

?>
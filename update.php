<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:PUT');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Header, Authorization, X-Request-with');

include("function.php");


$requestMethod=$_SERVER["REQUEST_METHOD"];


if($requestMethod=="GET"){

  $customerList=getCustomerList();
  echo $customerList;


}else{

    $data=[

        'status'=>405,
        'message'=>$requestMethod.'Method not Allowed',
    ];

    header("HTTP/1.0 405 Method not Allowed");

    echo json_encode($data);
       
}


?>
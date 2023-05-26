<?php


header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Header, Authorization, X-Request-with');

include("function.php");


$requestMethod=$_SERVER["REQUEST_METHOD"];


if($requestMethod=="PUT"){

     $inputData=json_decode(file_get_contents("php://input"),true);

     if(empty($inputData)){
        
           $updateCustomer= updateCustomer($_POST,$_GET);
    
     } else{

        echo $updateCustomer=updateCustomer($inputData, $_GET);
     } 


     echo $updateCustomer;
    

}else{

    $data=[

        'status'=>405,
        'message'=>$requestMethod.'Method not Allowed',
    ];

    header("HTTP/1.0 405 Method not Allowed");

    echo json_encode($data);
       
}



?>
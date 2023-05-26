<?php

require'inc/dbconn.php';


function error422($message){

    $data=[

       'status' => 422,
        'message'=>$message

    ];

    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}


function storeCustomer($customerInput){
 
     global $conn;

      $name=mysqli_real_escape_string($conn,$customerInput['name']);
      $email=mysqli_real_escape_string($conn,$customerInput['email']);
      $phone=mysqli_real_escape_string($conn,$customerInput['phone']);


      if(empty(trim($name))){
        return error422("Enter your name");

      }elseif (empty(trim($email))){
        return error422("Enter your email");

      }elseif (empty(trim($phone))){
        return error422("Enter your phone");

      } else{


    $query="INSERT INTO customer (name,email,phone) VALUES ('$name','$email','$phone' )";
    $result= mysqli_query($conn,$query);


    if($result){

                $data=[
                    'status' => 201,
                    'message' => "Customer Inserted"
                ];

                header("HTTP/1.0 201  Customer Inserted");
                return json_encode($data);
    }else{
            
        $data=[

            'status'=>500,
            'message'=>'Internal Server Error',
        ];
    
        header("HTTP/1.0 500 Internal Server Error");
    
        return json_encode($data); 
    }

      }
            


}


function getCustomerList(){

    global $conn;   

    $query="SELECT * FROM customer";
    $query_run= mysqli_query($conn,$query);


    if($query_run){

          if(mysqli_num_rows($query_run)>0){

             $res=mysqli_fetch_all($query_run, MYSQLI_ASSOC);

             $data=[
                'data'=> $res
            ];
        
            header("HTTP/1.0 200 Successfuly");
        
            return json_encode($data);



                           

          }else{

            $data=[

                'status'=>404,
                'message'=>'No Customer Found',
            ];
        
            header("HTTP/1.0 404 No Customer Found");
        
            return json_encode($data);
          }



    }else{
        $data=[

            'status'=>500,
            'message'=>'Internal Server Error',
        ];
    
        header("HTTP/1.0 500 Internal Server Error");
    
        return json_encode($data);    
    }


}


function updateCustomer($customerInput,$params){
 
    global $conn;    

      if(isset($params['id'])){
        return error422("customer id not found in URL");
      }else{
        return error422("Enter the customer id");
      }

     
       $customerId= mysqli_real-escape_string($conn,$params["id"]); 


     $name=mysqli_real_escape_string($conn,$customerInput['name']);
     $email=mysqli_real_escape_string($conn,$customerInput['email']);
     $phone=mysqli_real_escape_string($conn,$customerInput['phone']);


     if(empty(trim($name))){
       return error422("Enter your name");

     }elseif (empty(trim($email))){
       return error422("Enter your email");

     }elseif (empty(trim($phone))){
       return error422("Enter your phone");

     } else{


   $query="UPDATE customer SET name='$name', email='$email', phone='$phone' WHERE id='$customerId'  LIMIT 1 ";
   $result= mysqli_query($conn,$query);


   if($result){

               $data=[
                   'status' => 200,
                   'message' => "Customer Updated"
               ];

               header("HTTP/1.0 200  Customer Updated");
               return json_encode($data);
   }else{
           
       $data=[

           'status'=>500,
           'message'=>'Internal Server Error',
       ];
   
       header("HTTP/1.0 500 Internal Server Error");
   
       return json_encode($data); 
   }

     }
           


}


function deleteCustomer($customerParams){

    global $conn;

    
    if(isset($params['id'])){
        return error422("customer id not found in URL");
      }else{
        return error422("Enter the customer id");
      }

      $customerId= mysqli_real-escape_string($conn,$params["id"]); 

      $query="DELETE FROM customer WHERE id='$customerId' LIMIT 1";

      $result=mysqli_query($conn,$query);

      if($result){

           
        $data=[

            'status'=>200,
            'message'=>'Customer Deleted',
        ];
    
        header("HTTP/1.0 200 Customer deleted");
    
        return json_encode($data); 


      }else{
        
        $data=[

            'status'=>404,
            'message'=>'Customer not Found',
        ];
    
        header("HTTP/1.0 404 Customer not Found");
    
        return json_encode($data); 



      }


}

 

?>
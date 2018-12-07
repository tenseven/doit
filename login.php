<?php
header('Content-Type: application/json');
 $con=mysqli_connect('localhost','root','','monday');
 if (!$con){
  /*$con_=[
      'errcode'=>0,
      'errmsg'=>'',
      'data'=>'connection fali'
  ];
  echo json_encode($con_);*/
  
  

}else{
    
   /* $con__=[
        'errcode'=>233,
        'errmsg'=>'connection succeed',
        'data'=>''
    ];
    echo json_encode($con__);*/
    
    
    
    
}
$select_sql = "SELECT * FROM as1 WHERE name='$_POST[username]'";

 $userinfo=mysqli_query($con,$select_sql);
$userarray=mysqli_fetch_array($userinfo);
 
 $times=$userarray[4];
 $datetime=$userarray[3];
 $nowtime=date("Y/m/d")."  ".date("h:i:sa");



if($_POST["username"]==$userarray[1]){
if($_POST["password"]==$userarray[2]){
    $response=[
        'errcode'=> 0,
        'errmsg'=> 'password is right',
        'data'=>[ 'number_of_times'=> $times,
        'last_login_time'=> $datetime
        ]
    ];
     echo json_encode($response);
     
     $newtimes=$times+1;
     mysqli_query($con,"UPDATE as1 SET times='$newtimes' WHERE name='$_POST[username]'");
     mysqli_query($con,"UPDATE as1 SET datetime = '$nowtime' WHERE name='$_POST[username]'");

}else{
    $response_=[
        'errcode'=>233,
        'errmsg'=>'password is wrong',
        'data'=>''
    ];
    echo json_encode($response_);

}
}else{
    $response_rename=[
        'errcode'=>122,
        'errmsg'=>'The name dose not exist.Please try another' ,
        'data'=>''
    ];
    echo json_encode($response_rename);
}
mysqli_close($con);
?>




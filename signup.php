<?php
header('Content-Type: application/json');
$con=mysqli_connect('localhost','root','','monday');
if(!$con){
    //echo("fail");
    
}else{
   // echo("Connection is good");
}

$username=$_POST['username'];
$array=mysqli_query($con,"SELECT name FROM as1 ");

$sql=mysqli_query($con,"SELECT name FROM as1 WHERE name='$username'");




$infoarray=mysqli_fetch_array($sql);
//echo "\n";
//var_dump($d);
$password_length=strlen($_POST["password"]);
//echo"\n";
$nowtime=date("Y/m/d h:i:sa");

if($infoarray==NULL){
    if($_POST["password"]==$_POST["checkpwd"]){
        if($password_length>=6){
            $en=$con->prepare("INSERT INTO as1 (name,password,datetime,times) VALUES (?,?,now(),?)");
            $en->bind_param("sss",$name,$password,$times);
            $name=$username;
            $password=$_POST["password"];
            
            $times=1;
            $en->execute();
            $mention=[
                'errcode'=>0,
                'errmsg'=>'',
                'data'=>'succeed!' 
            ];
            
    echo json_encode($mention);
        }else{
           // echo "The password is too short.";
        }
    }else{
        //echo "Two passwords are different.";
    }

}else{
    $errname=[
        'errcode'=>122,
        'errmsg'=>'Please change another name.',
        'data'=>''
    ];
    
echo json_encode($errname);
}

/*if($_POST["password"]!=$_POST["checkpwd"])
    err_respond("Your two passwords are different.Please check it");
else if($d!=NULL){
    
    //echo "\n";
    //echo "Sorry,your inputname has been used.Please change another.";
}else{
    if(strlen($_POST["password"]) >=6){
        //echo "\n";
        $t=date("Y/m/d").date("h:i:sa");
        //echo $t;
        //echo "\n";
        mysqli_query($con,"INSERT INTO as1 (name,password,datetime,times) VALUES ('$_POST[username]','$_POST[password]','$t',1)");
        //echo "Successfully.";
    }else {
        //echo "\n";
        //echo "Your password is too short.";
    }      
}*/
//echo "\n";


//echo "\n";


mysqli_close($con);
?>

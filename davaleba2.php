<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="meoredavaleba.css">
    <title>Document</title>
</head>
<body>
<?php
$manipulation=0;
$follower_manipulation=0;

if(isset($_POST['submit']))
{
    if(empty($_POST['name']))
    {
       $eror="<h1 style ='color:red'>* საძიებო ველი ცარიელია</h1>";
       echo $eror;
    }else{
        $name=$_POST['name'];
        $manipulation=1;
    }
}
//იუზერის ძებნა გამოტანა
$headers=[
    'User-Agent: Generate new token',
    'Authorization: token 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'
];
if($manipulation==1)
{
$ch =curl_init("https://api.github.com/users/$name");
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$responce=curl_exec($ch);
curl_close($ch);
$data=json_decode($responce,true);
    $imge= $data["avatar_url"];
    $saxeli=$data['name'];
    $followers=$data['followers'];
    $user=$data['login'];
    //თუ ფოლოვერები მეტია 0 ზე ფოლოვერები გამოიტანოს,თუ არა  ერორი გამომიტანოს
    if($followers > 0){
        $follower_manipulation=1;
    }
    else{
        $follower_manipulation=2;
    }
}

?>


<form class="forms" action="davaleba2.php" method="post" enctype="multipart/form-data">
<input  class="Name_Control" type="text" name="name" placeholder="შეიყვანეთ საძიებო  სახელი"><br>
<input class="submit" type="submit" name="submit" value="ძებნა">
</form>
<?php
//იუზერის ინფორმაცია
 if($manipulation==1)
 {
    
    
    $info=
    "<div class='first_repo'>
    <img class='img' src='$imge' alt=''>
     <h4>სახელი : $saxeli </h4>
     <h4>იუზერ-ნეიმი : $user </h4>
    <h4>ფოლოვერები : $followers</h4>
    </div>
     <div class='folo'><h2 style='margin-right: 5%;'>ფოლოვერები</h2></div>
    ";

    echo $info;
 }
  //ფოლოვერების ინფორმაციის გამოტანა
  if($follower_manipulation==1)
  {
    $ch =curl_init("https://api.github.com/users/$name/followers");
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
   $responce=curl_exec($ch);
   curl_close($ch);
   $data=json_decode($responce,true);
    foreach($data as $repositori)
    {  
        $suraTi= $repositori['avatar_url'];
        $id=  $repositori['id'];
        $login=  $repositori['login'];
        $element = "
         
        <div style='display: flex; justify-content: space-around'>
        <img style='height:50px ; width:50px' src='$suraTi' alt=''>
        <p>აიდი : $id</p>
        <p>იუზერ-ნეიმი : $login</p>
        </div>
        ";'<br>';
        echo $element;
    }
}
if( $follower_manipulation==2){
    $no_follovers= "<div class='folo'><p style='margin-right: 5%;'>იუზერს არ ყავს ფოლოვერები</p></div>";
    echo $no_follovers;
}
//თუ არასწორ იუზერს შევიყვან ერორ მესიჯი ვერ გამოვიტანე ჯერჯერობით (((
?>
<style>
</style>
</body>
</html>
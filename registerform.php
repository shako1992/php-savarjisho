<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="davaleba1.css">
</head>
<body>
<?php
//ფორმის ველის ინფორმაციის ატვირთვა
//შემოწმება გამოტანა
$check="/^[a-zA-Z-' ]*$/";
$name=$surname='';
$nameerr=$surnameerr='';
if(isset($_POST['submit']))
{
    if (!preg_match($check,$_POST['name'])) 
    {
        $nameerr = "*👎 შეიყვანეთ მხოლოდ ლათინური დიდი ან პატარა ასოები";
    }
      if (!preg_match($check,$_POST['name1'])) 
    {
        $surnameerr = "*👎 შეიყვანეთ მხოლოდ ლათინური დიდი ან პატარა ასოები";
    }
    if(empty($_POST['name']))
    {
        $nameerr='*👎 გთხოვთ შეიყვანოთ სახელი';
    }
    if(empty($_POST['name1']))
    {
        $surnameerr='*👎 გთხოვთ შეიყვანოთ გვარი';
    }
    if (preg_match($check,$_POST['name']))
    {
        if(!empty($_POST['name'])){
            $nameerr='👍';
        }
    }
    if (preg_match($check,$_POST['name1']))
    {
        if(!empty($_POST['name1'])){
            $surnameerr='👍';
        }
    }
    $name = $_POST['name'];
    $surname = $_POST['name1'];
}
 ?><br>
<div class="result">
<form class="forma" action="registerform.php" method="post" enctype="multipart/form-data">
 <input type="text" name="name" placeholder="სახელი"><br>
 <input style="margin-top: 15px;" type="text" name="name1" placeholder="გვარი"> <br>
 <input type="file" name="img-upload"><br><br>
 <input style="background-color: green;" type="submit" name="submit" value="send">
</form>
     <div class="eror">
     <p ><?php echo $nameerr ?></p>
     <p ><?php echo $surnameerr ?></p>
     </div>
</div>  
 <?php 
 //სურათის ატვირთვა გამოტანა
 if(isset($_POST['submit']))
 {
    $img_name=$_FILES['img-upload']['name'];
    $tmp_img_name=$_FILES['img-upload']['tmp_name'];
    $uploads="uploads/";
    move_uploaded_file($tmp_img_name,$uploads.$img_name);
    echo "<img class='img' src='$uploads./$img_name'/>";
 }
 
 ?>
 <p class="suname"><?php echo $name." ".$surname ?></p>
     

</body>
</html>
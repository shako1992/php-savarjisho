<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $headers=[
        'User-Agent: Generate new token',
        'Authorization: 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'
    ];
         $ch =curl_init("https://ghibliapi.herokuapp.com/films");
         curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         $responce=curl_exec($ch);
         curl_close($ch);
         $data=json_decode($responce,true);
    ?>
    <?php foreach($data as $anime) :?>
        <?php
        $actor=$anime['title'];
        $name=$anime['original_title'];
        $house=$anime['director'];
        $image=$anime['image'];
        $date_of_birth=$anime['description'];
        $pdo=new PDO('mysql:host=localhost;dbname=baza','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $statement= $pdo->prepare("INSERT INTO `baza`(actor,name,house,image,date_of_birth)  
                                   VALUES(:actor,:name,:house,:image,:date_of_birth)");
        $statement->bindValue(':actor',"$actor");
        $statement->bindValue(':name',"$name");
        $statement->bindValue(':house',"$house");
        $statement->bindValue(':image',"$image");
        $statement->bindValue(':date_of_birth',"$date_of_birth");
        $statement->execute();
        header('Location: ./davaleba3.php');
        ?>
        <?php endforeach ?>
</body>
</html>
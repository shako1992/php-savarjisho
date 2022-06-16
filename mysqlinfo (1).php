<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
 
    <?php
    $pdo=new PDO('mysql:host=localhost;dbname=baza','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $statement=$pdo->prepare('SELECT * FROM `baza`');
    
    $search= $_GET['search'] ?? null;
    if($search){
        $statement=$pdo->prepare('SELECT * FROM `baza` WHERE name like :keyword');
        $statement->bindValue(":keyword","%$search%");

    }  
    $statement->execute();
    $products=$statement->fetchAll(PDO::FETCH_ASSOC); 
    if(empty($products)){
        header('Location: api.php');
    }
    ?>
    <?php if(!empty($products)):?>
        <p class="text-3xl bg-pink-800 text-center border-b-4">The best anime films in the world</p>
        <form action="" method="GET">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
    <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="search" name="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search anime" required>
        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
       <div class="bg-pink-800 grid grid-cols-2 ">
       <tbody>
           
        <?php foreach ($products as  $product):?>
             <div class="grid-flow-col cursor-pointer border-slate-900 border-b p-10">
                 <td><?php ?></td>
                 <h1 class=" text-3xl text-yellow-400"><?php echo  $product['name'] ?></h1>
                 <?php

                 ?>
                 <div class="flex">
                 <div>
                 <img class="  shadow-2xl h-72 w-64" src="<?php echo $product['image'] ?>" alt="">
                 </div>
                 <div class="bg-slate-900 text-white ml-1">
                 <h1 class="text-2xl  w-96  "><?php echo $product['actor'] ?></h1>
                 <h1 class="flex text-2xl border w-96  "><p class="text-green-900 text-lg mt-1 text-cente">director-</p><?php echo  $product['house'] ?></h1>
                 <p class="text-green-900">description
                 <h1 class="first-line:uppercase first-line:tracking-widest
                            first-letter:text-7xl first-letter:font-bold first-letter:text-white
                            first-letter:mr-3 first-letter:float-left w-96 text-cente"><?php echo $product['date_of_birth'] ?></h1>
                 </p>
                 </div>
                 </div>
                 <?php
                 ?>
        </div>
            <?php endforeach ?>
    </tbody>
       </div>
        <?php endif ?>
   
    
</body>
</html>
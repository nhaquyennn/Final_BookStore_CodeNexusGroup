<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog e-commerce</title>
</head>

<body>
  <h1>
    <?php  
    spl_autoload_register(function($class_name){
      include 'system/libs/'.$class_name.'.php';
    });

    include 'app/config/config.php';
    $main = new Main();
    
    ?>
  </h1>
</body>

</html>
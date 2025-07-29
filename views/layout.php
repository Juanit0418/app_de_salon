<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
$auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App Salon</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
  
  <?php if(!$auth){ ?>
    <div class="contenedor_app">
      <div class="imagen"></div> <!-- imagen -->
      <div class="app">
        <?php echo $contenido; ?>
      </div> <!-- app -->
    </div> <!-- contenedor_app -->
<?php } else { ?>
      <div class="app">
        <?php echo $contenido; ?>
      </div> <!-- app -->
  <?php }; ?>


  <?php echo $script ?? "" ?>
</body>
</html>
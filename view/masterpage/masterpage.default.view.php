<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <title>Proyecto Autolavado</title>
</head>

<body class="bg-blue-400/30">


  <div><?php echo $view_content; ?></div>
</body>
<style>
  body {
    overflow: hidden;
    user-select: none;
  }
  #completado li {
    opacity: 0.5;
  }
</style>

</html>
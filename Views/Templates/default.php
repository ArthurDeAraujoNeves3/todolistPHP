<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL;?>Assets/css/style.css">
    <!-- Load CSS -->
    <?php if(isset($viewData['CSS'])){echo $viewData['CSS'];}; ?>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <!-- load content -->
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>        
    </div>
        <!-- load JavaScript -->
    <?php if (isset($viewData['JS'])) {
        echo $viewData['JS'];
    }; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
    <?php 
        require_once '../vendor/autoload.php';
        require_once "../controllers/MainController.php";
        require_once "../controllers/StarkController.php";
        require_once "../controllers/StarkImageController.php";
        require_once "../controllers/StarkInfoController.php";
        require_once "../controllers/Controller404.php";
        require_once "../controllers/TargaryenController.php";
        require_once "../controllers/TargaryenInfoController.php";
        require_once "../controllers/TargaryenImageController.php";

        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $twig = new \Twig\Environment($loader, [
            "debug" => true 
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $url = $_SERVER["REQUEST_URI"];

        $controller = new Controller404($twig);

        $pdo = new PDO("mysql:host=localhost;dbname=game_of_thrones_families;charset=utf8", "root", "");
                
        if ($url == "/") {
            $controller = new MainController($twig);
        } elseif (preg_match("#/stark#", $url)) {
            $controller = new StarkController($twig); 

            if (preg_match("#/stark/image#", $url)) {
                $controller = new StarkImageController($twig);
            } else if (preg_match("#/stark/info#", $url)) {
                $controller = new StarkInfoController($twig);
            }

        } elseif (preg_match("#/targaryen#", $url)) {
            $controller = new TargaryenController($twig);
    
                if (preg_match("#/targaryen/info#", $url)) {
                    $controller = new TargaryenInfoController($twig);
                } else if (preg_match("#/targaryen/image#", $url)) {
                    $controller = new TargaryenImageController($twig);
                }
        }
           
        if ($controller) {
            $controller->setPDO($pdo);
            $controller->get();
        }

     ?>
</body>
</html>
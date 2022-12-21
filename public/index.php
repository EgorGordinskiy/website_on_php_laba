<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://outer.tealeaf.su/assets/3rdparty/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
    <?php 
        require_once '../vendor/autoload.php';
        require_once "../framework/autoload.php";
        require_once "../controllers/MainController.php";
        require_once "../controllers/SearchController.php";
        require_once "../controllers/Controller404.php";
        require_once "../controllers/ObjectController.php";
        require_once "../controllers/BaseGotTwigController.php";
        require_once "../controllers/ObjectCreateController.php";
        require_once "../controllers/TypeCreateController.php";
        require_once "../controllers/ObjectDeleteController.php";
        require_once "../controllers/ObjectUpdateController.php";
        require_once "../middlewares/LoginRequiredMiddlewares.php";




        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $twig = new \Twig\Environment($loader, [
            "debug" => true 
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $pdo = new PDO("mysql:host=localhost;dbname=game_of_thrones_families;charset=utf8", "root", "");
    
        $router = new Router($twig, $pdo);

        $router->add("/", MainController::class);
        $router->add("/object/(?P<id>.*)", ObjectController::class); 
        $router->add("/search", SearchController::class);
        $router->add("/create", ObjectCreateController::class)
                ->middleware(new LoginRequiredMiddeware());
        $router->add("/type/create", TypeCreateController::class)
                ->middleware(new LoginRequiredMiddeware());
        $router->add("/(?P<id>\d+)/delete", ObjectDeleteController::class)
                ->middleware(new LoginRequiredMiddeware());
        $router->add("/(?P<id>\d+)/edit", ObjectUpdateController::class)
                ->middleware(new LoginRequiredMiddeware());
        
        $router->get_or_default(Controller404::class);
     ?>
</body>
</html>
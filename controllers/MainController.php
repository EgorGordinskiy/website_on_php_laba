<?php
require_once "BaseGotTwigController.php";

class MainController extends BaseGotTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM families WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM families");
        }
        
        
        
        $context['families'] = $query->fetchAll();

        return $context;
    }
}
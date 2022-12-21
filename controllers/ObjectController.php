<?php
 require_once "BaseGotTwigController.php";

class ObjectController extends BaseGotTwigController {

    public $template = "__object.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['id'] = $this->params['id'];
        $query = $this->pdo->prepare("SELECT description FROM families WHERE id = :my_id"); 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); 
        $context['description'] = $query->fetch();;

        if (isset($_GET['info'])) {
            $context["image"] = "";
            $query = $this->pdo->prepare("SELECT info FROM families WHERE id = :my_id");
            $query->bindValue("my_id", $this->params['id']);
            $query->execute();
            $context["info"] = $query->fetch();
        } else if (isset($_GET['image'])) {
            $context["info"] ="";
            $query = $this->pdo->prepare("SELECT image FROM families WHERE id = :my_id");
            $query->bindValue("my_id", $this->params['id']);
            $query->execute();
            $context["image"] = $query->fetch();
        } else {
            $query = $this->pdo->query("SELECT * FROM families");
        }
       
        $query = $this->pdo->prepare("SELECT * FROM families");
        $context['got-objects'] = $query->fetchAll();

        return $context;
    }
}
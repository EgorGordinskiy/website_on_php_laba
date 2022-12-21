<?php
require_once "BaseGotTwigController.php";

class SearchController extends BaseGotTwigController {
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $text = isset($_GET['text']) ? $_GET['text'] : '';
        
        if ($type == "") {
            $sql = <<<EOL
SELECT id, title
FROM families
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    AND (:text = '' OR info like CONCAT('%', :text, '%'))
EOL;
        } else {
            $sql = <<<EOL
SELECT id, title
FROM families
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    AND (type = :type)
    AND (:text = '' OR info like CONCAT('%', :text, '%'))
EOL;
        }

        

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("text", $text);
        $query->execute();
        $context["objs"] = $query->fetchAll();

        return $context;
    }
}
<?php
 

class BaseGotTwigController extends TwigBaseController {

    public function getContext(): array
    {
        $context = parent::getContext();
    
        // $query = $this->pdo->query("SELECT DISTINCT type FROM families ORDER BY 1");
        $query = $this->pdo->query("SELECT DISTINCT type FROM type_families ORDER BY 1");
        $types = $query->fetchAll();
        $context["types"] = $types;
        
        return $context;
    }
}
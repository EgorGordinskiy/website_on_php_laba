<?php
require_once "TwigBaseController.php";

class TargaryenInfoController extends TargaryenController {
    public $template = "targaryen_info.twig";
    

    public function getContext(): array
    {
        $context = parent::getContext();
        
        
        return $context;
    }
}
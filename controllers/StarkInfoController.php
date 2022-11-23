<?php
require_once "TwigBaseController.php";

class StarkInfoController extends StarkController {
    public $template = "stark_info.twig";
    

    public function getContext(): array
    {
        $context = parent::getContext();
        
        
        return $context;
    }
}
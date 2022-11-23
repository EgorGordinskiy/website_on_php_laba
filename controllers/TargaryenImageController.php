<?php
require_once "TwigBaseController.php";

class TargaryenImageController extends TargaryenController {
    public $template = "base_image.twig";
    

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image'] = "/images/targaryen.jpg";
        
        return $context;
    }
}
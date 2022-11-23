<?php
require_once "TwigBaseController.php";

class StarkImageController extends StarkController {
    public $template = "base_image.twig";
    

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image'] = "/images/stark.jpg";
        
        return $context;
    }
}
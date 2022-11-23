<?php
require_once "TwigBaseController.php";

class TargaryenController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Таргариены";
    public $submenu =  [
            [
                "title" => "Герб",
                "url" => "/targaryen/image",
            ],
            [
                "title" => "Описание",
                "url" => "/targaryen/info",
            ]
            ];

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['submenu'] = $this->submenu;
        
        return $context;
    }
}
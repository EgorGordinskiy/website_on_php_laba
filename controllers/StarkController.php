<?php
require_once "TwigBaseController.php";

class StarkController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Старки";
    public $submenu =  [
            [
                "title" => "Герб",
                "url" => "/stark/image",
            ],
            [
                "title" => "Описание",
                "url" => "/stark/info",
            ]
            ];

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['submenu'] = $this->submenu;
        
        return $context;
    }
}
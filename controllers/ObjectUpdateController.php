<?php
class ObjectUpdateController extends BaseGotTwigController
{
    public $template = "object_create.twig";

   
    public function get(array $context) 
    {
        $id = $this->params['id'];

   $sql = <<<EOL
    SELECT * FROM space_objects WHERE id = :id
    EOL;
    $query = $this->pdo->prepare($sql);
    $query = $this->pdo->prepare("SELECT * FROM families WHERE id = :id");
    $query->bindValue("id", $id);// echo($id);
    $query->execute();

    $data = $query->fetch();
    $context['object'] = $data;
    parent::get($context);
    
    }

    public function post(array $context)
    {   
        $type = $_POST['type'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $info = $_POST['info'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        if ($name!='')
        {
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }
        else
        {
            $image_url = $_POST['image'];
        }
        $sql = <<<EOL
        UPDATE space_object SET title= :title, image= :image, description:description,type:type, info= :info WHERE id = :id
        EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);

        $context['message'] = 'Вы успешно изменили объект';
        $this->get($context);

    }
}
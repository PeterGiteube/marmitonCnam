<?php

class View {

    private $file;
    private $title;

    public function __construct($action)
    {
        $this->file = "view/" . $action . "View.php";
    }

    public function render($data) {
        $content = $this->renderFile($this->file, $data);

        $template = 'view/template.php';
        $templateData = array('title' => $this->title, 'content' => $content);
        $viewContent = $this->renderFile($template, $templateData);

        echo $viewContent;
    }

    private function renderFile($file, $data) {
        if(file_exists($file)) {
            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        } else {
            throw new Exception("Ficher $file introuvable");
        }
    }
}

?>
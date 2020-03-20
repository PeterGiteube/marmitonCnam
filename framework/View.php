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

        $header = 'view/header.php';
        $headerContent = $this->renderFile($header, []);

        $template = 'view/template.php';
        $templateData = array('title' => $this->title, 'header' => $headerContent, 'content' => $content);

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

    public function isUserLoginIn() {
        if(isset($_SESSION['username'])) {
            return true;
        }

        return false;
    }

    public function isUserAdmin() {
        if($this->isUserLoginIn()) {
            $isAdmin = $_SESSION['admin_role'];

            return $isAdmin;
        }

        return false;
    }
}

?>
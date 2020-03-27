<?php

namespace Framework;

use Model\User;
use Exception;

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
        return isset($_SESSION['user']);
    }

    public function isUserAdmin() {
        if($this->isUserLoginIn()) {
            $user = $_SESSION['user'];
            $role = $user->getRole();

            return $role > 1;
        }

        return false;
    }

    public function getIndex() {
        return Configuration::get('index');
    }
}

?>
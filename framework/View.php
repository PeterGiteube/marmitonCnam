<?php

namespace Framework;

use Exception;

class View {

    private $file;
    private $title;
    private $data;

    /**
     * @var RoleChecker
     */
    private $roleChecker;

    public function __construct($action, $data)
    {
        $this->file = "view/" . $action . "View.php";
        $this->data = $data;
    }

    public function setRoleChecker(RoleChecker $roleChecker) {
        $this->roleChecker = $roleChecker;
    }

    public function render() {
        $content = $this->renderFile($this->file, $this->data);

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
            throw new Exception("Fichier $file introuvable");
        }
    }

    private function hasRole($role) {
        return $this->roleChecker->hasRole($role);
    }

    public function getIndex() {
        return Configuration::get('index');
    }
}

?>
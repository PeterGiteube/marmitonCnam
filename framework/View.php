<?php

namespace Framework;

use Exception;
use Framework\Helper\RoleCheckHelper;
use Framework\Helper\RoutePathHelper;
use Framework\Helper\ViewHelperInterface;
use http\Exception\InvalidArgumentException;

class View
{
    private $file;
    private $title;
    private $data;
    private $statusCode;

    /**
     * @var ViewHelperInterface[];
     */
    private $helpers;

    public function __construct($action, $data)
    {
        $this->file = "view/" . $action . "View.php";
        $this->data = $data;
        $this->statusCode = 200;
    }

    public function setHelpers($helpers) {
        $this->helpers = $helpers;
    }

    public function render() {
        return $this->composeAndRender();
    }


    private function composeAndRender()
    {
        $content = $this->renderFile($this->file, $this->data);

        $header = 'view/header.php';
        $headerContent = $this->renderFile($header, []);

        $template = 'view/template.php';
        
        $footer = 'view/footer.php';
        $footerContent = $this->renderFile($footer, []);

        $templateData = array('title' => $this->title, 'header' => $headerContent, 'content' => $content, 'footer' => $footerContent);

        $viewContent = $this->renderFile($template, $templateData);

        return $viewContent;
    }

    private function renderFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        } else {
            throw new Exception("Fichier $file introuvable");
        }
    }

    public function getIndex()
    {
        return Configuration::get('index');
    }

    /**
     * Magic method used for helper functions.
     *
     * @param $name
     * @param $args
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $args) {
        $helpers = $this->helpers ?: [];

        foreach ($helpers as $helper) {
            $helperFunctionName = $helper->getName();

            if($name == $helperFunctionName) {
                return call_user_func_array($helper->getHelper(), $args);
            }
        }

        throw new Exception("Helper function doesn't exist");
    }
}

?>
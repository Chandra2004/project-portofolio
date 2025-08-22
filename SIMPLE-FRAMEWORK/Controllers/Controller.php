<?php
namespace Controllers;

abstract class Controller {
    protected $views;

    public function __construct() {
        $this->views = __DIR__ . '/../Views/';
    }


    public function View($viewName, $data = []) {
        $viewPath = $this->views . $viewName . '.php';

        if (file_exists($viewPath)) {
            // Ekstrak data agar bisa digunakan sebagai variabel di view
            extract($data);
            require $viewPath;
        } else {
            echo "View '$viewName' tidak ditemukan.";
        }
    }
}
?>
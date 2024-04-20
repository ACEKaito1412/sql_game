<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('partials/header');
        echo view('partials/nav');
        echo view('partials/body');
        echo view('partials/footer');
    }
}

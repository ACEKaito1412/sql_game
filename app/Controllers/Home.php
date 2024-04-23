<?php

namespace App\Controllers;

use PDO;
use Throwable;

class Home extends BaseController
{
    public function index()
    {
        echo view('partials/header');
        echo view('partials/nav');
        echo view('partials/body');
        echo view('partials/footer');
    }

    public function access_data()
    {
        $json_data = file_get_contents(base_url() . 'public/data.json');
        return $this->response->setStatusCode(200)->setJSON($json_data);
    }

    public function test()
    {
        return view('pages/test');
    }
}

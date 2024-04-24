<?php

namespace App\Controllers;

use App\Models\GuestModel;
use App\Models\UserModel;
use PDO;
use Throwable;

class Home extends BaseController
{
    public function index()
    {
        $guest_model = new GuestModel();
        $user_model = new UserModel();

        $guest_result = $guest_model->orderBy('score', 'DESC')->findAll();
        $user_result = $user_model->orderBy('score_high', 'DESC')->findAll();

        $data = [
            'users_data' => $user_result,
            'guest_data' => $guest_result
        ];

        echo view('partials/header');
        echo view('partials/nav');
        echo view('partials/body', $data);
        echo view('partials/footer');
    }

    public function access_data()
    {
        $json_data = file_get_contents(base_url() . 'public/data.json');
        return $this->response->setStatusCode(200)->setJSON($json_data);
    }

    public function save_guest()
    {
        $guest_model = new GuestModel();
        $score = $this->request->getVar('score');
        $time = $this->request->getVar('time');


        $data = [
            'score' => $score,
            'time' => $time
        ];

        $res = $guest_model->insert($data);

        if ($res) {
            return $this->response->setStatusCode(200)->setJSON(['messages' => 'Guest Save']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['messages' => 'Error Occured']);;
        }
    }

    public function test()
    {
        return view('pages/test');
    }
}

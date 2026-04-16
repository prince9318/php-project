<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Config\Database;

class AuthController {
    private $authService;

    public function __construct() {
        $db = (new Database())->connect();
        $this->authService = new AuthService($db);
    }

    public function signup() {
        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode(
            $this->authService->signup(
                $data['name'],
                $data['email'],
                $data['password']
            )
        );
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode(
            $this->authService->login(
                $data['email'],
                $data['password']
            )
        );
    }
}
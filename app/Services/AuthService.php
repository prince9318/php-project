<?php

namespace App\Services;

use App\Models\User;

class AuthService {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function signup($name, $email, $password) {
        if ($this->user->findByEmail($email)) {
            return ["error" => "User already exists"];
        }

        $this->user->create($name, $email, $password);

        return ["message" => "User registered successfully"];
    }

    public function login($email, $password) {
        $user = $this->user->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return ["error" => "Invalid credentials"];
        }

        return [
            "message" => "Login successful",
            "user" => [
                "id" => $user['id'],
                "email" => $user['email']
            ]
        ];
    }
}
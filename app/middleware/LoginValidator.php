<?php

namespace app\middleware;


use app\repository\UserRepository;
use core\http\Request;
use core\Route;

class LoginValidator extends AbstractUserValidator
{
    public function validate(Route $route, Request $request): void
    {
        $body = $request->getBodyJson();
        $this->checkEmpty(['email' => 'Email', 'password' => 'Password'], $body);
        if ($this->errors) {
            return;
        }

        if (!$this->validateEmail($body['email'])) {
            return;
        }

        if (!$this->checkUserExists($body['email'])) {
            $this->errors[] = sprintf('User with \'%s\' email does not exist', $body['email']);
            return;
        }

        if (!$this->checkPassword($body['email'], $body['password'])) {
            return;
        }
    }

    private function checkPassword(string $email,string $password) : bool
    {
        if ($this->userRepository->
            findByEmail($email, $this->encryptService->encryptPassword($password)) === null) {
            $this->errors[] = 'User password does not match';
            return false;
        }
        return true;
    }
}
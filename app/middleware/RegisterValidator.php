<?php

namespace app\middleware;

use app\repository\UserRepository;
use core\http\Request;
use core\Route;

class RegisterValidator extends AbstractUserValidator
{
    public function validate(Route $route, Request $request): void
    {
        $body = $request->getBodyJson();
        $this->checkEmpty(['fullName' => 'Full name', 'password' => 'Password', 'email' => 'Email', 'gender' => 'Gender'], $body);
        if ($this->errors) {
            return;
        }

        if (!$this->validateEmail($body['email'])) {
            $this->errors[] = 'The Email field is not a valid e-mail address';
            return;
        }

        if (!$this->validatePassword($body['password'])) {
            return;
        }

        if (!$this->validateName($body['password'])) {
            return;
        }

        if (!$this->validateGender($body['gender'])) {
            return;
        }

        if (key_exists('phoneNumber', $body) and !$this->validatePhoneNumber($body['phoneNumber'])) {
            return;
        }

        if (key_exists('birthDate', $body) and !$this->validateBirthDate($body['birthDate'])) {
            return;
        }

        if (!$this->checkUserExists($body['email'])) {
            return;
        }

        $this->errors[] = sprintf('User with \'%s\' email already exists', $body['email']);
    }

}
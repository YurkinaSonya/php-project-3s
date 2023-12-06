<?php

namespace app\middleware;

use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class ProfileValidator extends AbstractUserValidator
{

    protected function validate(Route $route, Request $request): void
    {
        $userId = $this->tokenService->getCurrentUserId();
        $user = $this->userRepository->findById($userId);
        $body = $request->getBodyJson();
        $this->checkEmpty(['fullName' => 'Full name', 'email' => 'Email', 'gender' => 'Gender'], $body);
        if ($this->errors) {
            return;
        }
        if (!$this->validateEmail($body['email'])) {
            return;
        }
        if (!$this->validateName($body['fullName'])) {
            return;
        }
        if ($user->getEmail() != $body['email'] and $this->checkUserExists($body['email'])) {
            $this->errors[] = 'User with this Email already exists';
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

    }
}
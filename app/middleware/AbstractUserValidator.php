<?php

namespace app\middleware;

use app\repository\UserRepository;
use app\service\EncryptService;
use app\service\TokenService;
use core\http\Response;
use core\middleware\Validator;
use app\enum\Gender;

abstract class AbstractUserValidator extends Validator
{
    protected UserRepository $userRepository;
    protected TokenService $tokenService;
    protected EncryptService $encryptService;

    /**
     * @param UserRepository $userRepository
     * @param TokenService $tokenService
     * @param EncryptService $encryptService
     */
    public function __construct(UserRepository $userRepository, TokenService $tokenService, EncryptService $encryptService)
    {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->encryptService = $encryptService;
    }


    protected function validateEmail(string $email) :bool
    {
        $regex = '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/i';
        return preg_match($regex, $email);
    }

    protected function validatePassword(string $password) :bool
    {
        if (strlen($password) < 6) {
            $this->errors[] = 'password must have at least 6 symbols';
            return false;
        }
        if (!preg_match('/[\d]/i',$password)) {
            $this->errors[] = 'password mush have at least one digit';
            return false;
        }
        return true;
    }
    protected function validateName(string $name) :bool
    {
        if (strlen($name) < 1) {
            $this->errors[] = 'full name must have at least 1 symbol';
            return false;
        }
        return true;
    }

    protected function validateDate(string $date) :bool
    {
        try {
            $try = new \DateTime($date);
        }
        catch (\Exception $exception) {
            $this->errors[] = 'birth date has incorrect format';
            return false;
        }
        return true;
    }

    protected function validateBirthDate(string $date) : bool
    {
        if($this->validateDate($date)) {
            $dateWithType = new \DateTime($date);
            $currentDate = new \DateTime();
            if ($dateWithType > $currentDate) {
                $this->errors[] = 'you can not be born in the future))))';
                return false;
            }
            return true;
        }
        return false;
    }

    protected function validatePhoneNumber(string $phoneNumber) :bool
    {
        if (preg_match('/^[\d|\-|\+]+$/',$phoneNumber)) {
            $this->errors[] = 'The phone number field is not valid';
            return false;
        }
        return true;
    }

    protected function validateGender(string $gender) :bool
    {
        try {
            Gender::from($gender);
            return true;
        }
        catch (\ValueError $error) {
            $this->errors[] = 'gender has incorrect format';
            return false;
        }
    }

    protected function checkUserExists(string $email) : bool
    {
        return $this->userRepository->findByEmail($email) !== null;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 400);
        $response->addHeader('Content-Type', 'application/json');
        return $response;

    }


}
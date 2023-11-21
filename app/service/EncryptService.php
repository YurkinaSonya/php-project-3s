<?php

namespace app\service;

class EncryptService
{
    private string $salt;

    /**
     * @param string $salt
     */
    public function __construct(string $salt)
    {
        $this->salt = $salt;
    }

    public function encryptPassword(string $password) : string
    {
        return sha1($password . $this->salt);
    }
}
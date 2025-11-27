<?php

namespace Models;

class User
{
    private string $id;
    private string $username;
    private string $hashPwd;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getHashPwd(): string
    {
        return $this->hashPwd;
    }

    public function setHashPwd(string $hashPwd): void
    {
        $this->hashPwd = $hashPwd;
    }
}

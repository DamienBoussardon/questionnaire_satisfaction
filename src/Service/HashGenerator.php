<?php
namespace App\Service;

class HashGenerator
{
    public function getHash()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hash = substr(str_shuffle($permitted_chars), 0, 25);
        return $hash;
    }
}
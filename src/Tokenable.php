<?php

namespace Framework;

trait Tokenable
{
    protected function generateToken()
    {
        return hash('sha512', uniqid().'---'.time());
    }
}

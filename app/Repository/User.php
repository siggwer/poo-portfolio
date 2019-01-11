<?php
namespace App\Repositories;


use DateTime;

class User
{

    private $id,
            $password,
            $email,
            $email_token,
            $rank,
            $connection_at,
            $register_at;

    /**
     * post constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    // SETTERS //

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setEmail_token($email_token)
    {
        $this->email_token = $email_token;
    }

    public function setConnection_at($connection_at)
    {
        $this->connection_at = $this->setDateTime($connection_at);
    }

    public function setRegister_at($register_at)
    {
        $this->register_at = $this->setDateTime($register_at);
    }

    // GETTERS //

    public function id()
    {
        return $this->id;
    }

    public function rank()
    {
        return $this->rank;
    }

    public function password()
    {
        return $this->password;
    }

    public function email()
    {
        return $this->email;
    }

    public function email_token()
    {
        return $this->email_token;
    }

    public function connection_at()
    {
        return $this->connection_at;
    }

    public function register_at()
    {
        return $this->register_at;
    }

    protected function setDateTime($value)
    {
        if (is_string($value)) {
            return DateTime::createFromFormat('Y-m-d H:i:s', $value);
        }
        return $value;
    }
}
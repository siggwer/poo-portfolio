<?php

namespace App\Model;


class Users extends AbstractModel
{
    /**
     * @var
     */
    private $idUser;

    /**
     * @var
     */
    private $pseudo;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $emailToken;
    /**
     * @var
     */
    private $rank;
    /**
     * @var
     */
    private $connexionAt;
    /**
     * @var
     */
    private $registerAt;

    // SETTERS //

    public function setIdUsers($idUser)
    {
        $this->idUser = (int) $idUser;
    }

    /**
     * @param $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param $emailToken
     */
    public function setEmail_token($emailToken)
    {
        $this->emailToken = $emailToken;
    }

    /**
     * @param $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @param $connexionAt
     */
    public function setConnexionAt($connexionAt)
    {
        $this->connexionAt = $this->setDateTime($connexionAt);
    }

    /**
     * @param $registerAt
     */
    public function setRegisterAt($registerAt)
    {
        $this->registerAt = $this->setDateTime($registerAt);
    }

    // GETTERS //

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getEmailToken()
    {
        return $this->emailToken;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @return mixed
     */
    public function getConnexionAt()
    {
        return $this->connexionAt;
    }

    /**
     * @return mixed
     */
    public function getRegisterAt()
    {
        return $this->registerAt;
    }
}
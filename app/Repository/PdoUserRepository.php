<?php
namespace App\Repositories;

use Romss\Database\DatabaseInterface;
use Romss\Database\StatementInterface;

class PdoUserRepository implements UserRepositoriesInterface
{
    /**
     * @var DatabaseInterface
     */
    private $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }


    /**
     * @param User $user
     * @return User
     */
    public function registerUser(User $user): User
    {
        $this->database->request('
            INSERT INTO users (password, email, email_token, register_at, connection_at, rank) 
            VALUES (:password, :email, :emailToken, NOW(), NULL, 1)',[
            ':password' => $user->password(),
            ':email' => $user->email(),
            ':emailToken' => $user->email_token()
            ]);
        $user->setId($this->database->lastId());
        return $user;
    }

    /**
     * @param User $user
     * @return StatementInterface
     */
    public function updateUser(User $user): StatementInterface
    {
        return $this->database->request(
            'UPDATE users
        SET email = :email,
            email_token = :email_token,
            connection_at = :connection_at,
            rank = :rank
        WHERE id = :userId', [
            ':email' => $user->email(),
            ':email_token' => $user->email_token(),
            ':connection_at' => $user->connection_at(),
            ':rank' => $user->rank(),
            ':userId' => $user->id()
        ]);
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email): User
    {
        return new User($this->database->request(
            'SELECT id, password, email, email_token, register_at, connection_at, rank FROM users
        WHERE email = :email',[
            ':email' => $email
        ])->fetch());
    }

    /**
     * @param  $userId
     * @return mixed
     */
    public function getUserById(int $userId)
    {
        return new User($this->database->request(
            'SELECT id, password, email, email_token, register_at, connection_at, rank FROM users
        WHERE id = :userId
        LIMIT 0, 1' ,[
            ':userId' => $userId
        ])->fetch());
    }

    /**
     * @param User $rankAdmin
     * @return mixed
     */
    public function getRank(User $rankAdmin)
    {
        return $this->database->request('
            SELECT * FROM blog.users  WHERE rank = :rankAdmin', [

            ':rankAdmin' => intval($rankAdmin->rank())
        ])->fetchAll();
    }

    /**
     * @return array|mixed|null
     */
    public function allusers()
    {
       return $this->database->request(
           'SELECT * FROM users'
    )->fetchAll();
    }
}

<?php
namespace App\Repositories;


use Romss\Database\StatementInterface;

interface UserRepositoriesInterface
{
    /**
     * @param $user
     * @return User
     */
    public function registerUser(User $user): User;

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email): User;
  
  /**
   * @param int $userId
   *
   * @return mixed
   */
    public function getUserById(int $userId);

    /**
     * @param User $rankAdmin
     * @return mixed
     */
    public function getRank(User $rankAdmin);

    /**
     * @param User $user
     * @return StatementInterface
     */
    public function updateUser(User $user): StatementInterface;

    /**
     * @return mixed
     */
    public function allusers();
}

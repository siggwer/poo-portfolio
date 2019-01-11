<?php

namespace App\Repositories;

use Romss\Database\StatementInterface;

interface CommentRepositoriesInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param int $id
     * @return mixed
     */
    public function getComment(int $id);


    /**
     * @param int $postId
     * @param bool $checkValidated
     * @return array
     */
    public function getCommentById(int $postId, bool $checkValidated): array;

    /**
     * @param $comment
     * @return array
     */
    public function insertComment($comment ): array ;

    /**
     * @param $comment
     * @return StatementInterface
     */
    public function updateComment($comment): StatementInterface;
}

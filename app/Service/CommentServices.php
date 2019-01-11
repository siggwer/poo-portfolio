<?php

namespace App\Services;

use App\Repositories\CommentRepositoriesInterface;

class CommentServices
{
    private $commentRepositories;

    public function __construct(CommentRepositoriesInterface $commentRepositories)
    {
        $this->commentRepositories = $commentRepositories;
    }

    /**
     * @param int $postId
     * @param bool $checkValidated
     * @return array
     */
    public function getCommentId(int $postId, bool $checkValidated):array
    {
        $comment = $this->commentRepositories->getCommentById($postId, $checkValidated);
        return $comment;
    }

    public function getComment(int $id)
    {
        $commentId = $this->commentRepositories->getComment($id);
        return $commentId;
    }

    public function allComments(): array
    {
       $allComments = $this->commentRepositories->all();
       return $allComments;
    }

    public function insertComment($comment ): array
    {
        $comment = $this->commentRepositories->insertComment($comment);
        return $comment;
    }

    public function updateComment($comment)
    {
        $comment = $this->commentRepositories->updateComment($comment);
        return $comment;
    }
}

<?php

namespace App\Services;

use App\Repositories\PostRepositoriesInterface;
use Romss\Database\StatementInterface;

class PostServices
{
    /**
     * @var PostRepositoriesInterface $postRepositories
     */
    private $postRepositories;


    public function __construct(PostRepositoriesInterface $postRepositories)
    {
        $this->postRepositories = $postRepositories;
    }

    public function getPostWithId(int $id)
    {
        $post = $this->postRepositories->getByPostId($id);
        return $post;
    }

    public function allpost(): array
    {
        $allPost = $this->postRepositories->all();
        return $allPost;
    }

    public function updatePost($post): StatementInterface
    {
        $post = $this->postRepositories->updatePost($post);
        return $post;
    }

    /**
     * @param $post
     * @return array
     */
    public function insertPost($post): array
    {
        $post = $this->postRepositories->insertPost($post);
        return $post;
    }

    public function deletePost(int $id){
        $post = $this->postRepositories->deletePost($id);
        return $post;
    }

}

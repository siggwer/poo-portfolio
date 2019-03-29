<?php

//All routes
return [
    'home.index' => [
        'methods' => ['GET', 'POST'],
        'path' => '/',
        'action' => App\Actions\Home\IndexAction::class,
        'middlewares' => []
    ],
    'mention' => [
       'methods' => ['GET'],
       'path' => '/mention',
      'action' => App\Actions\Mention\MentionController::class,
     'middlewares' => []
    ]
    // 'posts.details' => [
    //   'methods' => ['GET'],
    //  'path' => '/posts/{post:[0-9]+}',
    //   'action' => App\Actions\Posts\PostAction::class,
    //   'middlewares' => []
    //],
    // 'comment.add' => [
    //   'methods' => ['POST'],
    //   'path' => '/posts/{post:[0-9]+}',
    //   'action' => App\Actions\Posts\CommentAction::class,
    //   'middlewares' => []
    //],
    //'login.index' => [
    //   'methods' => ['GET', 'POST'],
    //   'path' => '/login',
    //   'action' => App\Actions\Auth\LoginAction::class,
    //   'middlewares' => []
    //],
    // 'contact.index' => [
    //   'methods' => ['GET', 'POST'],
    //   'path' => '/contact',
    //    'action' => App\Actions\Contact\ContactAction::class,
    //   'middlewares' => []
    //],
    //'register.index' => [
    //   'methods' => ['GET','POST'],
    //    'path' => '/register',
    //   'action' => App\Actions\Auth\RegisterAction::class,
    //   'middlewares' => []
    //],
    // 'logout.index' => [
    //   'methods' => ['GET'],
    //   'path' => '/logout',
    //   'action' => App\Actions\Auth\LogoutAction::class,
    //   'middlewares' => []
    //],
    //'verifyToken' =>[
    //   'methods' =>['GET'],
    //   'path' => '/verify/{id:[0-9]+}-{token:[a-z\-0-9]+}',
    //   'action' => App\Actions\Auth\VerifyMailAction::class,
    //   'middlewares' => []
    //],
    //'admin.posts.show' => [
    //   'methods' => ['GET', 'POST'],
    //   'path' => '/panel',
    //   'action' => App\Actions\Admin\AllpostsAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //],
    //'admin.posts.update' => [
    //   'methods' => ['GET', 'POST'],
    //    'path' => '/panel/edit/post/{post:[0-9]+}',
    //   'action' => App\Actions\Admin\UpdatePostAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //],
    //'admin.posts.delete' => [
    //   'methods' => ['GET', 'POST'],
    //    'path' => '/panel/delete/post/{post:[0-9]+}',
    //   'action' => App\Actions\Admin\DeletePostAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //],
    //'admin.posts.create' => [
    //    'methods' => ['GET', 'POST'],
    //   'path' => '/panel/create/post',
    //   'action' => App\Actions\Admin\CreatePostAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //],
    //'admin.comment.validated' => [
    //    'methods' => ['GET', 'POST'],
    //   'path' => '/panel/comment/validated/{post:[0-9]+}',
    //   'action' => App\Actions\Admin\CommentValidatedAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class],
    //],
    //'admin.users.rank' => [
    //   'methods' => ['GET', 'POST'],
    //    'path' => '/panel/users',
    //   'action' => App\Actions\Admin\UsersAction::class,
    //    'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //],
    //'admin.rank' => [
    //    'methods' => ['GET', 'POST'],
    //   'path' => '/panel/users/admin',
    //   'action' => App\Actions\Admin\UsersAdminAction::class,
    //   'middlewares' => [\App\Middlewares\RoleMiddleware::class]
    //]
];

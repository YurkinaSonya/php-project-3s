<?php

use app\controller\AuthorizationController;
use app\controller\CommunityController;
use app\controller\IndexController;
use app\middleware\LoginValidator;
use app\middleware\RegisterValidator;
use app\middleware\TokenMiddleware;
use app\repository\CommunityRepository;
use app\repository\TokenRepository;
use app\repository\UserRepository;
use app\service\EncryptService;
use app\service\TokenService;
use app\repository\SubscribeRepository;
use app\middleware\SubscribeValidator;
use app\middleware\UnsubscribeValidator;
use app\middleware\CommunityValidator;
use app\middleware\ProfileValidator;
use app\repository\AddressRepository;
use app\controller\AddressController;
use app\middleware\AddressSearchValidator;
use app\repository\AdministratorRepository;
use app\repository\TagRepository;
use app\controller\PostController;
use app\repository\PostRepository;
use app\middleware\AddressChainValidator;
use app\repository\LikeRepository;
use app\middleware\PostFilterValidator;
use app\middleware\GetPostValidator;
use app\repository\CommentRepository;
use app\middleware\CommentTreeValidator;
use app\middleware\AddLikeValidator;
use app\middleware\RemoveLikeValidator;
use app\service\AccessService;
use app\middleware\CommentCreateValidator;
use app\middleware\CommentUpdateValidator;
use app\middleware\CommentDeleteValidator;
use app\middleware\CommentPostValidator;

$svc['app.repository.address'] = \core\ServiceContainer::share(static function ($svc) {
    return new AddressRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.admins'] = \core\ServiceContainer::share(static function ($svc) {
    return new AdministratorRepository(
        $svc['core.db.handler']
    );
});


$svc['app.repository.tokens'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenRepository(
        $svc['core.db.handler'],
        $svc['config.token.ttl']
    );
});

$svc['app.repository.users'] = \core\ServiceContainer::share(static function ($svc) {
    return new UserRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.subscribers'] = \core\ServiceContainer::share(static function ($svc) {
    return new SubscribeRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.tags'] = \core\ServiceContainer::share(static function ($svc) {
    return new TagRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.posts'] = \core\ServiceContainer::share(static function ($svc) {
    return new PostRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.likes'] = \core\ServiceContainer::share(static function ($svc) {
    return new LikeRepository(
        $svc['core.db.handler']
    );
});

$svc['app.repository.comments'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentRepository(
        $svc['core.db.handler']
    );
});

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});

$svc['app.controller.address'] = \core\ServiceContainer::share(static function ($svc) {
    return new AddressController(
        $svc['app.repository.address'],
        $svc['core.view.json']
    );
});

$svc['app.controller.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityController(
        $svc['app.repository.communities'],
        $svc['app.repository.users'],
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins'],
        $svc['app.service.tokens'],
        $svc['core.view.json'],
        $svc['config.per_page']
    );
});


$svc['app.controller.authorization'] = \core\ServiceContainer::share(static function ($svc) {
    return new AuthorizationController(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt'],
        $svc['core.view.json']
    );
});

$svc['app.controller.posts'] = \core\ServiceContainer::share(static function ($svc) {
    return new PostController(
        $svc['app.repository.posts'],
        $svc['app.repository.tags'],
        $svc['app.repository.likes'],
        $svc['app.repository.comments'],
        $svc['app.service.tokens'],
        $svc['app.service.access'],
        $svc['core.view.json'],
        $svc['config.per_page']
    );
});

$svc['app.service.tokens'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenService($svc['app.repository.tokens'], $svc['core.http.request']);
});

$svc['app.service.encrypt'] = \core\ServiceContainer::share(static function ($svc) {
    return new EncryptService($svc['config.password.salt']);
});

$svc['app.service.access'] = \core\ServiceContainer::share(static function ($svc) {
    return new AccessService(
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins']
    );
});

$svc['app.middleware.address.search'] = \core\ServiceContainer::share(static function ($svc) {
    return new AddressSearchValidator(
        $svc['app.repository.address']
    );
});

$svc['app.middleware.address.chain'] = \core\ServiceContainer::share(static function ($svc) {
    return new AddressChainValidator(
        $svc['app.repository.address']
    );
});

$svc['app.middleware.register'] = \core\ServiceContainer::share(static function ($svc) {
    return new RegisterValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});

$svc['app.middleware.login'] = \core\ServiceContainer::share(static function ($svc) {
    return new LoginValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});

$svc['app.middleware.token'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenMiddleware(
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.subscribe'] = \core\ServiceContainer::share(static function ($svc) {
    return new SubscribeValidator(
        $svc['app.repository.subscribers'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.unsubscribe'] = \core\ServiceContainer::share(static function ($svc) {
    return new UnsubscribeValidator(
        $svc['app.repository.subscribers'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityValidator(
        $svc['app.repository.communities']
    );
});

$svc['app.middleware.profile'] = \core\ServiceContainer::share(static function ($svc) {
    return new ProfileValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});

$svc['app.middleware.post.filter'] = \core\ServiceContainer::share(static function ($svc) {
    return new PostFilterValidator(
        $svc['app.repository.tags']
    );
});

$svc['app.middleware.post.get'] = \core\ServiceContainer::share(static function ($svc) {
    return new GetPostValidator(
        $svc['app.repository.posts'],
        $svc['app.repository.communities'],
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins'],
        $svc['app.service.tokens'],
        $svc['app.service.access']
    );
});

$svc['app.middleware.post.comment'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentPostValidator(
        $svc['app.repository.posts'],
        $svc['app.repository.communities'],
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins'],
        $svc['app.service.tokens'],
        $svc['app.service.access'],
        $svc['app.repository.comments']
    );
});

$svc['app.middleware.comment.tree'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentTreeValidator(
        $svc['app.repository.comments']
    );
});

$svc['app.middleware.comment.create'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentCreateValidator(
        $svc['app.repository.comments'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.comment.update'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentUpdateValidator(
        $svc['app.repository.comments'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.comment.delete'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommentDeleteValidator(
        $svc['app.repository.comments'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.like.add'] = \core\ServiceContainer::share(static function ($svc) {
    return new AddLikeValidator(
        $svc['app.repository.posts'],
        $svc['app.repository.communities'],
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins'],
        $svc['app.service.tokens'],
        $svc['app.service.access'],
        $svc['app.repository.likes']
    );
});

$svc['app.middleware.like.remove'] = \core\ServiceContainer::share(static function ($svc) {
    return new RemoveLikeValidator(
        $svc['app.repository.posts'],
        $svc['app.repository.communities'],
        $svc['app.repository.subscribers'],
        $svc['app.repository.admins'],
        $svc['app.service.tokens'],
        $svc['app.service.access'],
        $svc['app.repository.likes']
    );
});



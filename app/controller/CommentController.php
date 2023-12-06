<?php

namespace app\controller;

use app\dto\CommentDto;
use app\dto\CreateCommentDto;
use app\dto\UpdateCommentDto;
use app\model\Comment;
use app\repository\CommentRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\Route;
use core\view\JsonView;

class CommentController
{
    private CommentRepository $commentRepository;
    private TokenService $tokenService;
    private JsonView $view;
    private string $deleteMessage;

    /**
     * @param CommentRepository $commentRepository
     * @param TokenService $tokenService
     * @param JsonView $view
     * @param string $deleteMessage
     */
    public function __construct(CommentRepository $commentRepository, TokenService $tokenService, JsonView $view, string $deleteMessage)
    {
        $this->commentRepository = $commentRepository;
        $this->tokenService = $tokenService;
        $this->view = $view;
        $this->deleteMessage = $deleteMessage;
    }


    public function getNestedComments(Route $route, Request $request) : Response
    {
        $children = [];
        $this->generateChildren($route->getParam(0), $children);
        $children = array_filter($children);
        $children = array_values($children);
        $children = array_map(fn($comment) => $this->hydrateCommentDto($comment)->toArray(),$children);
        return $this->view->render($children);
    }

    public function createComment(Route $route, Request $request) : Response
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        $createDto = CreateCommentDto::fromArray($request->getBodyJson());
        $dtoArray = $createDto->toArray();
        $dtoArray['postId'] = $postId;
        $dtoArray['authorId'] = $userId;
        $dtoArray['deleteTime'] = null;
        $dtoArray['modifiedTime'] = null;
        $comment = Comment::fromArray($dtoArray);
        $commentId = $this->commentRepository->createComment($comment);
        return $this->view->render(['id' => $commentId]);
    }

    public function updateComment(Route $route, Request $request) : Response
    {
        $editDto = UpdateCommentDto::fromArray($request->getBodyJson());
        $comment = $this->commentRepository->getComment($route->getParam(0));
        $comment = $comment->outsideUpdateFromDto($editDto);
        $commentId = $this->commentRepository->updateComment($comment);
        return $this->view->render(['id' => $commentId]);
    }

    public function deleteComment(Route $route, Request $request) : Response
    {
        $comment = $this->commentRepository->getComment($route->getParam(0));
        $commentId = $this->commentRepository->deleteComment($comment);
        return $this->view->render(['id' => $commentId]);
    }

    private function generateChildren(string $commentId, array & $allChildren) : void
    {
        $children = $this->commentRepository->getChildren($commentId);
        foreach ($children as $child) {
            $allChildren[] = $child;
            $this->generateChildren($child->getId(), $allChildren);
        }
    }

    private function hydrateCommentDto(Comment $model) : ?CommentDto
    {
        $commentArray = $model->toArray();
        unset($commentArray['postId']);
        unset($commentArray['parentId']);
        $commentArray['subComments'] = $this->commentRepository->getSubCommentsCount($commentArray['id']);
        if($commentArray['deleteTime'] !== null) {
            if ($commentArray['subComments'] === 0) {
                return null;
            }
            $commentArray['authorId'] = '';
            $commentArray['author'] = $this->deleteMessage;
            $commentArray['content'] = $this->deleteMessage;
        }
        return CommentDto::fromArray($commentArray);
    }
}
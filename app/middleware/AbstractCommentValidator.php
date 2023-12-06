<?php

namespace app\middleware;

use app\repository\CommentRepository;
use app\repository\PostRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

abstract class AbstractCommentValidator extends Validator
{
    protected CommentRepository $commentRepository;
    protected TokenService $tokenService;
    protected int $statusCode = 404;

    /**
     * @param CommentRepository $commentRepository
     * @param TokenService $tokenService
     */
    public function __construct(CommentRepository $commentRepository, TokenService $tokenService)
    {
        $this->commentRepository = $commentRepository;
        $this->tokenService = $tokenService;
    }


    protected function checkParentExists(string $parentId) : bool
    {
        if (!$this->checkCommentExists($parentId)) {
            $this->errors[] = sprintf('parent comment with "%s" id does not exist', $parentId);
            $this->statusCode = 404;
            return false;
        }
        if ($this->commentRepository->getComment($parentId)->getDeleteTime() !== null) {
            $this->errors[] = sprintf('parent comment with "%s" id was deleted', $parentId);
            $this->statusCode = 403;
            return false;
        }
        return true;
    }

    protected function checkCommentExists(string $id) : bool
    {
        $comment = $this->commentRepository->getComment($id);
        if ($comment === null ||
            ($comment->getDeleteTime() !== null &&
                $this->commentRepository->getSubCommentsCount($id) === 0)) {
            $this->errors[] = sprintf('comment with "%s" id does not exist', $id);
            return false;
        }
        return true;
    }

    protected function checkContent(string $content) : bool
    {
        $len = strlen($content);
        if ($len === 0 || $len > 1000) {
            $this->errors[] = 'content must contain from 1 to 1000 characters';
            $this->statusCode = 400;
            return false;
        }
        return true;
    }

    protected function checkPermsOnComment(string $commentId) : bool
    {
        $userId = $this->tokenService->getCurrentUserId();
        if ($this->commentRepository->getAuthorId($commentId) !== $userId) {
            $this->errors[] = sprintf('comment with "%s" id does not belong to this user', $commentId);
            $this->statusCode = 403;
            return false;
        }
        return true;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), $this->statusCode);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}
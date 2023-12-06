<?php

namespace app\middleware;

use app\repository\CommentRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class CommentTreeValidator extends Validator
{
    private CommentRepository $commentRepository;
    private int $statusCode = 400;

    /**
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $commentId = $route->getParam(0);
        if (!$this->checkCommentExists($commentId)) {
            return;
        }
        if (!$this->checkIsRoot($commentId)) {
            return;
        }

    }

    private function checkCommentExists(string $id) : bool
    {
        if ($this->commentRepository->getComment($id) === null) {
            $this->errors[] = sprintf('comment with %s id does not exist', $id);
            $this->statusCode = 404;
            return false;
        }
        return true;
    }

    private function checkIsRoot(string $id) : bool
    {
        if ($this->commentRepository->getParent($id) !== null) {
            $this->errors[] = sprintf('comment with %s id is not a root element', $id);
            $this->statusCode = 400;
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
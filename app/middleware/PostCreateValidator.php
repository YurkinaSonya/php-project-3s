<?php

namespace app\middleware;

use app\repository\CommunityRepository;
use app\repository\PostRepository;
use app\repository\TagRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class PostCreateValidator extends Validator
{
    private TagRepository $tagRepository;
    private int $statusCode = 400;

    /**
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $body = $request->getBodyJson();
        $this->checkEmpty(['title' => 'Title', 'description' => 'Description', 'readingTime' => 'Reading Time', 'tags' => 'Tags'], $body);
        if ($this->errors) {
            $this->statusCode = 400;
            return;
        }
        if ($this->checkContent($body['title'], 5, 1000, 'title')) {
            return;
        }
        if ($this->checkContent($body['description'], 5, 5000, 'description')) {
            return;
        }
        if ($body['image'] !== null && $this->checkContent($body['image'], 1, 1000, 'image')) {
            return;
        }
        if (!$this->checkAllTagsExist($body['tags'])) {
            return;
        }

    }

    private function checkAllTagsExist(array $tags) : bool
    {
        foreach ($tags as $tag) {
            if (!$this->checkTagExist($tag)) {
                $this->errors[] = sprintf('tag with "%s" id does not exist', $tag);
                $this->statusCode = 400;
                return false;
            }
        }
        return true;
    }


    private function checkTagExist(string $tagId) : bool
    {
        return $this->tagRepository->getTagById($tagId) !== null;
    }

    private function checkContent(string $content, int $min,  int $max, string $contentName) : bool
    {
        $len = strlen($content);
        if ($len < $min || $len > $max) {
            $this->errors[] = sprintf(
                '%s must contain from %s to %s characters',
                $contentName,
                $min,
                $max
            );
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
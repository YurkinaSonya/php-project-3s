<?php

namespace app\middleware;

use app\repository\TagRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class PostFilterValidator extends Validator
{
    private TagRepository $tagRepository;

    /**
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $terms = [
            'tags' => $request->getQueryParam('tags'),
            'min' => $request->getQueryParam('min'),
            'max' => $request->getQueryParam('max'),
            'sorting' => $request->getQueryParam('sorting')
        ];
        $sortingCases = [
            'CreateDesc' => 'create_time Desc ',
            'CreateAsc' => 'create_time Asc ',
            'LikeDesc' => 'likes Desc ',
            'LikeAsc' => 'likes Asc '
        ];
        if ($terms['tags'] !== null && !$this->checkTagsExist($terms['tags'])) {
            return;
        }
        if ($terms['min'] !== null && !$this->checkIsNumeric($terms['min'])) {
            $this->errors[] = 'min parameter must be numeric';
            return;
        }
        if ($terms['max'] !== null && !$this->checkIsNumeric($terms['max'])) {
            $this->errors[] = 'max parameter must be numeric';
            return;
        }
        if ($terms['sorting'] !== null && !array_key_exists($terms['sorting'], $sortingCases)) {
            $this->errors[] = sprintf('type of sorting "%s" does not exist', $terms['sorting']);
            return;
        }
    }

    private function checkTagsExist(array $tags) : bool
    {
        foreach ($tags as $tag) {
            if (!$this->tagRepository->getTagById($tag)) {
                $this->errors[] = sprintf('tag with %s id does not exist', $tag);
                return false;
            }
        }
        return true;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 400);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}
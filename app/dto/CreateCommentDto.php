<?php

namespace app\dto;

use core\dto\AbstractDto;

class CreateCommentDto extends AbstractDto
{
    protected string $content;
    protected ?string $parentId = null;

    /**
     * @param string $content
     * @param string|null $parentId
     */
    public function __construct(string $content, ?string $parentId)
    {
        $this->content = $content;
        $this->parentId = $parentId;
    }



    protected static function getDtoTypes(): array
    {
        return [];
    }
}
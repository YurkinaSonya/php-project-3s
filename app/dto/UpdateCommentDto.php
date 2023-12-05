<?php

namespace app\dto;

use core\dto\AbstractDto;

class UpdateCommentDto extends AbstractDto
{
    protected string $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }


    protected static function getDtoTypes(): array
    {
        return [];
    }
}
<?php

namespace app\dto;

use core\dto\AbstractDto;

class PageInfoDto extends AbstractDto
{
    protected int $size;
    protected int $count;
    protected int $current;

    /**
     * @param int $size
     * @param int $count
     * @param int $current
     */
    public function __construct(int $size, int $count, int $current)
    {
        $this->size = $size;
        $this->count = $count;
        $this->current = $current;
    }

    protected static function getDtoTypes(): array
    {
        return [];
    }
}
<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class CommentDto extends AbstractDto
{
    protected ?string $id;
    protected DateTimeJsonable $createTime;
    protected string $content;
    protected ?DateTimeJsonable $modifiedTime = null;
    protected ?DateTimeJsonable $deleteTime = null;
    protected string $authorId;
    protected string $author;
    protected ?int $subComments;

    /**
     * @param string|null $id
     * @param DateTimeJsonable $createTime
     * @param string $content
     * @param DateTimeJsonable|null $modifiedTime
     * @param DateTimeJsonable|null $deleteTime
     * @param string $authorId
     * @param string $author
     * @param int|null $subComments
     */
    public function __construct(?string $id, DateTimeJsonable $createTime, string $content, ?DateTimeJsonable $modifiedTime, ?DateTimeJsonable $deleteTime, string $authorId, string $author, ?int $subComments)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->content = $content;
        $this->modifiedTime = $modifiedTime;
        $this->deleteTime = $deleteTime;
        $this->authorId = $authorId;
        $this->author = $author;
        $this->subComments = $subComments;
    }

    public function getSubComments(): ?int
    {
        return $this->subComments;
    }

    public function setSubComments(?int $subComments): void
    {
        $this->subComments = $subComments;
    }




    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class, 'modifiedTime' => DateTimeJsonable::class, 'deleteTime' => DateTimeJsonable::class];
    }
}
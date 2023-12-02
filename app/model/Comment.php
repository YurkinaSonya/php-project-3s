<?php

namespace app\model;

use core\model\AbstractModel;

class Comment extends AbstractModel
{
    protected ?string $id;
    protected string $authorId;
    protected string $author;
    protected string $postId;
    protected ?string $parentId;
    protected string $content;
    protected \DateTime $createTime;
    protected ?\DateTime $modifiedTime = null;
    protected ?\DateTime $deleteTime = null;

    /**
     * @param string|null $id
     * @param string $authorId
     * @param string $author
     * @param string $postId
     * @param string|null $parentId
     * @param string $content
     * @param \DateTime $createTime
     * @param \DateTime|null $modifiedTime
     * @param \DateTime|null $deleteTime
     */
    public function __construct(?string $id, string $authorId, string $author, string $postId, ?string $parentId, string $content, \DateTime $createTime, ?\DateTime $modifiedTime, ?\DateTime $deleteTime)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->author = $author;
        $this->postId = $postId;
        $this->parentId = $parentId;
        $this->content = $content;
        $this->createTime = $createTime;
        $this->modifiedTime = $modifiedTime;
        $this->deleteTime = $deleteTime;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function setAuthorId(string $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function setPostId(string $postId): void
    {
        $this->postId = $postId;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getModifiedTime(): ?\DateTime
    {
        return $this->modifiedTime;
    }

    public function setModifiedTime(?\DateTime $modifiedTime): void
    {
        $this->modifiedTime = $modifiedTime;
    }

    public function getDeleteTime(): ?\DateTime
    {
        return $this->deleteTime;
    }

    public function setDeleteTime(?\DateTime $deleteTime): void
    {
        $this->deleteTime = $deleteTime;
    }

    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'author_id' => 'authorId', 'author' => 'author', 'post_id' => 'postId', 'parent_id' => 'parentId', 'content' => 'content', 'create_time' => 'createTime', 'modification_time' => 'modifiedTime', 'delete_time' => 'deleteTime'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class, 'modification_time' => \DateTime::class, 'delete_time' => \DateTime::class];
    }


    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'create_time';
    }

}
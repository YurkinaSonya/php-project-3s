<?php

namespace gen\src;

class CodeGenerator {

    private array $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function generateAll(): void
    {
        $this->generateDtos();
        $this->generateModels();
        $this->generateSql();
    }

    public function generateModels(): void
    {

    }

    public function generateDtos(): void
    {

    }

    public function generateSql(): void
    {

    }


}

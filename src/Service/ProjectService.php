<?php

namespace App\Service;

class ProjectService
{
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../../config/projects.json';
    }

    public function getProjects(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        return json_decode(file_get_contents($this->filePath), true);
    }
}

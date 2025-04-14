<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class CompanyFileUploader extends FileUploader
{
    public function __construct(string $targetDirectory, SluggerInterface $slugger)
    {
        parent::__construct($targetDirectory, $slugger);
    }
}
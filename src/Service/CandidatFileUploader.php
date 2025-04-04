<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class CandidatFileUploader extends FileUploader
{
    public function __construct(string $targetDirectory, SluggerInterface $slugger)
    {
        parent::__construct($targetDirectory, $slugger);
    }
}
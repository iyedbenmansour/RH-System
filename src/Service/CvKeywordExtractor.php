<?php
// src/Service/CvKeywordExtractor.php

namespace App\Service;

use Smalot\PdfParser\Parser;

class CvKeywordExtractor
{
    public function extractTextFromPdf(string $filePath): ?string
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            return $pdf->getText();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function extractKeywordsFromCV(string $cvContent): array
    {
        $cvContent = mb_strtolower($cvContent);
        $keywords = [
            "full stack", "developer", "javascript", "typescript", "node.js",
            "react", "angular", "vue.js", "python", "java", "spring",
            "docker", "kubernetes", "aws", "azure", "devops",
            "ci/cd", "agile", "scrum", "sql", "nosql",
            "mongodb", "postgresql", "rest api", "microservices"
        ];
        $found = [];
        foreach ($keywords as $keyword) {
            if (mb_stripos($cvContent, $keyword) !== false) {
                $found[] = $keyword;
            }
        }
        return $found;
    }
}
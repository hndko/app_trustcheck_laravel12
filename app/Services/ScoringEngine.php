<?php

namespace App\Services;

class ScoringEngine
{
    /**
     * Calculate Trust Score (0-100) based on weighted factors from PRD.
     *
     * @param array $metrics
     * @return array ['score' => int, 'risk_level' => string]
     */
    public function calculate(array $metrics = []): array
    {
        // Bobot berdasarkan spesifikasi PRD Section 12:
        // Website 10%, Domain 10%, Public Review 25%, News 20%, Company Profile 15%, Digital Presence 10%, AI Confidence 10%
        
        $websiteScore = $metrics['website_score'] ?? 90;
        $domainScore = $metrics['domain_score'] ?? 92;
        $reviewScore = $metrics['review_score'] ?? 88;
        $newsScore = $metrics['news_score'] ?? 90;
        $profileScore = $metrics['profile_score'] ?? 95;
        $digitalScore = $metrics['digital_presence_score'] ?? 89;
        $aiConfidence = $metrics['ai_confidence'] ?? 95;

        $weightedTotal = (
            ($websiteScore * 0.10) +
            ($domainScore * 0.10) +
            ($reviewScore * 0.25) +
            ($newsScore * 0.20) +
            ($profileScore * 0.15) +
            ($digitalScore * 0.10) +
            ($aiConfidence * 0.10)
        );

        $trustScore = (int) round($weightedTotal);
        $trustScore = max(0, min(100, $trustScore)); // Clamp between 0 and 100

        $riskLevel = 'HIGH RISK';
        if ($trustScore >= 80) {
            $riskLevel = 'LOW RISK';
        } elseif ($trustScore >= 60) {
            $riskLevel = 'MEDIUM RISK';
        }

        return [
            'score' => $trustScore,
            'risk_level' => $riskLevel,
            'breakdown' => [
                'review_score' => $reviewScore,
                'news_score' => $newsScore,
                'website_score' => $websiteScore,
                'digital_presence_score' => $digitalScore,
            ]
        ];
    }
}

<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Xkcd\Parser;

use AsyncBot\Plugin\Xkcd\ValueObject\Comic;

final class Json
{
    /**
     * @param array<string,string|int> $jsonData
     */
    public function parse(array $jsonData): Comic
    {
        return new Comic(
            (int) $jsonData['month'],
            $jsonData['num'],
            $this->getLink($jsonData),
            (int) $jsonData['year'],
            $this->getNews($jsonData),
            $jsonData['safe_title'],
            $this->getTranscript($jsonData),
            $jsonData['alt'],
            $jsonData['img'],
            $jsonData['title'],
            (int) $jsonData['day'],
        );
    }

    /**
     * @param array<string,string|int> $jsonData
     */
    private function getLink(array $jsonData): ?string
    {
        if ($jsonData['link'] === '') {
            return null;
        }

        return $jsonData['link'];
    }

    /**
     * @param array<string,string|int> $jsonData
     */
    private function getNews(array $jsonData): ?string
    {
        if ($jsonData['news'] === '') {
            return null;
        }

        return $jsonData['news'];
    }

    /**
     * @param array<string,string|int> $jsonData
     */
    private function getTranscript(array $jsonData): ?string
    {
        if ($jsonData['transcript'] === '') {
            return null;
        }

        return $jsonData['transcript'];
    }
}

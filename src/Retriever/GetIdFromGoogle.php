<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Xkcd\Retriever;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\GoogleSearch\Collection\SearchResults;
use AsyncBot\Plugin\GoogleSearch\Plugin as GoogleSearch;
use function Amp\call;

final class GetIdFromGoogle
{
    private GoogleSearch $googleSearch;

    public function __construct(GoogleSearch $googleSearch)
    {
        $this->googleSearch = $googleSearch;
    }

    /**
     * @return Promise<?int>
     */
    public function retrieve(string $keywords): Promise
    {
        return call(function () use ($keywords) {
            $results = yield $this->googleSearch->search(sprintf('site:xkcd.com %s', $keywords));

            return $this->getFirstComicId($results);
        });
    }

    private function getFirstComicId(SearchResults $searchResults): ?int
    {
        foreach ($searchResults as $searchResult) {
            if (!$this->isComicUrl($searchResult->getUrl())) {
                continue;
            }

            return $this->getId($searchResult->getUrl());
        }

        return null;
    }

    private function isComicUrl(string $url): bool
    {
        return preg_match('~^https?://(m\.)?xkcd\.com/\d+~', $url) === 1;
    }

    private function getId(string $url): ?int
    {
        if (!$this->isComicUrl($url)) {
            return null;
        }

        preg_match('~^https?://(?:m\.)?xkcd\.com/(?P<comicId>\d+)~', $url, $matches);

        return (int) $matches['comicId'];
    }
}

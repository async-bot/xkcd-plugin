<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Xkcd;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Core\Http\Exception\NetworkError;
use AsyncBot\Plugin\GoogleSearch\Plugin as GoogleSearch;
use AsyncBot\Plugin\Xkcd\Parser\Json;
use AsyncBot\Plugin\Xkcd\Retriever\GetIdFromGoogle;
use AsyncBot\Plugin\Xkcd\Validation\JsonSchema\Comic as JsonValidator;
use AsyncBot\Plugin\Xkcd\ValueObject\Comic;
use function Amp\call;

final class Plugin
{
    private Client $httpClient;

    private GoogleSearch $googleSearch;

    public function __construct(Client $httpClient, GoogleSearch $googleSearch)
    {
        $this->httpClient   = $httpClient;
        $this->googleSearch = $googleSearch;
    }

    /**
     * @return Promise<Comic>
     */
    public function getLatest(): Promise
    {
        return call(function () {
            $response = yield $this->httpClient->requestJson('http://xkcd.com/info.0.json', new JsonValidator());

            return (new Json())->parse($response);
        });
    }

    /**
     * @return Promise<?Comic>
     */
    public function getById(int $id): Promise
    {
        return call(function () use ($id) {
            $url = sprintf('https://xkcd.com/%d/info.0.json', $id);

            try {
                $response = yield $this->httpClient->requestJson($url, new JsonValidator());
            } catch (NetworkError $e) {
                return null;
            }

            return (new Json())->parse($response);
        });
    }

    /**
     * @return Promise<?Comic>
     */
    public function findByKeywords(string $keywords): Promise
    {
        return call(function () use ($keywords) {
            $comicId = yield (new GetIdFromGoogle($this->googleSearch))->retrieve($keywords);

            if (!$comicId) {
                return null;
            }

            return $this->getById($comicId);
        });
    }
}

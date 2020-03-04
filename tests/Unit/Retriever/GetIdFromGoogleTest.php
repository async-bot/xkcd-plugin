<?php declare(strict_types=1);

namespace AsyncBot\Plugin\XkcdTest\Unit\Retriever;

use Amp\Http\Client\HttpClientBuilder;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\GoogleSearch\Plugin as GoogleSearchPlugin;
use AsyncBot\Plugin\Xkcd\Retriever\GetIdFromGoogle;
use AsyncBot\Plugin\XkcdTest\Fakes\HttpClient\MockResponseInterceptor;
use PHPUnit\Framework\TestCase;
use function Amp\Promise\wait;

final class GetIdFromGoogleTest extends TestCase
{
    public function retrieveReturnsNullWhenNotComicIsFound(): void
    {
        $httpClient = new Client(
            (new HttpClientBuilder())->intercept(
                new MockResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/ResponseHtml/Google/invalid-no-comic-found.html')),
            )->build(),
        );

        $comicId = wait((new GetIdFromGoogle(new GoogleSearchPlugin($httpClient)))->retrieve('standards'));

        $this->assertNull($comicId);
    }

    public function retrieveReturnsNullWhenIdIsNotInteger(): void
    {
        $httpClient = new Client(
            (new HttpClientBuilder())->intercept(
                new MockResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/ResponseHtml/Google/invalid-not-integer-id.html')),
            )->build(),
        );

        $comicId = wait((new GetIdFromGoogle(new GoogleSearchPlugin($httpClient)))->retrieve('standards'));

        $this->assertNull($comicId);
    }

    public function testRetrieveReturnsComicOnHttpProtocol(): void
    {
        $httpClient = new Client(
            (new HttpClientBuilder())->intercept(
                new MockResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/ResponseHtml/Google/valid-http-protocol.html')),
            )->build(),
        );

        $comicId = wait((new GetIdFromGoogle(new GoogleSearchPlugin($httpClient)))->retrieve('standards'));

        $this->assertSame(927, $comicId);
    }

    public function retrieveReturnsComicOnMobileVersion(): void
    {
        $httpClient = new Client(
            (new HttpClientBuilder())->intercept(
                new MockResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/ResponseHtml/Google/valid-mobile-website.html')),
            )->build(),
        );

        $comicId = wait((new GetIdFromGoogle(new GoogleSearchPlugin($httpClient)))->retrieve('standards'));

        $this->assertSame(927, $comicId);
    }
}

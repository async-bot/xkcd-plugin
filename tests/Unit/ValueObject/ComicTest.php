<?php declare(strict_types=1);

namespace AsyncBot\Plugin\XkcdTest\Unit\ValueObject;

use AsyncBot\Plugin\Xkcd\ValueObject\Comic;
use PHPUnit\Framework\TestCase;

final class ComicTest extends TestCase
{
    private Comic $comicFilled;

    private Comic $comicWithNulls;

    public function setUp(): void
    {
        $this->comicFilled = new Comic(
            3,
            2275,
            'The link',
            2020,
            'The news',
            'Coronavirus Name',
            'The transcript',
            'It\'s important to keep the spider from touching your face.',
            'https://imgs.xkcd.com/comics/coronavirus_name.png',
            'Coronavirus Name',
            2,
        );

        $this->comicWithNulls = new Comic(
            3,
            2275,
            null,
            2020,
            null,
            'Coronavirus Name',
            null,
            'It\'s important to keep the spider from touching your face.',
            'https://imgs.xkcd.com/comics/coronavirus_name.png',
            'Coronavirus Name',
            2,
        );
    }

    public function testGetMonth(): void
    {
        $this->assertSame(3, $this->comicFilled->getMonth());
    }

    public function testGetNumber(): void
    {
        $this->assertSame(2275, $this->comicFilled->getNumber());
    }

    public function testHasLinkReturnsFalseWhenLinkIsNull(): void
    {
        $this->assertFalse($this->comicWithNulls->hasLink());
    }

    public function testHasLinkReturnsTrueWhenLinkIsSet(): void
    {
        $this->assertTrue($this->comicFilled->hasLink());
    }

    public function testGetLinkReturnsNullWhenLinkIsNull(): void
    {
        $this->assertNull($this->comicWithNulls->getLink());
    }

    public function testGetLinkReturnsDataWhenLinkIsSet(): void
    {
        $this->assertSame('The link', $this->comicFilled->getLink());
    }

    public function testGetYear(): void
    {
        $this->assertSame(2020, $this->comicFilled->getYear());
    }

    public function testHasNewsReturnsFalseWhenNewsIsNull(): void
    {
        $this->assertFalse($this->comicWithNulls->hasNews());
    }

    public function testHasNewsReturnsTrueWhenNewsIsSet(): void
    {
        $this->assertTrue($this->comicFilled->hasNews());
    }

    public function testGetNewsReturnsNullWhenNewsIsNull(): void
    {
        $this->assertNull($this->comicWithNulls->getNews());
    }

    public function testGetNewsReturnsDataWhenNewsIsSet(): void
    {
        $this->assertSame('The news', $this->comicFilled->getNews());
    }

    public function testGetSafeTitle(): void
    {
        $this->assertSame('Coronavirus Name', $this->comicFilled->getSafeTitle());
    }

    public function testHasTranscriptReturnsFalseWhenTranscriptIsNull(): void
    {
        $this->assertFalse($this->comicWithNulls->hasTranscript());
    }

    public function testHasTranscriptReturnsTrueWhenTranscriptIsSet(): void
    {
        $this->assertTrue($this->comicFilled->hasTranscript());
    }

    public function testGetTranscriptReturnsNullWhenTranscriptIsNull(): void
    {
        $this->assertNull($this->comicWithNulls->getTranscript());
    }

    public function testGetTranscriptReturnsDataWhenTranscriptIsSet(): void
    {
        $this->assertSame('The transcript', $this->comicFilled->getTranscript());
    }

    public function testGetAltText(): void
    {
        $this->assertSame('It\'s important to keep the spider from touching your face.', $this->comicFilled->getAltText());
    }

    public function testGetImageUrl(): void
    {
        $this->assertSame('https://imgs.xkcd.com/comics/coronavirus_name.png', $this->comicFilled->getImageUrl());
    }

    public function testGetTitle(): void
    {
        $this->assertSame('Coronavirus Name', $this->comicFilled->getTitle());
    }

    public function testGetDay(): void
    {
        $this->assertSame(2, $this->comicFilled->getDay());
    }
}

<?php declare(strict_types=1);

namespace AsyncBot\Plugin\XkcdTest\Unit\Parser;

use AsyncBot\Plugin\Xkcd\Parser\Json;
use PHPUnit\Framework\TestCase;

final class JsonTest extends TestCase
{
    private const FILLED_DATA = [
        'month'      => '3',
        'num'        => 2275,
        'link'       => 'The link',
        'year'       => '2020',
        'news'       => 'The news',
        'safe_title' => 'Coronavirus Name',
        'transcript' => 'The transcript',
        'alt'        => 'It\'s important to keep the spider from touching your face.',
        'img'        => 'https://imgs.xkcd.com/comics/coronavirus_name.png',
        'title'      => 'Coronavirus Name',
        'day'        => '2',
    ];

    private const SPARSE_DATA = [
        'month'      => '3',
        'num'        => 2275,
        'link'       => '',
        'year'       => '2020',
        'news'       => '',
        'safe_title' => 'Coronavirus Name',
        'transcript' => '',
        'alt'        => 'It\'s important to keep the spider from touching your face.',
        'img'        => 'https://imgs.xkcd.com/comics/coronavirus_name.png',
        'title'      => 'Coronavirus Name',
        'day'        => '2',
    ];

    private Json $parser;

    public function setUp(): void
    {
        $this->parser = new Json();
    }

    public function testParseCorrectlyParsesMonth(): void
    {
        $this->assertSame(3, $this->parser->parse(self::FILLED_DATA)->getMonth());
    }

    public function testParseCorrectlyParsesNumber(): void
    {
        $this->assertSame(2275, $this->parser->parse(self::FILLED_DATA)->getNumber());
    }

    public function testParseCorrectlyParsesLinkWhenEmptyString(): void
    {
        $this->assertNull($this->parser->parse(self::SPARSE_DATA)->getLink());
    }

    public function testParseCorrectlyParsesLink(): void
    {
        $this->assertSame('The link', $this->parser->parse(self::FILLED_DATA)->getLink());
    }

    public function testParseCorrectlyParsesYear(): void
    {
        $this->assertSame(2020, $this->parser->parse(self::FILLED_DATA)->getYear());
    }

    public function testParseCorrectlyParsesNewsWhenEmptyString(): void
    {
        $this->assertNull($this->parser->parse(self::SPARSE_DATA)->getNews());
    }

    public function testParseCorrectlyParsesNews(): void
    {
        $this->assertSame('The news', $this->parser->parse(self::FILLED_DATA)->getNews());
    }

    public function testParseSafeTitle(): void
    {
        $this->assertSame('Coronavirus Name', $this->parser->parse(self::FILLED_DATA)->getSafeTitle());
    }

    public function testParseCorrectlyParsesTranscriptWhenEmptyString(): void
    {
        $this->assertNull($this->parser->parse(self::SPARSE_DATA)->getTranscript());
    }

    public function testParseCorrectlyParsesTranscript(): void
    {
        $this->assertSame('The transcript', $this->parser->parse(self::FILLED_DATA)->getTranscript());
    }

    public function testParseCorrectlyParsesAltText(): void
    {
        $this->assertSame('It\'s important to keep the spider from touching your face.', $this->parser->parse(self::FILLED_DATA)->getAltText());
    }

    public function testParseCorrectlyParsesImageUrl(): void
    {
        $this->assertSame('https://imgs.xkcd.com/comics/coronavirus_name.png', $this->parser->parse(self::FILLED_DATA)->getImageUrl());
    }

    public function testParseCorrectlyParsesTitle(): void
    {
        $this->assertSame('Coronavirus Name', $this->parser->parse(self::FILLED_DATA)->getTitle());
    }

    public function testParseCorrectlyParsesDay(): void
    {
        $this->assertSame(2, $this->parser->parse(self::FILLED_DATA)->getDay());
    }
}

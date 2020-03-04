<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Xkcd\ValueObject;

final class Comic
{
    private int $month;

    private int $number;

    private ?string $link;

    private int $year;

    private ?string $news;

    private string $safeTitle;

    private ?string $transcript;

    private string $altText;

    private string $imageUrl;

    private string $title;

    private int $day;

    public function __construct(
        int $month,
        int $number,
        ?string $link,
        int $year,
        ?string $news,
        string $safeTitle,
        ?string $transcript,
        string $altText,
        string $imageUrl,
        string $title,
        int $day
    ) {
        $this->month      = $month;
        $this->number     = $number;
        $this->link       = $link;
        $this->year       = $year;
        $this->news       = $news;
        $this->safeTitle  = $safeTitle;
        $this->transcript = $transcript;
        $this->altText    = $altText;
        $this->imageUrl   = $imageUrl;
        $this->title      = $title;
        $this->day        = $day;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function hasLink(): bool
    {
        return $this->link !== null;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function hasNews(): bool
    {
        return $this->news !== null;
    }

    public function getNews(): ?string
    {
        return $this->news;
    }

    public function getSafeTitle(): string
    {
        return $this->safeTitle;
    }

    public function hasTranscript(): bool
    {
        return $this->transcript !== null;
    }

    public function getTranscript(): ?string
    {
        return $this->transcript;
    }

    public function getAltText(): string
    {
        return $this->altText;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDay(): int
    {
        return $this->day;
    }
}

<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Xkcd\Validation\JsonSchema;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class Comic extends JsonSchema
{
    public function __construct()
    {
        parent::__construct([
            '$id'      => 'AsyncBot/Plugin/Xkcd/comic.json',
            '$schema'  => 'http://json-schema.org/draft-07/schema#',
            'title'    => 'xkcd comic',
            'type'     => 'object',
            'required' => [
                'month',
                'num',
                'link',
                'year',
                'news',
                'safe_title',
                'transcript',
                'alt',
                'img',
                'title',
                'day',
            ],
            'properties' => [
                'month' => [
                    'type' => 'string',
                ],
                'num' => [
                    'type' => 'integer',
                ],
                'link' => [
                    'type' => 'string',
                ],
                'year' => [
                    'type' => 'string',
                ],
                'news' => [
                    'type' => 'string',
                ],
                'safe_title' => [
                    'type' => 'string',
                ],
                'transcript' => [
                    'type' => 'string',
                ],
                'alt' => [
                    'type' => 'string',
                ],
                'img' => [
                    'type' => 'string',
                ],
                'title' => [
                    'type' => 'string',
                ],
                'day' => [
                    'type' => 'string',
                ],
            ],
        ]);
    }
}

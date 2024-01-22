<?php

use Timber\Timber;

class GameList
{
    public function __construct(
        private GameRepository $repository
    ) {
    }

    public static function listGames(): string
    {
        return self::fetchTemplate(
            'list',
            [
                'games' => (new GameRepository())->getAllGames(),
            ]
        );
    }

    private static function fetchTemplate(string $templateName, array $data): string
    {
        return Timber::fetch(
            sprintf(
                '%s../../public/twig/%s.twig',
                plugin_dir_path(__FILE__),
                $templateName
            ),
            $data
        );
    }
}

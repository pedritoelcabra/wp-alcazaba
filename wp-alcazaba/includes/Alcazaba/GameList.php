<?php

use Timber\Timber;

class GameList
{
    public static function createGameForm(): string
    {
        return self::fetchTemplate('create', []);
    }

    public static function listGames(): string
    {
        $users = get_users();

        return self::fetchTemplate(
            'list',
            [
                'games' => (new GameRepository())->getAllGames($users),
                'users' => $users,
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

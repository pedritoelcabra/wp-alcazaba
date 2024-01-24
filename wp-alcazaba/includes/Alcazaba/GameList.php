<?php

use Timber\Timber;

class GameList
{
    public static function createGameForm(): string
    {
        return self::fetchTemplate('create', []);
    }

    public static function ajaxListGames(): void
    {
        $query = $_POST['query'];

        $ch = curl_init();

        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://boardgamegeek.com/search/boardgame?nosession=1&showcount=20&q=" . urlencode($query)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
        ]);

        $data = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($data, true);

        $cleanGameNames = [];
        foreach ($decoded['items'] as $item) {
            $cleanGameNames[] = [
                'id' => $item['id'],
                'label' => sprintf('%s (%s)', $item['name'], $item['yearpublished']),
                'value' => sprintf('%s (%s)', $item['name'], $item['yearpublished']),
                'url' => sprintf('https://boardgamegeek.com%s', $item['href']),
            ];
        }

        wp_send_json($cleanGameNames);
        exit;
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

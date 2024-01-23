<?php

use Timber\Timber;

class GameRepository
{
    private const SYSTEM_USER = 'Sistema';

    private function tableName(): string
    {
        global $wpdb;

        return $wpdb->prefix . "partidas_alcazaba";
    }

    /**
     * @param stdClass[] $users
     *
     * @return Game[]
     */
    public function getAllGames(array $users): array
    {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM {$this->tableName()} WHERE 1");

        $games = [];
        foreach ($results as $result) {
            $creatingUser = array_filter($users, static fn (WP_User $user) => $user->data->ID === $result->created_by);
            $games[] = new Game(
                $result->id,
                DateTime::createFromFormat('Y-m-d H:i:s', $result->created_on),
                $result->created_by,
                $creatingUser[0]?->user_nicename ?? self::SYSTEM_USER,
                DateTime::createFromFormat('Y-m-d H:i:s', $result->start_time),
                $result->name,
            );
        }

        return $games;
    }
}

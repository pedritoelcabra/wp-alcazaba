<?php

use Timber\Timber;

class GameRepository
{
    private function tableName(): string
    {
        global $wpdb;

        return $wpdb->prefix . "partidas_alcazaba";
    }

    /** @return Game[] */
    public function getAllGames(): array
    {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM {$this->tableName()} WHERE 1");

        $games = [];
        foreach ($results as $result) {
            $games[] = new Game(
                $result->id,
                DateTime::createFromFormat('Y-m-d H:i:s', $result->created_on),
                $result->created_by,
                DateTime::createFromFormat('Y-m-d H:i:s', $result->start_time),
                $result->name,
            );
        }

        return $games;
    }
}

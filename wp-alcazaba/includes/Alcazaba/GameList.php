<?php

use Timber\Timber;

class GameList
{
    public static function listGames(): string
    {
        return Timber::fetch( plugin_dir_path( __FILE__ ) . '../../public/twig/list.twig', []);
    }
}

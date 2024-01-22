<?php

class Game
{
    public function __construct(
        public readonly string $id,
        public readonly DateTime $createdOn,
        public readonly int $createdBy,
        public readonly DateTime $startTime,
        public readonly string $name,
    ) {
    }
}

<?php

class Game
{
    public function __construct(
        public readonly string $id,
        public readonly DateTime $createdOn,
        public readonly int $createdBy,
        public readonly string $createdByName,
        public readonly DateTime $startTime,
        public readonly string $name,
    ) {
    }
}

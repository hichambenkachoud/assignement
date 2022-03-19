<?php

namespace App\Domain;

interface ArenaInterface
{
    public function fight(Fighter $fighterA, Fighter $fighterB): ?Fighter;
}
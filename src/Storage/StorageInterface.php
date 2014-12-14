<?php

namespace Leaderboard\Storage;

interface StorageInterface
{

    public function find($key);

    public function findOne($key, $member);

    public function set($key, $member, $name);

    public function increment($key, $member, $value = 1);

    public function decrement($key, $member, $value = 1);

    public function remove($key, $member);
}

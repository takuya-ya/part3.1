<?php

namespace LessonOopPoker;

require_once('Game.php');

$game = new Game('卓也', 2, 'A');
$game->start();

<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\Game;
use BlackJack\GameProcess;
use BlackJack\PointCalculator;

$card = new Card();
$deckInstance = new Deck($card);
$dealer = new Dealer();
$pointCalculator = new PointCalculator();
$gameProcess = new GameProcess($dealer, $deckInstance, $pointCalculator);
$game = new Game($deckInstance, $gameProcess, $dealer, $pointCalculator, ['takuya']);
echo $game->start();

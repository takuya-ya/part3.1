<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Game;
use BlackJack\Dealer;
use BlackJack\GameProcess;
use BlackJack\PointCalculator;

require_once(__DIR__ . '/../../lib/black_jack/Card.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Game.php');
require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
require_once(__DIR__ . '/../../lib/black_jack/GameProcess.php');
require_once(__DIR__ . '/../../lib/black_jack/PointCalculator.php');

class GameTest extends TestCase
{
    public function testStart()
    {
        $card = new Card;
        $deck = new Deck($card);
        $dealer = new Dealer($deck);
        $pointCalculator = new PointCalculator;
        $gameProcess = new GameProcess($dealer, $deck, $pointCalculator);
        $game = new Game($deck, $gameProcess, ['takuya']);

        // スコアが21を超えた場合に、バースト判定の確認
        $deck->cardDeck =['P5', 'P5', 'D10', 'D10', 'P15'];
        $playerHand = $game->start();
        $this->assertSame('あなたの負けです。', $playerHand);

        // 追加のカードを引かない場合の仮実装
        $deck->cardDeck =['P5', 'P5', 'D10', 'D10', 'P11'];
        $playerHand = $game->start();
        $this->assertSame('テスト用出力', $playerHand);

        // 型の確認
        // $this->assertSame('array', gettype($playerHand));

        // $card->cards =['H8', 'D3', 'S10'];
        // // 各プレイヤーの手札枚数の確認
        // $this->assertSame('テスト完了', $playerHand);
    }
}

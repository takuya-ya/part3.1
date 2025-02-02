<?php

namespace BlackJack;

use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\PointCalculator;
use BlackJack\GameProcess;

class Game
{
    public function __construct(
        // 必須引数（Deck $deckなど）はデフォルト値を持つ引数の前に置く必要があります。これに違反すると、エラーになります。
        public Deck $deck,
        public GameProcess $gameProcess,
        public Dealer $dealer,
        public PointCalculator $pointCalculator,
        public array $playerNames,
    ) {
    }

    private const PLAYER_NAME_INDENT = 0;
    private string $yourName;
    public function start(): string
    {
        // 操作プレイヤーの名前を取得
        $this->yourName = $this->playerNames[self::PLAYER_NAME_INDENT];
        // プレイヤー登録
        $player = new Player($this->yourName);

        echo 'ブラックジャックを開始します。' . PHP_EOL;
        echo PHP_EOL;

        // 初回カード取得
        $hands = $this->gameProcess->drawStartHands($this->playerNames);
        // プレイヤーの追加カード取得
        $playerResult = $this->gameProcess->addPlayerCard($hands, $this->yourName, $player);
        if ($playerResult === 'あなたの負けです。') {
            echo "$playerResult" . PHP_EOL;
            return 'ブラックジャックを終了します。' . PHP_EOL;
        }

        // ディーラーのカード追加処理
        $dealerScore = $this->gameProcess->addDealerCard($hands);
        if ($dealerScore === 'あなたの勝ちです。') {
            echo "$dealerScore" . PHP_EOL;
            return 'ブラックジャックを終了します。' . PHP_EOL;
        }

        // 勝敗の判定
        $this->gameProcess->judgeWinner($playerResult, $dealerScore, $player->playerName);
        return 'ブラックジャックを終了します。' . PHP_EOL;
    }
}

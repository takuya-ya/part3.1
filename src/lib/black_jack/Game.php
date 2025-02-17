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
        public Dealer $dealer,
        public Deck $deck,
        public GameProcess $gameProcess,
        public PointCalculator $pointCalculator,
        public PlayerFactory $playerFactory,
        public array $playerNames
    ) {
    }

    const CONTROL_PLAYER_NUMBER = 0;
    public function start(): string
    {
        $yourName = $this->playerNames[self::CONTROL_PLAYER_NUMBER];
        $playerInstances = $this->playerFactory->players;

        echo 'ブラックジャックを開始します。' . PHP_EOL;
        echo PHP_EOL;

        // 初回カード取得
        // プレイヤー達とディーラーの手札の配列
        $hands = $this->gameProcess->setUpHands($playerInstances);

        // プレイヤーの追加カード取得。バーストの場合は文字列の為、変数名をScoreでなくResultに設定
        $playerResult = $this->gameProcess->addYourTurn($hands['playerHands'][$yourName],   $playerInstances[$yourName]);
        if ($this->isGameOrver($playerResult)) {
            return $this->yourLose($playerResult);
        }

        // ディーラーのカード追加処理
        $dealerScore = $this->gameProcess->addDealerCard($hands);

        // バースト判定　バーストであれば、trueを受け取る
        $isBurnOut = $this->gameProcess->checkBurnOut($dealerScore);
        if($isBurnOut) {
             // 現在のスコアを出力
        $this->pokerOutput->displayDealerScore($dealerScore);
        echo PHP_EOL;
        ;
        }
        if ($dealerScore === 'あなたの勝ちです。') {
            echo "$dealerScore" . PHP_EOL;
            return 'ブラックジャックを終了します。' . PHP_EOL;
        }

        // 勝敗の判定
        $this->gameProcess->judgeWinner($playerResult, $dealerScore, $this->playerNames);
        return 'ブラックジャックを終了します。' . PHP_EOL;
        }

        private function isGameOrver(string | int $playerResult): bool
        {
            if($playerResult == 'あなたの負けです。') {
                return true;
            }
            return false;
        }

        private function yourLose(string | int $playerResult): string
        {
            if ($playerResult === 'あなたの負けです。') {
                echo "$playerResult" . PHP_EOL;
                return 'ブラックジャックを終了します。' . PHP_EOL;
            }
        }
}

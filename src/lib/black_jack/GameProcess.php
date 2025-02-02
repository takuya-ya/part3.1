<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Player;
use BlackJack\PointCalculator;


class GameProcess
{
    private const PLAYER_NAME_INDENT = 0;

    public function __construct(
        public Dealer $dealer,
        public Deck $deck,
        public PointCalculator $pointCalculator,
        private $inputHandle = null // テスト時に、ストリームハンドルを代入
    ) {
        $this->inputHandle = $inputHandle ?? STDIN; // nullの場合は標準入力から入力を受ける
    }

    public function drawStartHands(array $playerNames) //: void
    {
        // $player = new Player($playerNames[self::PLAYER_NAME_INDENT]);

        // 山札からカード取得。プレイヤー名をキーとする連想配列を、プレイヤーの人数分作成。
        $playerHands = $this->dealer->dealStartHands($this->deck, $playerNames);
        $dealerHand = $this->dealer->makeDealerHand($this->deck);

        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][0]}です。" . PHP_EOL;
        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][1]}です。" . PHP_EOL;
        echo "ディーラーの引いたカードは{$dealerHand[0]}です。" . PHP_EOL;
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        echo PHP_EOL;

        $hands = ['playerHands' => $playerHands, 'dealerHand' => $dealerHand];
        return $hands;
    }

    private const DRAW_STOP_SCORE = 17;
    public function dealerTurn(array $dealerHand, int $dealerScore): int
    {
        // dealerのカードが規定値以下の場合、カードを取得
        while (self::DRAW_STOP_SCORE >= $dealerScore) {
            // カードを取得、山札から。
            $dealerHand = array_merge($dealerHand, $this->dealer->dealAddCard($this->deck));
            // 引いたカードを出力する為、変数に代入
            $drawnLastCard = end($dealerHand);
            // 手札のスコアを計算して出力
            $dealerScore = $this->pointCalculator->calculatePoint($dealerHand);

            echo "ディーラーの引いたカードは{$drawnLastCard}です。" . PHP_EOL;
        }
        return $dealerScore;
    }

    public function addDealerCard(array $hands): int|string
    {
        // ディーラーの2枚目のカードを開示
        $dealerScore = $this->pointCalculator->calculatePoint($hands['dealerHand']);
        echo "ディーラーの引いた2枚目のカードは{$hands['dealerHand'][1]}でした。" . PHP_EOL;
        echo "ディーラーの現在の得点は{$dealerScore}です。" . PHP_EOL;
        echo PHP_EOL;

        $dealerScore = $this->dealerTurn($hands['dealerHand'], $dealerScore);
        echo "ディーラーの現在の得点は{$dealerScore}です。" . PHP_EOL;
        // バーストしていた場合はゲーム終了
        if ($dealerScore > 21) {
            return 'あなたの勝ちです。';
        }
        echo PHP_EOL;

        return $dealerScore;
    }

    public function addPlayerCard(array $hands, string $yourName, Player $player)
    {
        while (true) {
            //操作プレイヤーのスコアを計算
            $playerScore = $this->pointCalculator->calculatePoint($hands['playerHands'][$yourName]);

             // バーストしていた場合はゲーム終了
            if ($playerScore > 21) {
                return 'あなたの負けです。';
            }

            echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）" . PHP_EOL;
            $input = trim(fgets($this->inputHandle));

            // 追加のカードを引く場合
            if ($input == 'Y') {
                // 追加のカードを取得し、プレイヤー手札に代入
                $hands['playerHands'][$yourName] = $player->addCard(
                    $this->dealer,
                    $this->deck,
                    $hands['playerHands'][$yourName]
                );
                // 手札の最後の値を取得し、値＝追加カードをユーザーへ表示
                $drawnLastCard = end($hands['playerHands'][$yourName]);
                echo "あなたの引いたカードは{$drawnLastCard}です。" . PHP_EOL;
                continue;
            }
            return $playerScore;
        }
    }

    public function judgeWinner(int $playerScore, int $dealerScore, string $playerName): string
    {
        $winner = 'ディーラー';
        if ($playerScore > $dealerScore) {
            $winner = $playerName;
        }

        // 勝者名を出力
        echo "あなたの得点は{$playerScore}です。" . PHP_EOL;
        echo "ディーラーの得点は{$dealerScore}です。" . PHP_EOL;
        echo PHP_EOL;
        echo "{$winner}の勝ちです！" . PHP_EOL;
        return $winner;
    }
}

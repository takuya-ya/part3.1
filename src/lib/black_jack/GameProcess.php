<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Player;
use BlackJack\PointCalculator;
use BlackJack\PokerOutput;

class GameProcess
{
    // TODO:各自がカードを引く処理を共通化
    public function __construct(
        public Dealer $dealer,
        public Deck $deck,
        public PointCalculator $pointCalculator,
        public PokerOutput $pokerOutput,
        private $inputHandle = null // テスト時に、ストリームハンドルを代入
    ) {
        $this->inputHandle = $inputHandle ?? STDIN; // nullの場合は標準入力から入力を受ける
    }
    public function drawStartHands(array $playerNames): array
    {
        // 山札からカード取得。プレイヤー名をキーとする連想配列を、プレイヤーの人数分作成。
        $playerHands = $this->dealer->dealStartHands($this->deck, $playerNames);
        $dealerHand = $this->dealer->makeDealerHand($this->deck);

        // 各自の手札を出力
        $this->pokerOutput->displayPlayerCard($playerHands, $playerNames);
        $this->pokerOutput->displayDealerCard($dealerHand);

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
            // ディーラーが引いたカードを出力
            $this->pokerOutput->displayDealerTurn($drawnLastCard);
        }
        return $dealerScore;
    }

    public function addDealerCard(array $hands): int|string
    {
        // ディーラーの2枚目のカードを開示
        $dealerScore = $this->pointCalculator->calculatePoint($hands['dealerHand']);
        $this->pokerOutput->displayAddDealerCard($hands);

        // 追加カードを取得
        $dealerScore = $this->dealerTurn($hands['dealerHand'], $dealerScore);
        // 現在のスコアを出力
        $this->pokerOutput->displayDealerScore($dealerScore);
        // バーストしていた場合はゲーム終了
        if ($dealerScore > 21) {
            return $this->pokerOutput->displayPlayerWinMessage();
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
                return $this->pokerOutput->displayPlayerLoseMessage();
            }

            // 現在のスコアを出力
            $this->pokerOutput->displayPlayerScore($playerScore);
            // ユーザー入力を変数へ代入
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

                // 現在のスコアを出力
                $this->pokerOutput->displayAddPlayerCard($drawnLastCard);
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
        return $this->pokerOutput->displayGameResult($playerScore, $dealerScore, $winner);
    }
}

<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Player;
use BlackJack\PointCalculator;

require_once(__DIR__.'/PointCalculator.php');
require_once(__DIR__.'/Dealer.php');
require_once(__DIR__.'/Deck.php');
require_once(__DIR__.'/Player.php');


class GameProcess {

    const PLAYER_NAME_INDENT = 0;

    public function __construct(
        public Dealer $dealer,
        public Deck $deck,
        public PointCalculator $pointCalculator
    )
    {}

    public function drawStartHands(array $playerNames) //: void
    {
        // $player = new Player($playerNames[self::PLAYER_NAME_INDENT]);

        // 山札からカード取得。プレイヤー名をキーとする連想配列を、プレイヤーの人数分作成。
        $playerHands = $this->dealer->dealStartHands($this->deck, $playerNames);
        $dealerHand = $this->dealer->makeDealerHand($this->deck);

        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][0]}です。";
        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][1]}です。";
        echo "ディーラーの引いたカードは{$dealerHand[0]}です。";
        echo 'ディーラーの引いた2枚目のカードはわかりません。';

        // テスト用返り値を設定
        $hands = ['playerHands' => $playerHands, 'dealerHand' => $dealerHand];
        return $hands;
    }

    private const DRAW_STOP_SCORE = 17;

    public function dealerTurn(array $dealerHand, int $dealerScore): int {
        // dealerのカードが規定値以下の場合、カードを取得
        while (self::DRAW_STOP_SCORE >= $dealerScore) {
            // カードを取得、山札から。
            $dealerHand = array_merge($dealerHand, $this->dealer->dealAddCard($this->deck));
            // 引いたカードを出力してユーザーに表示。
            $lastAdditionalDealerCard = end($dealerHand);
            echo "ディーラーの引いたカードは{$lastAdditionalDealerCard}です。";
            // 手札のスコアを計算して出力
            $dealerScore = $this->pointCalculator->calculatePoint($dealerHand);
        }
        return $dealerScore;
    }

    public function addPlayerCard($input, array $hands, string $yourName, Player $player)
    {
        // TODO:テスト用変数。後ほど削除
        $i = 0;
        while(true) {
            //操作プレイヤーのスコアを計算
            $playerScore = $this->pointCalculator->calculatePoint($hands['playerHands'][$yourName]);

             // 追加カードによりバーストしていた場合はゲーム終了
            if ($playerScore > 21) {
                return 'あなたの負けです。';
            }

            echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）";
            // TODO:テスト用にメソッドの引数から渡す処理に変更。後ほど修正。
            // $input = trim(fgets(STDIN));

            // 追加のカードを引く場合
            if ($input[$i] == 'Y') {
                // 追加のカードを取得し、プレイヤー手札に代入
                $hands['playerHands'][$yourName] = $player->addCard($this->dealer, $this->deck, $hands['playerHands'][$yourName]);
                // 手札の最後の値を取得し、値＝追加カードをユーザーへ表示
                $lastAdditionalPlayerCard = end($hands['playerHands'][$yourName]);
                echo "あなたの引いたカードは{$lastAdditionalPlayerCard}です。";
                //再ループ
                $i++;
                continue;
            }
            return $playerScore;
        }
    }
}

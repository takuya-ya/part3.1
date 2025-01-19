<?php

namespace BlackJack;

use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\PointCalculator;
use BlackJack\GameProcess;

require_once(__DIR__.'/Deck.php');
require_once(__DIR__.'/Dealer.php');
require_once(__DIR__.'/PointCalculator.php');
require_once(__DIR__.'/GameProcess.php');

class Game
{
    public function __construct(
        // 必須引数（Deck $deck）はデフォルト値を持つ引数の前に置く必要があります。これに違反すると、エラーになります。
        public Deck $deck,
        public GameProcess $gameProcess,
        public Dealer $dealer,
        public PointCalculator $pointCalculator,
        public array $playerNames,
    )
    {
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。';
        // 初回カード取得
        $hands = $this->gameProcess->drawStartHands($this->playerNames);

        // プレイヤー登録
        $player = new Player('takuya');

        // playerが追加カードを引く
        while(true) {
            //プレイヤーのスコアを計算
            $playerScore = $this->pointCalculator->calculatePoint($hands['playerHands']['takuya']);

             // 追加カードによりバーストしていた場合はゲーム終了
            if ($playerScore > 21) {
                return 'あなたの負けです。';
            }

            echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）";
            $input = trim(fgets(STDIN));

            // 追加のカードを引く場合
            if ($input == 'Y') {
                // 追加のカードを取得し、プレイヤー手札に代入
                $hands['playerHands'] = $player->addCard($this->dealer, $this->deck, $hands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);
                // 手札の最後の値を取得し、値＝追加カードをユーザーへ表示
                $lastAdditionalPlayerCard = end($hands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);
                echo "あなたの引いたカードは{$lastAdditionalPlayerCard}です。";
                //再ループ
                continue;
            }
            break;
        }

        // ディーラーのカード追加処理
        // ディーラーの2枚目のカードを開示
        echo "ディーラーの引いた2枚目のカードは{$hands['dealerHand']}でした。";
        $dealerScore = $this->pointCalculator->calculatePoint($hands['dealerHand']);
        echo "ディーラーの現在の得点は{$dealerScore}です。";

        $dealerScore = $this->gameProcess->dealerTurn($hands['dealerHand'], $dealerScore);

        echo "ディーラーの現在の得点は{$dealerScore}です。";

        return 'テスト用出力';
        // echo "あなたの得点は{$playerScore}です。";
        // echo "ディーラーの得点は{$dealerScore}です。";
        //         // あなたの勝ちです！
        // $winnerMessage = $dealer->judgeWinner($playerHand);
        // return $winnerMessage;
        // ブラックジャックを終了します。




    }
}

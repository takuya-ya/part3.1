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
    const PLAYER_NAME_INDENT = 0;
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

        $player = new Player($this->playerNames[Game::PLAYER_NAME_INDENT]);

        // 山札からカード引いて、プレイヤー名をキーとする連想配列を、プレイヤーの人数分作成。
        $playerHands = $this->dealer->dealStartHands($this->deck, $this->playerNames);
        echo "あなたの引いたカードは{$playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]][0]}です。";
        echo "あなたの引いたカードは{$playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]][1]}です。";

        $dealerHand = $this->dealer->makeDealerHand($this->deck);
        echo "ディーラーの引いたカードは{$dealerHand[0]}です。";
        echo 'ディーラーの引いた2枚目のカードはわかりません。';

        // playerが追加カードを引く
        while(true) {
            //プレイヤーのスコアを計算
            $playerScore = $this->pointCalculator->calculatePoint($playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);

             // 追加カードによりバーストしていた場合はゲーム終了
            if ($playerScore > 21) {
                return 'あなたの負けです。';
            }

            echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）";
            $input = trim(fgets(STDIN));

            // 追加のカードを引く場合
            if ($input == 'Y') {
                // 追加のカードを取得し、プレイヤー手札に代入
                $playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]] = $player->addCard($this->dealer, $this->deck, $playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);
                // 手札の最後の値を取得し、値＝追加カードをユーザーへ表示
                $lastAdditionalPlayerCard = end($playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);
                echo "あなたの引いたカードは{$lastAdditionalPlayerCard}です。";
                //再ループ
                continue;
            }
            break;
        }

        // ディーラーのカード追加処理
        // ディーラーの2枚目のカードを開示
        echo "ディーラーの引いた2枚目のカードは{$dealerHand[1]}でした。";
        $dealerScore = $this->pointCalculator->calculatePoint($dealerHand);
        echo "ディーラーの現在の得点は{$dealerScore}です。";

        $dealerScore = $this->gameProcess->dealerTurn($dealerHand, $dealerScore);

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

<?php

namespace BlackJack;

use BlackJack\Dealer;

require_once(__DIR__.'/Dealer.php');

class Game
{
    const PLAYER_NAME_INDENT = 0;
    public $deck = [];

    public function __construct(public array $playerNames)
    {
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。';

        $deck = new Deck(new Card);
        $dealer = new Dealer;
        // $player = new Player($this->playerNames[Game::PLAYER_NAME_INDENT]);

        // 山札からカード引いて、プレイヤー名をキーとする連想配列を、プレイヤーの人数分作成。
        $playerHands = $dealer->dealStartHands($deck, $this->playerNames);

        echo "あなたの引いたカードは{$playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]][0]}です。";
        echo "あなたの引いたカードは{$playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]][1]}です。";

        return $playerHands;
    }

        // $dealerHand = $dealer->makeDealerHand();
        // // TODO:$playerCardsにdealerのカード含めるか確認したほうがいい
        // echo "ディーラーの引いたカードは$playerCards[$dealer][0]です。";
        // echo 'ディーラーの引いた2枚目のカードはわかりません。';

        // // playerが必要に応じて追加カードを引く
        // // playerNameをplayerHandsのキーに代入して、そのプレイヤーのカードを呼出し。手札を確認し必用であれば追加でカードを引く。最終的に勝負するカードを返り値とする
        // // 初期値で名前と手札を設定
        // $player = new Player();
        // // playerが追加カードを引く処理を追加
        // while(true) {
        //     // 現在のスコアを出す
        //     $playerScore = $dealer->calculateScore($playerHand);
        //     // スコアに基づいてカード追加可否を判断
        //     echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）";
        //     $input = trim(fgets(STDIN));

        //     if ($inputs = 'Y') {
        //         // 既存のcalculateScoreを再利用する為、additionalDrawCardではplayerHand配列に追加した状態にする？責任が広すぎるか？
        //         // playerHandの最後の値を取得する
        //         $lastAdditionalCard = end($player->additionalDrawCard($playerHand));
        //         echo "あなたの引いたカードは{$lastAdditionalCard}です。";
        //         $playerScore = $dealer->calculateScore($playerHand);
        //         if ($playerScore > 21) {
        //             echo 'あなたの負けです。';
        //             break;
        //         }
        //         continue;
        //     }
        //     break;
        // }

        // // 点数化するのはどこでする？
        // // 関数内で点数化関数呼出し(dealerクラスで定義)
        // $winnerMessage = $dealer->judgeWinner($playerHand);
        // return $winnerMessage;

        // ディーラーの引いた2枚目のカードはダイヤの2でした。
// ディーラーの現在の得点は12です。
// ディーラーの引いたカードはハートのKです。
// あなたの得点は20です。
// ディーラーの得点は22です。
// あなたの勝ちです！
// ブラックジャックを終了します。
}

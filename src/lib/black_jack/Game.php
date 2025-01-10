<?php

namespace BlackJack;

use BlackJack\Dealer;

require_once(__DIR__.'/Dealer.php');

class Game
{
    public $deck = [];

    public function __construct(public string $playerName)
    {
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。';

        $dealer = new Dealer;
        // dealingCardで山札からカード引いて、それをプレイヤー名をキーとする連想配列とする。
        // 連想配列としてプレイヤーの手札群とする（今回は1人だが）
        $playerCards = $dealer->dealingCard($this->playerName);

        // playerが必要に応じて追加カードを引く
        // playerNameをplayerCardsのキーに代入して、そのプレイヤーのカードを呼出し。手札を確認し必用であれば追加でカードを引く。最終的に勝負するカードを返り値とする
        $player = new Player($this->playerName);
        // キーにプレイヤー名を入れて、手札を取得
        //
        $playerHand = $player->receiveFirstCard($playerCards);

        echo "あなたの引いたカードは$playerHand[0]です。";
        echo "あなたの引いたカードは$playerHand[1]です。";

        // TODO:$playerCardsにdealerのカード含めるか確認したほうがいい
        echo "ディーラーの引いたカードは$playerCards[$dealer][0]です。";
        echo 'ディーラーの引いた2枚目のカードはわかりません。';

        // playerが追加カードを引く処理を追加
        while(true) {
            // 現在のスコアを出す
            $playerScore = $dealer->calculateScore($playerHand);
            // スコアに基づいてカード追加可否を判断
            echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）";
            $input = trim(fgets(STDIN));

            if ($inputs = 'Y') {
                // 既存のcalculateScoreを再利用する為、additionalDrawCardではplayerHand配列に追加した状態にする？責任が広すぎるか？
                // playerHandの最後の値を取得する
                $lastAdditionalCard = end($player->additionalDrawCard($playerHand));
                echo "あなたの引いたカードは{$lastAdditionalCard}です。";
                $playerScore = $dealer->calculateScore($playerHand);
                if ($playerScore > 21) {
                    echo 'あなたの負けです。';
                    break;
                }
                continue;
            }
            break;
        }

        // 点数化するのはどこでする？
        // 関数内で点数化関数呼出し(dealerクラスで定義)
        $winnerMessage = $dealer->judgeWinner($playerHand);
        return $winnerMessage;
    }
// ディーラーの引いた2枚目のカードはダイヤの2でした。
// ディーラーの現在の得点は12です。
// ディーラーの引いたカードはハートのKです。
// あなたの得点は20です。
// ディーラーの得点は22です。
// あなたの勝ちです！
// ブラックジャックを終了します。
}

<?php

namespace BlackJack;

use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\PointCalculator;

require_once(__DIR__.'/Deck.php');
require_once(__DIR__.'/Dealer.php');
require_once(__DIR__.'/PointCalculator.php');

class Game
{
    const PLAYER_NAME_INDENT = 0;
    public function __construct(
        // 必須引数（Deck $deck）はデフォルト値を持つ引数の前に置く必要があります。これに違反すると、エラーになります。
        public Deck $deck,
        public array $playerNames,
        // ?でnullable型に指定し、nullを許容
        public ?Dealer $dealer = null,
        public ?PointCalculator $pointCalculator = null
    )
    {
        $this->dealer = $dealer ?? new Dealer($deck);
        $this->pointCalculator = $pointCalculator ?? new PointCalculator();
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
                $lastAdditionalCard = end($playerHands[$this->playerNames[Game::PLAYER_NAME_INDENT]]);
                echo "あなたの引いたカードは{$lastAdditionalCard}です。";
                //再ループ
                continue;
            }

            // 追加のカードを引かない場合の仮実装
            return 'テスト完了';
        }
    }
}
        // // playerが必要に応じて追加カードを引く
        // // playerNameをplayerHandsのキーに代入して、そのプレイヤーのカードを呼出し。手札を確認し必用であれば追加でカードを引く。最終的に勝負するカードを返り値とする
        // // 初期値で名前と手札を設定
        // $player = new Player();
        // // playerが追加カードを引く処理を追加
        // while(true) {
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

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

    const PLAYER_NAME_INDENT = 0;
    private string $yourName;
    public function start(): string
    {
        // 操作プレイヤーの名前を取得
        $this->yourName = $this->playerNames[self::PLAYER_NAME_INDENT];
        // プレイヤー登録
        $player = new Player($this->yourName);

        echo 'ブラックジャックを開始します。';
        // 初回カード取得
        $hands = $this->gameProcess->drawStartHands($this->playerNames);
        // プレイヤーの追加カード取得
        // TODO:テスト終了後、引数でユーザー入力を代入している部分を削除
        // $playerScore = $this->gameProcess->addPlayerCard('N', $hands, $this->yourName, $player);
        $playerScore = $this->gameProcess->addPlayerCard($hands, $this->yourName, $player);

        // ディーラーのカード追加処理
        $dealerScore = $this->gameProcess->addDealerCard($hands);

        // 勝敗の判定
        $this->gameProcess->judgeWinner($playerScore, $dealerScore, $player->playerName);
        return 'ブラックジャックを終了します。';
    }
}

$card = new Card;
$deckInstance = new Deck($card);
$dealer = new Dealer;
$pointCalculator = new PointCalculator;
$gameProcess = new GameProcess($dealer, $deckInstance, $pointCalculator);
$game = new Game($deckInstance, $gameProcess, $dealer, $pointCalculator, ['takuya']);
$game->start();

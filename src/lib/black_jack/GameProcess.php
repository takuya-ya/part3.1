<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\PointCalculator;

require_once(__DIR__.'/PointCalculator.php');
require_once(__DIR__.'/Dealer.php');
require_once(__DIR__.'/Deck.php');


class GameProcess {

    public function __construct(
        public Dealer $dealer,
        public Deck $deck,
        public PointCalculator $pointCalculator
    )
    {}

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
}

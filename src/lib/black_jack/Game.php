<?php

namespace BlackJack;

use BlackJack\Dealer;

require_once(__DIR__.'/Dealer.php');

class Game
{
    public function __construct(public string $playerName)
    {
    }

    public function start()
    {
        $dealer = new Dealer;
        $playerCards = $dealer->dealingCard($this->playerName);

        // playerNameをplayerCardsのキーに代入して、そのプレイヤーのカードを呼出し。手札を確認し必用であれば追加でカードを引く。最終的に勝負するカードを返り値とする
        $player = new Player($this->playerName);
        $hand = $player->receiveCard($playerCards);

        // TODO:テスト用の返り値
        return $hand;
    }
}

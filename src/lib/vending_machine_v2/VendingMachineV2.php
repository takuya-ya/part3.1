<?php

namespace VendingMachineV2;

use VendingMachineV2\CoinManager;
use VendingMachineV2\Item;
use VendingMachineV2\InstanceFactory;

// 複数アイテムの追加
// アイテムを複数商品にする
// 現在　呼び出し時にインスタンス作成してpressButtonに渡す
// 名前入れるとインスタンス作成してほしい：普通買う時に購入したい商品のボタン押すだけだから（欲しい商品のインスタンスを作成したりしない）

class VendingMachineV2 {
    private CoinManager $coinManager;
    private InstanceFactory $instanceFactory;

    public function __construct() {
        $this->coinManager = new CoinManager;
        $this->instanceFactory = new InstanceFactory;
    }
    // インスタンス作成するクラス
    // 条件に応じて
    // mache関数

    public function instanceFactory(string $name): Item {
        return $this->instanceFactory->selectItem($name);
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    public function pressButton(Item $item): string
    {
        if ($this->coinManager->useCoin($item)) {
            return "cola";
        }
        return 'お金が足りません';
    }
}

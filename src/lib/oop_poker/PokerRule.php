<?php

namespace OopPoker;

interface PokerRule
{
    public function getHand(array $pokerCards);
    // このメソッドも追加しないと、呼び出し元で「このメソッドが実装されていることを保証できない」としてエラーになる
    // インスタンスを作成して、アクセス権をpublicにすれば、インターフェイスを実装しているクラスのメソッドはすべて使用できると思っていた
    public function maxMin(array $ranks): bool; // maxMinメソッドを追加
}

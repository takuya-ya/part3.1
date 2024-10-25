<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '/../lib/TV_viewing_time.php');

class  TV_viewing_timeTest extends TestCase
{
    public function test()
    {
      // ヒアドキュメントの最後の空行は改行として必要
      $output = <<<EOD
      1.7
      1 45 2
      5 25 1
      2 30 1

      EOD;

      $this->expectOutputString($output);

      // コマンドライン引数からチャンネル番号と視聴時間を取得する関数
      // テスト：スクリプト引き数をとっていたが、テスト用に関数に引数を渡す
      $inputs = getInput(['file', '1', '30', '5', '25', '2', '30', '1', '15']);
      //チャンネル毎の視聴時間をグルーピング
      $viewingTimesByChan = groupChannelViewingTime($inputs);
      // アウトプットを出力　関数内でチャネル毎の合計視聴時間も計算
      displayViewingTime($viewingTimesByChan);

    }
}

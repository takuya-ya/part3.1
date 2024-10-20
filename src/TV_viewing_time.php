<?php

declare(strict_types=1);

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
function getInput($argv) {
  // コマンドライン引数から最初の要素（スクリプト名）を除外し、チャンネル番号と視聴時間のペアに分割
  $viewingTimesByChannel = array_chunk(array_slice($argv,1), 2);

  return $viewingTimesByChannel;
}

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
$getInput($argv);
calculateViewingTime();
// displayViewingTime();

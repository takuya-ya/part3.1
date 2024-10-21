<?php

declare(strict_types=1);

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
function getInput(array $argv): array {
    // コマンドライン引数から最初の要素（スクリプト名）を除外し、チャンネル番号と視聴時間のペアに分割
    return array_chunk(array_slice($argv,1), 2);
  }

//チャンネル毎の視聴時間をグルーピング
function groupChannelViewingTime(array $inputs):array
{
    $viewingTimesByChannel = [];
    // チャンネルごとの視聴時間を配列に格納　複数回視聴している場合は視聴時間を追記
    foreach ($inputs as $input) {
        $channel = $input[0];
        $min = $input[1];
        $mins[] = $min
        // $chanを視聴済みの場合、既存配列に時間を追記
        if (array_key_exists($chan,$viewingTimesByChannel)) {
            $mins[] = array_merge($viewingTimesByChannel[$channel], $mins)
        }
        $viewingTimesByChannel[$mins] = $mins
    }

  var_dump($viewingTimesByChannel);
  // 多次元配列｛チャンネル数　=>　視聴分数1　視聴分数２｝
  視聴回数をカウント
    foreach ($viewingTimesByChannel as $channel => $mins) {
        $viewCount = count($mins);
        if ($viewCount >= 2) {
          $viewingTimeByChannel = array_sum($mins);
        }
        "$channel" . '' . "$viewingTimeByChannel" . '' . "$viewCount";
    }
}
// 視聴回数が>=2のチャンネルは値を合算してキーの視聴時間に上書き
//配列（ チャンネル数　合計視聴時間　視聴回数）の形で出力


// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
// 出力：チャンネル、時間の値配列にもつ、配列
$inputs = getInput($argv);
var_dump($inputs);
//チャンネル毎の視聴時間をグルーピング
$viewingTimesByChannel = groupChannelViewingTime($inputs)
// アウトプットを出力
// displayViewingTime();

// channerl minの配列をもつ配列にする
// 合計視聴時間：foreachでその配列を展開し、minだけ取り出して加算

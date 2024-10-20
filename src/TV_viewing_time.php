<?php

declare(strict_types=1);

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
function getInput(array $argv): array {
    // コマンドライン引数から最初の要素（スクリプト名）を除外し、チャンネル番号と視聴時間のペアに分割
    return array_chunk(array_slice($argv,1), 2);
  }

//   // チャンネル毎の視聴時間を計算
//   function calculateViewingTime(array $viewingTimesByChannel)//:array
//   {
//    // $viewingTimesByChannel = [];
//    // // チャンネルごとの視聴時間を配列に格納　複数回視聴している場合は視聴時間を追記
//    // foreach ($inputs as $input) {
//    //     $channel = $input[0];
//    //     $min = $input[1];
//    //     $viewingTimesByChannel[$channel][] = $min;
//    // }
//    // var_dump($viewingTimesByChannel);
//    // // 多次元配列｛チャンネル数　=>　視聴分数1　視聴分数２｝
//     // 視聴回数をカウント
//       foreach ($viewingTimesByChannel as $channel => $mins) {
//           $viewCount = count($mins);
//           if ($viewCount >= 2) {
//             $viewingTimeByChannel = array_sum($mins);
//           }
//          "$channel" . '' . "$viewingTimeByChannel" . '' . "$viewCount";
//       }
// }
    // 視聴回数が>=2のチャンネルは値を合算してキーの視聴時間に上書き
    //配列（ チャンネル数　合計視聴時間　視聴回数）の形で出力


// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
$viewingTimesByChannel = getInput($argv);
// チャンネル毎の視聴時間を計算
// $viewingTimesByChannel = calculateViewingTime($viewingTimesByChannel);
// テレビの合計視聴時間を計算
// calculateTotalViewingTime($viewingTimesByChannel;)
// displayViewingTime();

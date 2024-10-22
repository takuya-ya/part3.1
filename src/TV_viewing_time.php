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
        // エラー：配列を追加し続けている
        // $mins[] = $min;
        // 配列同士をmergeする為に、$minを配列化。複数形なのは、今回のループで初めての場合、ifを介さずそのまま連想配列の値になる為。
        $mins = [$min];
        // $chanを視聴済みの場合、既存配列に時間を追記
        if (array_key_exists($channel,$viewingTimesByChannel)) {
            // エラー：
            // $mins[] = array_merge($viewingTimesByChannel[$channel], $mins);
            $mins = array_merge($viewingTimesByChannel[$channel], $mins);
          }

        $viewingTimesByChannel[$channel] = $mins;
    }
    return $viewingTimesByChannel;
  }
    // 全チャネルの合計視聴時間を計算
  function totalViewingTime(array $viewingTimesByChannel):float {
      $totalMins = [];
      //配列に値としてチャネルの視聴時間を追加
      foreach ($viewingTimesByChannel as $mins) {
          $totalMins = array_merge($totalMins, $mins);
      }
    //配列の視聴時間を合計
      $totalHour = array_sum($totalMins);
    //   分数を時間に換算
      $t = ($totalHour/60);
    //小数点第一位までに四捨五入
      return round($t, 1) . PHP_EOL;
  }

  // アウトプット例に基づいて出力
  function displayViewingTime(array $viewingTimesByChannel):void {

      //テレビの合計視聴時間を求める
      echo totalViewingTime($viewingTimesByChannel);
      foreach ($viewingTimesByChannel as $channel => $mins) {
          // 不要。変数に代入せず、そのまま出力したいい。
          // $viewCount = count($mins);

          // 不要。値が一つでもarray_sumで出力できる。それにこの場合、値が一つの場合の出力方法が指定されていないので、最後のechoで値でなく配列が文字列として出力されてしまいエラーになる。
          // if ($viewCount >= 2) {
          //   $viewingTimeByChannel = array_sum($mins);}
          // ミス：出力方法
          // "$channel" . '' . "$viewingTimeByChannel" . '' . "$viewCount";

          echo "$channel" . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;

      }
  }


// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
$inputs = getInput($argv);
//チャンネル毎の視聴時間をグルーピング
$viewingTimesByChannel = groupChannelViewingTime($inputs);
// アウトプットを出力　関数内でチャネル毎の合計視聴時間も計算
displayViewingTime($viewingTimesByChannel);

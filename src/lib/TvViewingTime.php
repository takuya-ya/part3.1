<?php

declare(strict_types=1);

namespace TvViewingTime;

const SPLIT_LENGTH = 2;

/**
 * @param string[] $argv
 * @return string[][]
 */
// テスト用：スクリプト引き数をとっていたが、テスト用に関数に引数を渡す
function getInput(array $argv): array
{
    // コマンドライン引数から最初の要素（スクリプト名）を除外し、チャンネル番号と視聴時間のペアに分割
    // 修正：マジック定数を削除
    return array_chunk(array_slice($argv, 1), SPLIT_LENGTH);
}

//チャンネル毎の視聴時間をグルーピング
/**
 * @param string[][] $inputs
 * @return array<int,array<string>> $viewingTimesByChan
 */
function groupChannelViewingTime(array $inputs): array
{
    /** @var array<int, array<string>> $viewingTimesByChan */
    $viewingTimesByChan = [];
    // チャンネルごとの視聴時間を配列に格納　複数回視聴している場合は視聴時間を追記
    foreach ($inputs as $input) {
        $channel = $input[0];
        $min = $input[1];
        // エラー：配列を追加し続けている
        // $mins[] = $min;
        // 配列同士をmergeする為に、$minを配列化。複数形なのは、今回のループで初めての場合、ifを介さずそのまま連想配列の値になる為。
        $mins = [$min];
        // $chanを視聴済みの場合、既存配列に時間を追記
        if (array_key_exists($channel, $viewingTimesByChan)) {
            // エラー：
            // $mins[] = array_merge($viewingTimesByChan[$channel], $mins);
            $mins = array_merge($viewingTimesByChan[$channel], $mins);
        }

        $viewingTimesByChan[$channel] = $mins;
    }
    return $viewingTimesByChan;
}
// 全チャネルの合計視聴時間を計算
// 修正：関数名変更、viewingTimeなどのワードが多い為。変更した方が区別がつきやすい。
//function totalViewingTime(array $viewingTimesByChan):float {

/**
 * @param int[][] $viewingTimesByChan
 * @return string
 */
function calculateTotalHour(array $viewingTimesByChan): string
{
    $totalMins = [];
    //配列に値としてチャネルの視聴時間を追加
    foreach ($viewingTimesByChan as $mins) {
        $totalMins = array_merge($totalMins, $mins);
    }
//配列の視聴時間を合計
    $totalHour = array_sum($totalMins);
//   分数を時間に換算
// 修正　変数代入でなくそのまま出力
    // $t = ($totalHour/60);
    // return round($t, 1) . PHP_EOL;

    //小数点第一位までに四捨五入
    return round($totalHour / 60, 1) . PHP_EOL;
}

  // アウトプット例に基づいて出力
function displayViewingTime(array $viewingTimesByChan): void
{

      //テレビの合計視聴時間を求める
    echo calculateTotalHour($viewingTimesByChan);
    foreach ($viewingTimesByChan as $channel => $mins) {
          // 不要。変数に代入せず、そのまま出力したいい。
          // $viewCount = count($mins);

          // 不要。値が一つでもarray_sumで出力できる。それにこの場合、値が一つの場合の出力方法が指定されていないので、最後のechoで値でなく配列が文字列として出力されてしまいエラーになる。
          // if ($viewCount >= 2) {
          //   $viewingTimeByChan = array_sum($mins);}
          // ミス：出力方法
          // "$channel" . '' . "$viewingTimeByChan" . '' . "$viewCount";

        echo "$channel" . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
    }
}

// スクリプト引き数をとっていたが、テスト用に関数に引数を渡す
// $array = [];
$inputs = getInput(['file', '1', '30', '5', '25', '2', '30', '1', '15']);

$viewingTimesByChan = groupChannelViewingTime($inputs);
displayViewingTime($viewingTimesByChan);

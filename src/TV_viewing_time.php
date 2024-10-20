<?php

declare(strict_types=1);

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
function getInput(array $argv): array {
    // コマンドライン引数から最初の要素（スクリプト名）を除外し、チャンネル番号と視聴時間のペアに分割
    $inputs = array_chunk(array_slice($argv,1), 2);
    // var_dump($inputs);

    $viewingTimesByChannel = [];
    // チャンネルごとの視聴時間を配列に格納　複数回視聴している場合は視聴時間を追加
    foreach ($inputs as $input) {
        $channel = $input[0];
        $min = $input[1];
        $viewingTimesByChannel[$channel][] = $min;
    }
    var_dump($viewingTimesByChannel);
    // チャンネル数　=>　視聴分数
    return $viewingTimesByChannel;
}

function (array $viewingTimesByChannel):array {

    //配列（ チャンネル数　合計視聴時間　視聴回数）の形で出力
    // 視聴回数をカウント
    $channelViewingData = [];
    // 視聴回数が>=2のチャンネルは値を合算してキーの視聴時間に上書き
}

// コマンドライン引数からチャンネル番号と視聴時間を取得する関数
$viewingTimesByChannel = getInput($argv);
// チャンネル毎の視聴時間を計算
$viewingTimesByChannel = calculateViewingTime($viewingTimesByChannel);
// テレビの合計視聴時間を計算
calculateTotalViewingTime($viewingTimesByChannel;)
// displayViewingTime();

<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request)
    {
        // ModelsのTweetから新しいインスタンスを作成
        $tweet = new Tweet;

        // CreateRequestを引数に指定しているので、サービスコンテナによりCreateRequestのインスタンス化したものが$requestに入る、$requestからCreateRequestで定義した関数のtweet()を実行して、contentに入れる
        $tweet->content = $request->tweet(); 

        // 保存を実行
        $tweet->save();

        // /tweet画面にリダイレクト
        return redirect()->route('tweet.index');
    }
}

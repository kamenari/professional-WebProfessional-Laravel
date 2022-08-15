<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, TweetService $tweetService)
    {   
        // // tweetServiceからcheckOwnTweetを呼び出し、useのidとtweetIdを渡して、falseが帰ってきた場合は、403エラーに飛ばす
        if (!$tweetService->checkOwnTweet($request->user()->id, $request->id())) {
            throw new AccessDeniedHttpException();
        }

        // ModelsのEloquentモデルのTweetから、UpdateRequestである$requestのidで検索し1件のレコードを取得
        $tweet = Tweet::where('id', $request->id())->firstOrFail();

        // UpdateRequestである$requestのtweet()つまりputされたname="tweet"を取得して、$tweet->contentの検索した1件のレコードのcontentをputで取得したname="tweet"で更新
        $tweet->content = $request->tweet();

        // それらを保存
        $tweet->save();

        // 同じidのルートにリダイレクト、更新成功時のメッセージを追加
        return redirect()
            ->route('tweet.update.index', ['tweetId' => $tweet->id])
            ->with('feedback.success', "つぶやきを編集しました");
    }
}

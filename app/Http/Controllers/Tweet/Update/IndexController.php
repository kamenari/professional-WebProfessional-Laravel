<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {   
        // RequestからパスのtweetIdを取得
        $tweetId = (int) $request->route('tweetId');

        // tweetServiceからcheckOwnTweetを呼び出し、useのidとtweetIdを渡して、falseが帰ってきた場合は、403エラーに飛ばす
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        // ModelsのEloquentモデルであるTweetのクエリビルダを使いidで検索、first()で1件のみ取得、where('id', $tweetId)でidが$tweetIdのレコードを検索
        // $tweet = Tweet::where('id', $tweetId)->first();
        // firstOrFail()で検索結果がない場合の例外になり、キャッチしない場合は404になる
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();

        // Eloquentモデルは検索結果が無ければnullを返す、is_nullで$tweetがnullか判定
        // if (is_null($tweet)) {
        //     // nullの場合はNotFoundHttpExceptionで例外の処理
        //     throw new NotFoundHttpException('存在しないつぶやきです');
        // }

        // dd($tweet);
        
        // bladeに$tweetを渡す
        return view('tweet.update')->with('tweet', $tweet);
    }
}

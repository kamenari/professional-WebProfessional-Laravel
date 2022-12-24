<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\TweetService;
use Mockery;

class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * @runInSeparateProcess
     * @return void
     */
    public function test_check_own_tweet()
    {   
        $tweetService = new TweetService(); // テスト対象のクラスをインスタンス化

        $mock = Mockery::mock('alias:App\Models\Tweet'); // モックを作成
        $mock->shouldReceive('where->first')->andReturn((object) [
            'id' => 1,
            'user_id' => 1
        ]); // モックの振る舞いを定義

        $result = $tweetService->checkOwnTweet(1, 1); // trueのテスト対象のメソッドを実行
        $this->assertTrue($result);

        $result = $tweetService->checkOwnTweet(2, 1); // falseのテスト対象のメソッドを実行
        $this->assertFalse($result);
    }
}

<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class DeleteTest extends TestCase
{
    use RefreshDatabase; // テスト実行前にマイグレーションを実行
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_successed()
    {
        $user = User::factory()->create(); // テストユーザーを作成

        $tweet = Tweet::factory()->create([
            'user_id' => $user->id
        ]); // テストユーザーのつぶやきを作成

        $this->actingAs($user); // 指定したテストユーザーでログイン

        $response = $this->delete('/tweet/delete/' .$tweet->id); // テスト対象のURLを指定 作成したつぶやきを指定

        $response->assertRedirect('/tweet'); // リダイレクト先のURLを指定
    }
}

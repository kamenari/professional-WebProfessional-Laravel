<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(); // テストユーザーを作成
            $browser->visit('/login')
                    ->type('email', $user->email) // テストユーザーのメールアドレスを指定
                    ->type('password', 'password') // パスワードを入力
                    ->press('LOG IN') // LOG INボタンをクリック
                    ->assertPathIs('/tweet') // ログイン後のURLを指定
                    ->assertSee('つぶやきアプリ'); // ログイン後の画面につぶやきアプリという文字列があるかを確認
        });
    }
}

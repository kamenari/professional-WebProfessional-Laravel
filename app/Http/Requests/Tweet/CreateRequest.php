<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 140文字以内で必須のバリデーションを追加
            'tweet' => 'required|max:140'
        ];
    }

    // Requestクラスのuser関数で今自分がログインしているユーザーが取得できる
    public function userId(): int
    {
        return $this->user()->id;
    }
    
    public function tweet(): string
    {   
        // formからpostされたname="tweet"の内容を取得
        return $this->input('tweet');
    }
}

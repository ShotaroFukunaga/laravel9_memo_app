# フォームから送られてくるリクエストに対してバリデーションを設定するファイル

```
pulic function authorize()
{
  return true;
}
```
> authorizeメソッド
> ユーザー情報を判別して、このリクエストを認証できるか判定させる。初期値はfalse

```
public function rules()
{
  return [
      'tweet' => 'required|max:140'
  ];
}
```
> rulesメソッド
> 配列を返却する、keyがリクエストフォームのkeyに対応している。つまり上記の記述ではtweetとリクストのtweetが対応していることになる。
> リクストされる値を検証する為の設定を行う
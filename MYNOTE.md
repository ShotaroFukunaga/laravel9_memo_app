## コマンド

- sail artisan migrate:rollback</br>
- artisan route:list</br>
- php artisan make:model モデル名</br>
- php artisan make:migration create_テーブル名s_table --create=テーブル名s</br>
- php artisan make:controller 名前Controller</br>
- php artisan optimize -> 最適化</br>
- php artisan tinker -> 対話コンソール</br>
</br>

---

## 初期手順

1. mkdir directory_name
2. cd directory_name
3. ```curl -s https://laravel.build/アプリ名 | zsh ```
4. cd application_name_directory
5. ```./vendor/bin/sail up```->sail up -dでバックグラウンド
6. ``` http://localhost```
7. sail php --version
8. sail artisan -V  -バージョン確認
9. sail npm install -NPMでパッケージをインストール
10. sail npm run dev -JS/CSSをビルド
11. sail artisan migrate テーブルを作成（データベースの設定は.envファイル）
12. phpMyAdminのインストール
```
    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        links:
            - mysql:mysql
        ports:
            - 8080:80
        environment:
            PMA_HOST: mysql
        networks:
            - sail
```
12. sail up -d
13. ログイン情報は.envファイルのdb_usernameとdb_password
14. docker_composeにログイン情報を記述
```
        environment:
            PMA_HOST: mysql
            PMA_PASSWORD: "${DB_USERNAME}"
            PMA_USER: "${DB_PASSWORD}"
        networks:
            - sail
```
15. localhost:8080
    
---
## 認証機能
breezを使用
1. sail composer require laravel/breeze --dev
2. sail artisan breeze:install

---

</br>

## fillable OR guarded
https://qiita.com/toro_ponz/items/b33c757cb7ba5bb48ed4
- app/model/モデル名
- fill -> ホワイトリスト
- guard -> ブラックリスト 
  
  </br>

---
</br>

## migration_file
```
Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->text('content')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
```
nullable(false)許容しない
nullable()許容する
default()デフォルト値

---

## 名前空間:namespace:\
名前空間を使うと同じ関数名でも定義できる
ブロックみたいな、ローカル変数みたいな
https://qiita.com/7968/items/1e5c61128fa495358c1f

## Illuminate
laravelのコンポーネントが大量に置いてある場所
path => vendor/laravel/flamework/src/Illuminate

## selfと$this
- $thisはクラスから生成されたオブジェクト自身を指す
  - つまり子分自身の関数や変数を使用する際に使用
- selfはクラス自身を指す
  - static変数やクラス定数を呼び出す時に使用する
  - オブジェクト自身の変数ではなくクラスそのものに属している
  https://hara-chan.com/it/programming/php-self-this-difference/#:~:text=4%20%E9%96%A2%E9%80%A3%E8%A8%98%E4%BA%8B-,%24this%E3%81%A8%E3%81%AF,%E3%81%99%E3%82%8B%E9%9A%9B%E3%81%AB%E4%BD%BF%E7%94%A8%E3%81%99%E3%82%8B%E3%80%82

## NULL文字のformatと空文字
```
ボッチ演算子と一緒
<td>{{ $task->deadline?->format('Y/m/d') ?? ''}}</td>
NULL文字はフォーマット出来ないのでNULLセーフを使用,PHP8.0以前は deadline === null ? '' : deadline->format('Ydm')

```

## bladeのエスケープ
 {{ $hello }} <- これでインスタンスオブジェクトをhtmlspecialchars関数を通してHTMLとして出力する
 {!! !!} <- エスケープの無効化、javascriptなどを実行したい場合に使用
 ```
<?php
    $javascript = "<script>alert('xss');</script>"
?>
    {!! $javascript !!}
 ```

## makeコマンド
sail artisan make::model Task "-c コントローラー" "-mf モデルファクトリー" "-s シーダー"
sail artisan make::model User -mfsc   == all

## モデルファクトリー　シーダー　フェイカー
Seeder ダミーデータを一斉に挿入する機能 開発時に使う
ModelFactory カラムに入る値を定義する、Seederで呼び出す テストに使う
Faker ModelFactoryで値を定義するときに使う

## リクエスト関係　fillとfiilable
fill()を使うときには一度Modelを見に行って$fillableで指定されている項目かどうかをチェックして、$fillableで指定されているものだけがsave()される
https://yama-weblog.com/using-fill-method-to-be-a-simple-code/

## firstOrFail();
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
例外処理として404NOT Foundを返す関数
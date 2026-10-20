<p align="center">
  <img src="public/images/reading_cat_2.png" width="120" alt="Book App Logo">
</p>

<h1 align="center">Book App</h1>

<p align="center">
読んだ本を記録・管理するWebアプリケーションです。<br>
書籍のタイトル・著者・評価・感想などを手軽に登録・管理できます。
</p>

## 使用技術

| カテゴリ | 技術 |
|---|---|
| バックエンド | PHP 8.5.5 / Laravel 13.4.0 |
| データベース | MySQL 9.6.0 |
| インフラ | Docker 27.4.0 |
| フロントエンド | Tailwind CSS 3.4.19 |
| 認証 | Laravel Breeze 2.4.1 |
| 外部API | Google Books API |

## 機能

- ユーザー登録・ログイン（認証機能）
- 書籍の登録・編集・削除（CRUD）
- 評価・感想の記録
- Google Books API による書籍検索・フォームへの自動入力
- 書籍サムネイル画像の保存・表示

## セットアップ

```bash
git clone https://github.com/juki1009/book-app.git
cd book-app
cp .env.example .env
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
# データベースをリフレッシュして初期データを再投入する場合
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app npm install
docker compose exec app npm run dev
```

ブラウザで `http://localhost` にアクセスしてください。

## 動作確認

1. 新規アカウントを登録してログイン
2. 書籍を検索してフォームに自動入力
3. 書籍を登録・編集・削除

## 今後の実装予定

- フロントエンドを React に移行
- レコメンド機能の実装
- 読書履歴のグラフ可視化
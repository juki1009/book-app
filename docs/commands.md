# よく使うコマンド

## Docker

| コマンド | 説明 |
|---|---|
| `docker compose up -d` | コンテナ起動 |
| `docker compose down` | コンテナ停止 |
| `docker compose exec app bash` | コンテナに入る |

## データベース

| コマンド | 説明 |
|---|---|
| `docker compose exec app php artisan migrate` | マイグレーション実行 |
| `docker compose exec app php artisan migrate:fresh` | DBリセット＋再構築 |
| `docker compose exec app php artisan migrate:fresh --seed` | DBリセット＋Seeder実行 |
| `docker compose exec app php artisan db:seed --class=BookSeeder` | 特定のSeederだけ実行 |

## 開発

| コマンド | 説明 |
|---|---|
| `npm run dev` | Vite開発サーバー起動 |
| `docker compose exec app php artisan make:model ModelName -m` | モデル＋マイグレーション作成 |
| `docker compose exec app php artisan make:controller ControllerName --resource` | リソースコントローラー作成 |
| `docker compose exec app php artisan route:list` | ルート一覧確認 |
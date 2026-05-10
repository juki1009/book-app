<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $books = [
            ['title' => '複利で伸びる1つの習慣', 'author' => 'ジェームズ・クリアー', 'rating' => 4],
            ['title' => 'FACTFULNESS', 'author' => 'ハンス・ロスリング', 'rating' => 5],
            ['title' => 'LIFE SHIFT', 'author' => 'リンダ・グラットン', 'rating' => 5],
            ['title' => 'コンビニ人間', 'author' => '村田 沙耶香', 'rating' => 4],
            ['title' => '思考は現実化する', 'author' => 'ナポレオン・ヒル', 'rating' => null],
            ['title' => '人を動かす', 'author' => 'D・カーネギー', 'rating' => 3],
            ['title' => '嫌われる勇気', 'author' => '岸見 一郎', 'rating' => 5],
            ['title' => 'サピエンス全史', 'author' => 'ユヴァル・ノア・ハラリ', 'rating' => 4],
            ['title' => '限りある時間の使い方', 'author' => 'オリバー・バークマン', 'rating' => 4],
            ['title' => 'ゼロ秒思考', 'author' => '赤羽 雄二', 'rating' => 3],
            ['title' => 'イシューからはじめよ', 'author' => '安宅和人', 'rating' => 5],
            ['title' => '夢をかなえるゾウ', 'author' => '水野敬也', 'rating' => 4],
        ];

        foreach ($books as $book) {
            Book::create([
                'user_id' => $user->id,
                'title'   => $book['title'],
                'author'  => $book['author'],
                'rating'  => $book['rating'],
            ]);
        }
    }
}
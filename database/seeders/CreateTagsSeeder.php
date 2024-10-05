<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use Carbon\Carbon;

class CreateTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $languages = Language::all();
        $tags = [
            'classic' => [
                'en' => ['title' => 'Classic', 'description' => 'Category for classic content.'],
                'ja' => ['title' => 'クラシック', 'description' => 'クラシックコンテンツのカテゴリ。'],
                'ru' => ['title' => 'Классика', 'description' => 'Категория для классического контента.'],
                'zh' => ['title' => '经典', 'description' => '经典内容的类别。'],
            ],
            'events' => [
                'en' => ['title' => 'Events', 'description' => 'Category for events and activities.'],
                'ja' => ['title' => 'イベント', 'description' => 'イベントや活動のカテゴリ。'],
                'ru' => ['title' => 'События', 'description' => 'Категория для событий и мероприятий.'],
                'zh' => ['title' => '事件', 'description' => '活动和事件的类别。'],
            ],
            'news' => [
                'en' => ['title' => 'News', 'description' => 'General category for news.'],
                'ja' => ['title' => 'ニュース', 'description' => 'ニュースの一般的なカテゴリ。'],
                'ru' => ['title' => 'Новости', 'description' => 'Общая категория для новостей.'],
                'zh' => ['title' => '新闻', 'description' => '新闻的常规类别。'],
            ],
            'sales' => [
                'en' => ['title' => 'Sales', 'description' => 'Category for sales and promotions.'],
                'ja' => ['title' => 'セール', 'description' => 'セールやプロモーションのカテゴリ。'],
                'ru' => ['title' => 'Продажи', 'description' => 'Категория для акций и скидок.'],
                'zh' => ['title' => '销售', 'description' => '促销和销售类别。'],
            ],
            'live' => [
                'en' => ['title' => 'Live', 'description' => 'Category for live streams and events.'],
                'ja' => ['title' => 'ライブ', 'description' => 'ライブ配信やイベントのカテゴリ。'],
                'ru' => ['title' => 'Прямой эфир', 'description' => 'Категория для прямых эфиров и мероприятий.'],
                'zh' => ['title' => '直播', 'description' => '直播活动的类别。'],
            ],
            'path-nodes' => [
                'en' => ['title' => 'Nodes', 'description' => 'Category for nodes and paths.'],
                'ja' => ['title' => 'ノード', 'description' => 'ノードやパスのカテゴリ。'],
                'ru' => ['title' => 'Узлы', 'description' => 'Категория для узлов и путей.'],
                'zh' => ['title' => '节点', 'description' => '节点和路径的类别。'],
            ],
        ];

        DB::beginTransaction();

        try {
            $currentTime = Carbon::now();
            $insertedTags = [];

            foreach ($tags as $tag) {
                $insertedTags[] = [
                    'created_at' => $currentTime,
                    'updated_at' => $currentTime,
                ];
            }

            DB::table('tags')->insert($insertedTags);

            $tagIds = DB::table('tags')->pluck('id')->toArray();
            $translationsData = [];

            foreach ($languages as $language) {
                foreach ($tags as $key => $tag) {
                    if (isset($tag[$language->code])) {
                        $translationsData[] = [
                            'tag_id' => $tagIds[array_search($key, array_keys($tags))],
                            'language_id' => $language->id,
                            'title' => $tag[$language->code]['title'],
                            'description' => $tag[$language->code]['description'],
                            'created_at' => $currentTime,
                            'updated_at' => $currentTime,
                        ];
                    }
                }
            }

            DB::table('tags_translations')->insert($translationsData);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}


<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\CacheTrait;
use App\Traits\ExecutionTimeLoggerTrait;

class NewsController extends Controller
{
    use CacheTrait, ExecutionTimeLoggerTrait;

    private const ALLOWED_FIELDS = ['id', 'tags', 'news_id', 'language_id', 'title', 'description', 'image_url', 'content', 'created_at', 'updated_at'];

    public function index(Request $request): JsonResponse
    {
        $this->startExecution();
        $locale = $request->header('Accept-Language', 'en');
        $page = (int)$request->query('page', 1);
        $perPage = (int)$request->query('perPage', 10);

        $fieldsHeader = $request->header('X-Fields');
        $fields = $fieldsHeader ? explode(',', $fieldsHeader) : self::ALLOWED_FIELDS;

        $fields = array_intersect($fields, self::ALLOWED_FIELDS);

        if (empty($fields)) {
            return response()->json(['status' => 'Error', 'message' => 'No valid fields provided'], 400);
        }

        $language = Language::where('code', $locale)->firstOrFail();
        $cachePrefix = "news_index_x-fields-{$fieldsHeader}_per-page-{$perPage}_page-{$page}_language-{$language->code}";

        $news = $this->getFromCache($cachePrefix);

        if (!$news) {
            $news = News::with(['translations' => function ($query) use ($language) {
                $query->where('language_id', $language->id)
                    ->select(self::ALLOWED_FIELDS);
            }, 'tags' => function ($query) use ($language) {
                $query->with(['translations' => function ($q) use ($language) {
                    $q->where('language_id', $language->id);
                }]);
            }])
                ->select(['id', 'created_at', 'updated_at'])
                ->paginate($perPage);

            $news->getCollection()->transform(function ($item) use ($language, $fields) {
                $translation = $item->translations->where('language_id', $language->id)->first();

                $data = [];
                foreach ($fields as $field) {
                    switch ($field) {
                        case 'id':
                            $data['id'] = $item->id;
                            break;
                        case 'tags':
                            $data['tags'] = $item->tags->map(function ($tag) use ($language) {
                                return [
                                    'id' => $tag->id,
                                    'title' => $tag->translations->where('language_id', $language->id)->first()->title,
                                ];
                            });
                            break;
                        case 'news_id':
                            $data['news_id'] = $translation->news_id;
                            break;
                        case 'language_id':
                            $data['language_id'] = $translation->language_id;
                            break;
                        case 'title':
                            $data['title'] = $translation->title;
                            break;
                        case 'description':
                            $data['description'] = $translation->description;
                            break;
                        case 'image_url':
                            $data['image_url'] = $translation->image_url;
                            break;
                        case 'content':
                            $data['content'] = $translation->content;
                            break;
                        case 'created_at':
                            $data['created_at'] = $item->created_at;
                            break;
                        case 'updated_at':
                            $data['updated_at'] = $item->created_at;
                            break;
                    }
                }

                return $data;
            });

            $this->putInCache($cachePrefix, $news);
        }

        $this->logExecutionTime('NewsController::index');
        return response()->json(['status' => 'Success', 'message' => $news], 200);

    }

    public function show($id)
    {
        // Код для метода show
    }

    public function store()
    {
        // Код для метода store
    }

    public function update()
    {
        // Код для метода update
    }

    public function destroy()
    {
        // Код для метода destroy
    }

    public function searchByTag()
    {
        // Код для метода searchByTag
    }
}

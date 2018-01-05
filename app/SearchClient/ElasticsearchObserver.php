<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/3/17
 * Time: 11:01 PM
 */

namespace App\SearchClient;

use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;
use App\Plan;


class ElasticsearchObserver
{
    private $elasticSearch;

    public function __construct(Client $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    public function created(Model $model)
    {
        if ($model->business) {
            $this->elasticSearch->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);
        }
    }

    public function saved(Model $model)
    {
        if ($model->business) {
            $this->elasticSearch->update([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => ['doc' => $model->toSearchArray()]
            ]);
        }

    }

    public function deleted(Model $model)
    {
        $this->elasticSearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->id,
        ]);
    }
}
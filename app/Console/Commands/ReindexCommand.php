<?php

namespace App\Console\Commands;

use App\Business;
use App\Plan;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    protected $name = "search:reindex";
    protected $description = "Indexes all plans to elasticsearch";
    private $search;

    public function __construct(Client $search)
    {
        parent::__construct();

        $this->search = $search;
    }

    public function handle()
    {
        $this->output->write("building index.... \n");
        $this->buildPlanIndex(); // builds schema
        $this->output->write("index built \n");


        $this->info('Indexing all plans. Might take a while...');
        foreach (Plan::cursor() as $model) {

            if($model->business) {
                $body = $model->toSearchArray();
                $location = ['lat' => $model->business->lat,'lon' => $model->business->lng];
                $body['location'] = $location;

                $this->search->index([
                    'index' => $model->getSearchIndex(),
                    'type' => $model->getSearchType(),
                    'id' => $model->id,
                    'body' => $body,
                ]);
            }
        }

        $this->info("\nDone!");
    }

    public function buildPlanIndex() {
        // structure == localhost:9200/{index}/{type}
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'plans',
            'body' => [
                'settings' => [
                    'number_of_shards' => 5,
                    'number_of_replicas' => 1
                ],
                'mappings' => [
                    'plans' => [ // type
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'stripe_plan_name' => [
                                'type' => 'string',
                                'analyzer' => 'english'
                            ],
                            'id' => [
                                'type' => 'integer',
                                'index' => 'not_analyzed'
                            ],
                            'description' => [
                                'type' => 'string',
                                'analyzer' => 'english'
                            ],
                            "location" => [
                                "type" => "geo_point"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $client->indices()->create($params);
    }



}
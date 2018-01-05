<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/6/17
 * Time: 11:14 PM
 */

namespace App\Repositories;


use App\Plan;
use Elasticsearch\Client;

class ESRepository
{
    private $search;

    public function __construct(Client $client) {

        $this->search = $client;
    }
}
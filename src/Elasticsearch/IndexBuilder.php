<?php
/**
 * Created by PhpStorm.
 * User: Artan
 * Date: 26.12.18
 * Time: 22:51
 */

namespace App\Elasticsearch;
use Elastica\Client;
use Symfony\Component\Yaml\Yaml;


class IndexBuilder
{
    private $clinet;

    public function __construct(Client $client)
    {
        $this->clinet = $client;
    }

    public function create()
    {
        $index = $this->clinet->getIndex('blog');

        $settings = Yaml::parse(
            file_get_contents(
                __DIR__.'/../../config/elasticsearch_index_blog.yaml'
            )
        );

        // We build our index settings and mapping
        $index->create($settings, true);

        return $index;
    }

}
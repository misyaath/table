<?php

namespace App\ElasticSearch;

class Config
{
    public function password()
    {
        return config('services.elasticsearch.password');
    }

    public function host(): string
    {
        return 'https://' . config('services.elasticsearch.host') . ":" . config('services.elasticsearch.port');
    }

    public function username()
    {
        return config('services.elasticsearch.user');
    }

    public function certificate()
    {
        return config('services.elasticsearch.cert');
    }
}

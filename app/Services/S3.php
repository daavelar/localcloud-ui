<?php

namespace App\Services;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

class S3
{
    public static function getClient()
    {
        return new S3Client([
            'version' => 'latest',
            'region' => config('services.aws.region'),
            'endpoint' => config('services.aws.endpoint'),
            'use_path_style_endpoint' => true,
            'credentials' => new Credentials(config('services.aws.key'), config('services.aws.secret'))
        ]);
    }
}

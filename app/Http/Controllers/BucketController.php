<?php

namespace App\Http\Controllers;

use App\Services\S3;
use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class BucketController extends Controller
{
    private $s3;

    public function __construct()
    {
        $this->s3 = S3::getClient();
    }

    public function index()
    {
        try {
            $result = $this->s3->listBuckets();
            return response()->json($result['Buckets']);
        } catch (AwsException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

public function show($name)
{
    try {
        $location = $this->s3->getBucketLocation([
            'Bucket' => $name,
        ]);

        $objects = $this->s3->listObjectsV2([
            'Bucket' => $name,
        ]);

        return response()->json([
            'location' => $location['LocationConstraint'],
            'objects' => $objects['Contents'] ?? []
        ]);
    } catch (AwsException $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->s3->createBucket([
                'Bucket' => $request->name,
            ]);
            return response()->json(['message' => 'Bucket created successfully']);
        } catch (AwsException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($name)
    {
        try {
            $this->s3->deleteBucket([
                'Bucket' => $name,
            ]);
            return response()->json(['message' => 'Bucket deleted successfully']);
        } catch (AwsException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

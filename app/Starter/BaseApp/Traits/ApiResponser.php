<?php
namespace App\Starter\BaseApp\Traits;

use Throwable;
use Spatie\Fractal\Facades\Fractal;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

trait ApiResponser
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code = 500)
    {
        return response()->json([
            'error' => $message, 'code' => $code
        ], $code);
    }

    protected function showOne(?Model $instance, $code = 200, $transformer = null, $resourceName = null, $meta = [])
    {
        $return = $this->transformDataMod($instance, $transformer, $resourceName, $meta);
        return $this->successResponse($return, $code);
    }

    protected function transformDataMod($data, $transformer, $resourceName = null, $meta = [])
    {
        if (empty($data)) {
            return $this->successResponse(['data' => []]);
        }
        return fractal($data, new $transformer)
            ->serializeWith(new JsonApiSerializer())
            ->withResourceName($resourceName)
            ->addMeta($meta)
            ->toArray();
    }

    protected function transformDataModInclude($data, $include, $transformer, $resourceName = null, $meta = [])
    {
        if (empty($data) && empty($meta)) {
            return $this->successResponse(['data' => []]);
        } elseif (empty($data) && count($meta) > 0) {
            return fractal(null, $transformer)
                ->withResourceName($resourceName)
                ->parseIncludes($include)
                ->addMeta($meta)
                ->toArray();
        } else {
            return fractal($data, $transformer)
                ->serializeWith(new JsonApiSerializer())
                ->withResourceName($resourceName)
                ->parseIncludes($include)
                ->addMeta($meta)
                ->toArray();
        }
    }
}

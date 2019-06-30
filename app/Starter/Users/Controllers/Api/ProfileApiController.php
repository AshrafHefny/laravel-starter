<?php

namespace App\Starter\Users\Controllers\Api;

use Exception;
use App\Starter\Users\User;
use Illuminate\Support\Facades\Auth;
use Swis\JsonApi\Client\Interfaces\ParserInterface;
use App\Starter\BaseApp\Requests\BaseApiTokenRequest;
use App\Starter\BaseApp\Controllers\BaseApiController;
use App\Starter\BaseApp\Controllers\Enums\ResourceTypes;
use App\Starter\Users\Requests\Api\UpdateProfileRequest;
use App\Starter\Incidents\Transformers\IncidentListTransformer;

class ProfileApiController extends BaseApiController
{
    public $parserInterface;

    public function __construct(ParserInterface $parserInterface)
    {
        $this->parserInterface = $parserInterface;
        $this->user = Auth::guard('api')->user();
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            //parse data from jsonapi request body
            $data = $request->getContent();
            $data = $this->parserInterface->deserialize($data);
            $data = $data->getData();

            $this->user->update([
                    'name' => $data->name,
                    'profile_picture' => $data->profile_picture,
                ]);
            return $this->successResponse([
                    'meta'  => [
                        'message' => trans('api.Profile updated successfully')
                    ]
                ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => $e->getCode(),
                    'title' => $e->getMessage(),
                    'detail' => $e->getTrace()
                ],
                500
            );
        }
    }
}

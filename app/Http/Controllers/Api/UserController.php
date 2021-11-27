<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends ApiController
{

    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * @param \App\Services\UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * List users and filter controller
     */
    public function index(SearchRequest $request)
    {
        return UserResource::collection($this->userService->search());
    }

    public function store(StoreRequest $request)
    {
        return new UserResource($this->userService->store($request, $request->user()));
    }

    /**
     * delete: Delete user
     *
     * @param string $id uuid
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\PermissionException
     */
    public function destroy($id)
    {
        $this->userService->delete($id);

        return $this->responseSuccess(trans('message.delete_success'));
    }

    public function show($id){
        $user = $this->userService->getDetail($id);
        if(is_null($user)){
            return $this->responseError(trans('message.not_found'));
        }

        return new UserResource($user);
    }
}

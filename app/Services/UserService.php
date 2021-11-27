<?php

namespace App\Services;

use App\Exceptions\PermissionException;
use App\Repositories\UserRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    /**
     * @param \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create filter and response list by conditions
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function search($conditions = [])
    {
        $this->makeBuilder($conditions);

        /**
         * When users search by email, need to search with LIKE condition and process all records
         */
        if ($this->filter->has('email')) {
            $this->builder->where('email', 'LIKE', '%' . $this->filter->get('email') . '%');

            // Remove condition after apply query builder
            $this->cleanFilterBuilder('email');
        }

        return $this->endFilter();
    }

    /**
     * Save data to database from request
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|void
     * @throws \App\Exceptions\PermissionException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request, Authenticatable $user)
    {
        $id = $request->input('id');
        $data = $request->toArray();
        if (!$user->is_super_admin) {
            // Clean data for other permission
            $data = array_diff_key($data, array_flip(['is_super_admin', 'code']));
        }

        // Check parameter name ID from request.
        // If ID is empty, action is create a new record
        if (!$id) {
            if (!$user->can('create', $this->getModel())) {
                throw new PermissionException(trans('message.permission_not_granted'));
            }

            // Format password text to hash
            $data['password'] = Hash::make($data['password']);

            return $this->repository->create($data);
        }
    }

    public function delete($id)
    {
        $record = $this->find($id);
        $user = auth()->user();

        // Check user
        if(!$user->can('delete', $record)){
            throw new PermissionException(trans('message.permission_not_granted'));
        }

        $record->delete();

        return true;
    }
}

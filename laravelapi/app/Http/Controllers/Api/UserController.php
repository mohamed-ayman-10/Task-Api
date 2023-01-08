<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $users = UserResource::collection(User::all());
        return $this->ApiResponse(200, $users, 'ok');
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return $this->ApiResponse(200, new UserResource($user), 'ok');
        }
        return $this->ApiResponse(404, [], 'The User Not Found');
    }

    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|min:3|max:20',
        //     'email' => 'required|string|email|unique:users,email',
        //     'password' => 'required|string|min:3|max:20'
        // ]);

        // if ($validator->fails()) {
        //     return $this->ApiResponse(400, [], $validator->errors());
        // }

        $user = User::create($request->all());
        if ($user) {
            return $this->ApiResponse(201, new UserResource($user), 'Created');
        }
        return $this->ApiResponse(400, [], 'Not Created');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->ApiResponse(404, [], 'User Not Found');
        }

        $user->update($request->all());
        if ($user) {
            return $this->ApiResponse(201, new UserResource($user), 'Updated');
        }
        return $this->ApiResponse(400, [], 'Not Update');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->ApiResponse(404, [], 'User Not Found');
        }

        User::destroy($id);
        if ($user) {
            return $this->ApiResponse(201, new UserResource($user), 'Deleted');
        }
    }
}

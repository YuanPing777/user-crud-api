<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkDeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $error_msg = '';
        $data = [];

        try {
            $query = User::query();

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            $data = $query->paginate(10);
            
        } catch (\Throwable $th) {
            //throw $th;
            $error_msg = 'Error';
        }

        return $this->jsonResponse($error_msg, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        $error_msg = '';
        $data = [];

        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $data = User::create($data);

        } catch (\Throwable $th) {
            //throw $th;
            $error_msg = 'Error';
        }

        return $this->jsonResponse($error_msg, $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $error_msg = '';
        $data = [];

        try {
            $user = User::findOrFail($id);
            $data = $user;

        } catch (\Throwable $th) {
            $error_msg = 'User not found.';
        }

        return $this->jsonResponse($error_msg, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $error_msg = '';
        $data = [];

        try {
            $user = User::findOrFail($id);
            $user->delete();
            $data = ['id' => $id];

        } catch (\Throwable $th) {
            $error_msg = 'Unable to delete user.';
        }

        return $this->jsonResponse($error_msg, $data);
    }

    public function bulkDelete(BulkDeleteUserRequest $request)
    {
        $error_msg = '';
        $data = [];

        try {
            $ids = $request->validated()['ids'];
            User::whereIn('id', $ids)->delete();
            $data = ['ids' => $ids];

        } catch (\Throwable $th) {
            $error_msg = 'Bulk delete failed.';
        }

        return $this->jsonResponse($error_msg, $data);
    }

    private function jsonResponse($error_msg, $data)
    {
        $responseCode = ($error_msg=='') ? 200 : 500;
        $msgType = ($error_msg=='') ? 'success' : 'error';
        $message = ($error_msg=='') ? 'complete' : $error_msg;

        return response()->json([
            'responseCode' => $responseCode,
            'msgType' => $msgType,
            'message' => [$message],
            'data' => $data,
        ], 200);
    }
}

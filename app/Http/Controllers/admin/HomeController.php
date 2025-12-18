<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function home()
    {
        try {
            $users = User::select('id', 'name', 'email', 'image', 'status')->latest()->get();
            return view('admin.home', compact('users'));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function userApproval(ApprovalRequest $request)
    {
        try {
            $value = (int) $request->value;
            $user = User::findOrFail($request->user_id);

            $user->status = $value;
            $user->save();

            $messageKey = $value == 1 ? 'approved' : 'rejected';

            return response()->json([
                'status' => true,
                'message' => "User {$messageKey}",
                'status_label' => $user->status == 1 ? 'Active' : 'Inactive'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => "User not found"
            ], Response::HTTP_FORBIDDEN);
        } catch (\Throwable $th) {
            info($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => "Something went wrong"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

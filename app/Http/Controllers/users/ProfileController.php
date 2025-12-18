<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $user = Auth::guard('web_tenant')->user();
            return view('user-profile', compact('user'));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        try {
            $user = User::findOrFail((int) $request->user_id);

            DB::transaction(function () use ($request, $user) {

                // Handle profile image
                if ($request->hasFile('profile_image')) {

                    // Delete old image if exists
                    if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                        Storage::disk('public')->delete($user->profile_image);
                    }

                    $file = $request->file('profile_image');
                    $fileName = Str::uuid() . '.' . $file->extension();

                    $path = $file->storeAs('profile', $fileName, 'public');

                    // Save new image path
                    $user->image = $path;
                }

                // Update other fields
                $user->name  = $request->input('name');
                $user->email = $request->input('email');
                $user->save();
            });

            return redirect()->back()->with('message', 'User profile updated.');
        } catch (\Throwable $th) {
            info($th->getMessage());

            return redirect()
                ->route('user.profile')
                ->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

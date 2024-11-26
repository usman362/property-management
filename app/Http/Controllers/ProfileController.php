<?php

namespace App\Http\Controllers;

use App\Models\FileManager;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\TenantDetails;
use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    use ResponseTrait;
    public function myProfile()
    {
        $data['pageTitle'] = __('My Profile');

        return view('common.profile.my-profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        $authId = auth()->id();
        $request->validate([
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,' . $authId,
            'contact_number' => 'bail|numeric|unique:users,contact_number,' . $authId,
        ]);

        try {
            DB::beginTransaction();
            $user = User::find($authId);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->contact_number = $request->contact_number;
            $user->date_of_birth = $request->date_of_birth;
            $user->nid_number = $request->nid_number;
            if (auth()->user()->role == USER_ROLE_ADMIN || auth()->user()->role == USER_ROLE_OWNER) {
                $user->email = $request->email;
            }
            $user->save();
            /*File Manager Call upload*/
            if ($request->image) {
                $new_file = FileManager::where('origin_type', 'App\Models\User')->where('origin_id', $user->id)->first();

                if ($new_file) {
                    $new_file->removeFile();
                    $upload = $new_file->updateUpload($new_file->id, 'User', $request->image);
                } else {
                    $new_file = new FileManager();
                    $upload = $new_file->upload('User', $request->image);
                }

                if ($upload['status']) {
                    $upload['file']->origin_id = $user->id;
                    $upload['file']->origin_type = "App\Models\User";
                    $upload['file']->save();
                } else {
                    throw new Exception($upload['message']);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('success', $e->getMessage());
        }

        return redirect()->back()->with('success', __('Updated Successfully'));
    }

    public function changePassword()
    {
        $data['pageTitle'] = __('Change Password');
        return view('common.profile.change-password', $data);
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', __('Updated Successfully'));
        } else {
            return redirect()->back()->with('error', 'Current password does not matched!');
        }
    }

    public function deleteMyAccount(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $authUser = Auth::user();
            if (!Hash::check($request->password, $authUser->password) || $authUser->email != $request->email) {
                throw new Exception(__('Information does not matched!'));
            }
            if ($authUser->role == USER_ROLE_ADMIN || $authUser->role == USER_ROLE_OWNER) {
                throw new Exception(__('This is admin account'));
            }
            $user = User::find($authUser->id);
            $user->status = USER_STATUS_DELETED;
            $user->save();
            DB::commit();
            auth()->logout();
            return $this->success([], __('Account Deleted Successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}

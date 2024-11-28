<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermissionTo("view-users"))
            return back();

        $data['navUsersMMShowClass'] = 'mm-show';
        $data['subNavAllUsersMMActiveClass'] = 'mm-active';
        $data['subNavAllUsersActiveClass'] = 'active';
        $data['pageTitle'] = __('Users');
        $data['users'] = User::all();
        return view('owner.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo("add-users"))
            return back();

        $data['navUsersMMShowClass'] = 'mm-show';
        $data['subNavAllUsersMMActiveClass'] = 'mm-active';
        $data['subNavAllUsersActiveClass'] = 'active';
        $data['pageTitle'] = __('Add User');
        $data['roles'] = Role::all();
        return view('owner.users.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("add-users"))
            throw new \Exception('Not allowed');

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'contact_number' => [
                Rule::unique('users', 'contact_number')->ignore($request->id),
            ],
            'role' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if (empty($user)) {
                $user = new User();
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->contact_number = $request->contact_number;
            $user->status = 1;
            $user->created_by = auth()->user()->id ?? 0;
            $user->save();
            $user->assignRole($request->role);
            DB::commit();
            $message = $request->id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success($user, $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }

        // return  redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo("edit-users"))
            return back();

        $data['navUsersMMShowClass'] = 'mm-show';
        $data['subNavAllUsersMMActiveClass'] = 'mm-active';
        $data['subNavAllUsersActiveClass'] = 'active';
        $data['pageTitle'] = __('Edit User');
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        return view('owner.users.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo("delete-users"))
            return back();

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();
            DB::commit();
            return  redirect()->back()->with('success', __('Deleted Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('info', $e->getMessage());
        }
    }
}

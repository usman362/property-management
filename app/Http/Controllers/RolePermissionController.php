<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ResponseTrait;
    public function index()
    {
        if (!auth()->user()->hasPermissionTo("view-roles"))
            return back();

        $data['navRolesMMShowClass'] = 'mm-show';
        $data['subNavAllRolesMMActiveClass'] = 'mm-active';
        $data['subNavAllRolesActiveClass'] = 'active';
        $data['pageTitle'] = __('Roles & Permissions');
        $data['roles'] = Role::all();
        return view('owner.roles-permissions.roles-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo("add-roles"))
            return back();

        $data['navRolesMMShowClass'] = 'mm-show';
        $data['subNavAllRolesMMActiveClass'] = 'mm-active';
        $data['subNavAllRolesActiveClass'] = 'active';
        $data['pageTitle'] = __('Add Roles & Permissions');
        $data['permissions'] = Permission::all();
        return view('owner.roles-permissions.add-role', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("add-roles"))
            throw new \Exception('Not allowed');

        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($request->id),
            ],
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,name', // Ensure permissions are valid
        ]);

        DB::beginTransaction();
        try {
            // Create or update the role
            $role = Role::updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->input('name')]
            );

            // Sync permissions using names
            $role->syncPermissions($request->input('permission'));

            DB::commit();

            $message = $request->id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success($role, $message);
        } catch (\Exception $e) {
            DB::rollBack();

            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
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
        if (!auth()->user()->hasPermissionTo("edit-roles"))
            return back();

        $data['navRolesMMShowClass'] = 'mm-show';
        $data['subNavAllRolesMMActiveClass'] = 'mm-active';
        $data['subNavAllRolesActiveClass'] = 'active';
        $data['pageTitle'] = __('Edit Roles & Permissions');
        $data['permissions'] = Permission::all();
        $data['role'] = Role::find($id);
        return view('owner.roles-permissions.add-role', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        if (!auth()->user()->hasPermissionTo("delete-roles"))
            return back();

        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return redirect(route('roles-permissions.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}

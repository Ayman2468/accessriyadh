<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        $rolePermissions = $this->getRolePermissions($roles->first(),$permissions);
        return response()->json(['roles' => $roles,'selected_role' => $roles->first(),'permissions'=>$rolePermissions], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $permissions = Permission::get();
        return response()->json(['permissions' => $permissions], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $roleAdmin = new Role();
        $roleAdmin->name = $request->name;
        //  $roleAdmin->description = $request->description;
        $roleAdmin->save();
        $permissions = [];
        foreach ($request->permissions as $permission) {
            if(isset($permission['is_role_has_a_permission']) and $permission['is_role_has_a_permission']) array_push($permissions,$permission['id']);
        }
        $roleAdmin->syncPermissions($permissions);
        $roles = Role::get();
        $permissions = Permission::get();
        $rolePermissions = $this->getRolePermissions($roleAdmin,$permissions);
        return response()->json(['roles' => $roles, 'permissions' => $rolePermissions], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = $this->getRolePermissions($role,$permissions);
        return response()->json(['role' => $role, 'permissions' => $rolePermissions], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $roleAdmin = Role::find($id);
        $roleAdmin->name = $request->name;
        $roleAdmin->save();
        $permissions = [];
        foreach ($request->permissions as $permission) {
            if($permission['is_role_has_a_permission']) array_push($permissions,$permission['id']);
        }
        $roleAdmin->revokePermissionTo(Permission::all());

        $roleAdmin->syncPermissions($permissions);
        $roles = Role::get();
        return response()->json(['roles' => $roles], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $roleAdmin = Role::find($id);
        $roleAdmin->revokePermissionTo(Permission::all());
        $roleAdmin->delete();
        $roles = Role::get();
        $permissions = Permission::get();
        $rolePermissions = $this->getRolePermissions($roles->first(),$permissions);
        return response()->json(['roles' => $roles,'selected_role' => $roles->first(),'permissions'=>$rolePermissions], 200);

    }

    private function getRolePermissions($role, $permissions)
    {
        $rolePermissions = [];
        $flag = false;
        foreach ($permissions as $permission) {
            foreach ($role->load('permissions')->permissions as $rolePermission) {
                if ($rolePermission->id == $permission->id){
                    $flag = true;
                    break;
                }
            }
            array_push($rolePermissions,['id'=>$permission->id,'name'=>$permission->name,'is_role_has_a_permission'=>$flag]);
            $flag = false;

        }
        return $rolePermissions;
    }
}

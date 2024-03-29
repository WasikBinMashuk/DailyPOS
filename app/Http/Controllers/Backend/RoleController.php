<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();
        return view('backend.roles.index', compact('roles', 'permissions', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:255',
        ]);

        Role::create(['name' => $request->roleName]);

        // sweet alert
        toast('New Role added!', 'success');

        return redirect()->back();
    }

    // public function rolesShow()
    // {
    //     $roles = Role::orderBy('id', 'ASC')->paginate(10);
    //     return view('backend.roles.roles', compact('roles'));
    // }

    // public function roleEdit($id)
    // {
    //     try {
    //         $editRole = Role::findOrFail($id);
    //         return view('backend.roles.editRole', compact('editRole'));
    //     } catch (Exception $e) {
    //         // dd($e->getMessage());
    //         toast('Something went wrong', 'error');
    //         return redirect()->back();
    //     }
    // }

    // public function roleUpdate(Request $request)
    // {   
        
    //     $request->validate([
    //         'name' => 'required|string|min:1|max:255',
    //     ]);

    //     try {
    //         Role::where('id', $request->id)->first()->update([
    //             'name' => $request->name,
    //         ]);

    //         // sweet alert
    //         toast('Data Updated!', 'success');
    //     } catch (Exception $e) {
    //         // dd($e->getMessage());
    //         toast('Something went wrong', 'error');
    //     }

    //     return redirect()->route('roles.show');
    // }

    public function permissionStore(Request $request)
    {
        $request->validate([
            'permissionName' => 'required|string|max:255',
        ]);

        Permission::create(['name' => $request->permissionName]);

        // sweet alert
        toast('New Permission added!', 'success');

        return redirect()->back();
    }

    public function rolePermissionStore(Request $request)
    {
        //If no role is selected it will show an error toast
        if (!$request->role_id) {
            // sweet alert
            toast('Select a role!', 'error');

            return redirect()->back();
        }

        $permissions = $request->input('permission_id');

        $role = Role::findById($request->role_id);
        $role->syncPermissions([]); //This will remove all previous permissions from the role
        $role->givePermissionTo($permissions); //This will add the new permissions if there is any

        // sweet alert
        toast('Permissions assigned to Roles!!', 'success');

        return redirect()->back();
    }

    public function userRoleStore(Request $request)
    {
        //If no user is selected it will show an error toast
        if (!$request->user_id) {
            // sweet alert
            toast('Select an User!', 'error');

            return redirect()->back();
        }

        $roles = $request->input('role_id');

        $user = User::find($request->user_id);
        $user->syncRoles([]); //This will remove all previous roles of the user
        $user->syncRoles($roles); //This will add the new roles if there is any

        // sweet alert
        toast('Roles assigned to User!', 'success');

        return redirect()->back();
    }

    public function userPermissionStore(Request $request)
    {
        //If no user is selected it will show an error toast
        if (!$request->user_id) {
            // sweet alert
            toast('Select an User!', 'error');

            return redirect()->back();
        }

        $permissions = $request->input('permission_id');

        $user = User::find($request->user_id);
        $user->syncPermissions([]); //This will remove all previous roles of the user
        $user->syncPermissions($permissions); //This will add the new roles if there is any

        // sweet alert
        toast('Permissions assigned to User!', 'success');

        return redirect()->back();
    }

    public function getPermissions(Request $request)
    {
        $cid = $request->post('cid');

        $allPermissions  = Permission::all();

        $permissions = Role::findById($cid)->permissions;

        $html = '';

        foreach ($allPermissions as $allPermission) {
            $flag = 0;
            foreach ($permissions as $permission) {
                if ($allPermission->id == $permission->id) {
                    $flag = 1;
                }
            }
            if ($flag == 1) {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]"
                            value="' . $allPermission->id . '" checked />
                        <span class="form-check-label">' . $allPermission->name . '</span>
                    </label>';
            } else {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]"
                            value="' . $allPermission->id . '"  />
                        <span class="form-check-label">' . $allPermission->name . '</span>
                    </label>';
            }
        }
        echo $html;
    }

    public function getUserRole(Request $request)
    {
        $cid = $request->post('cid');

        $allRoles  = Role::all();

        $user = User::find($cid); // Replace with your user instance

        $roleIds = $user->roles->pluck('id')->toArray();

        $html = '';

        foreach ($allRoles as $allRole) {
            $flag = 0;
            foreach ($roleIds as $roleId) {
                if ($allRole->id == $roleId) {
                    $flag = 1;
                }
            }
            if ($flag == 1) {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="role_id[]"
                            value="' . $allRole->id . '" checked />
                        <span class="form-check-label">' . $allRole->name . '</span>
                    </label>';
            } else {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="role_id[]"
                            value="' . $allRole->id . '"  />
                        <span class="form-check-label">' . $allRole->name . '</span>
                    </label>';
            }
        }
        echo $html;
    }

    public function getUserPermission(Request $request)
    {
        $cid = $request->post('cid');

        $allPermissions  = Permission::all();

        $user = User::find($cid);

        $usersPermissions = $user->permissions;

        $html = '';

        foreach ($allPermissions as $allPermission) {
            $flag = 0;
            foreach ($usersPermissions as $usersPermission) {
                if ($allPermission->id == $usersPermission->id) {
                    $flag = 1;
                }
            }
            if ($flag == 1) {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]"
                            value="' . $allPermission->id . '" checked />
                        <span class="form-check-label">' . $allPermission->name . '</span>
                    </label>';
            } else {
                $html .= '<label class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]"
                            value="' . $allPermission->id . '"  />
                        <span class="form-check-label">' . $allPermission->name . '</span>
                    </label>';
            }
        }
        echo $html;
    }

}

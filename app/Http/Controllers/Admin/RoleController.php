<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->route('admin.roles')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.roles')->with('error', 'Role not found or could not be deleted.');
        }
    }
}

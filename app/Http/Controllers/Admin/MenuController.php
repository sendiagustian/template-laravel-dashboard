<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function delete($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect()->route('admin.menus')->with('success', 'Menu deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.menus')->with('error', 'Menu not found or could not be deleted.');
        }
    }
}

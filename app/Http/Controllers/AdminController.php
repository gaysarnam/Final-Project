<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use App\Models\MenuCategory;
use App\Models\RestaurantMenu;
use App\Models\Room;
use App\Models\SpaCategory;
use App\Models\SpaService;
use App\Models\RestaurantTable; // Imported for Table Management
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // --- USER MANAGEMENT ---

    public function userIndex() {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.users', compact('users'));
    }

    public function toggleStatus($id) {
        $user = User::findOrFail($id);
        $user->status = ($user->status == 'Active') ? 'Blocked' : 'Active';
        $user->save();
        return back()->with('success', 'User status updated!');
    }

    public function promoteUser($id) {
        $user = User::findOrFail($id);
        $user->usertype = ($user->usertype == '1') ? '0' : '1';
        $user->save();
        return back()->with('success', 'User role updated successfully');
    }

    // --- FEEDBACK MANAGEMENT ---

    public function feedbackIndex() {
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function deleteFeedback($id) {
        Feedback::findOrFail($id)->delete();
        return back()->with('success', 'Feedback removed successfully');
    }

    // --- RESTAURANT MENU & TABLE MANAGEMENT ---

    public function menuIndex() {
        $categories = MenuCategory::all();
        $menus = RestaurantMenu::with('category')->get();
        $tables = RestaurantTable::all(); // Fetching tables for the inventory section
        return view('admin.menu', compact('categories', 'menus', 'tables'));
    }

    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|unique:menu_categories,name',
            'item_types' => 'required' 
        ]);
        MenuCategory::create([
            'name' => $request->name,
            'item_types' => $request->item_types 
        ]);
        return back()->with('success', 'Category added!');
    }

    public function deleteCategory($id) {
        $category = MenuCategory::findOrFail($id);
        $menus = RestaurantMenu::where('category_id', $id)->get();
        foreach($menus as $menu) {
            if($menu->image && file_exists(public_path('images/menu/'.$menu->image))) { 
                @unlink(public_path('images/menu/'.$menu->image)); 
            }
            $menu->delete();
        }
        $category->delete();
        return redirect()->route('admin.menu')->with('success', 'Category and all related items deleted!');
    }

    public function storeMenu(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'item_types' => 'required', 
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/menu'), $imageName);

        RestaurantMenu::create([
            'name' => $request->name,
            'price' => 'Nu.' . $request->price,
            'category_id' => $request->category_id,
            'item_types' => $request->item_types,
            'image' => $imageName
        ]);

        return back()->with('success', 'Item added successfully!');
    }

    public function updateMenu(Request $request, $id) {
        $menu = RestaurantMenu::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'item_types' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if($menu->image && file_exists(public_path('images/menu/'.$menu->image))) { 
                @unlink(public_path('images/menu/'.$menu->image)); 
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $menu->image = $imageName;
        }

        $menu->name = $request->name;
        $menu->price = 'Nu.' . str_replace('Nu.', '', $request->price);
        $menu->category_id = $request->category_id;
        $menu->item_types = $request->item_types;
        $menu->save();

        return back()->with('success', 'Item updated successfully!');
    }

    public function deleteMenu($id) {
        $menu = RestaurantMenu::findOrFail($id);
        if($menu->image && file_exists(public_path('images/menu/'.$menu->image))) { 
            @unlink(public_path('images/menu/'.$menu->image)); 
        }
        $menu->delete();
        return back()->with('success', 'Item deleted successfully!');
    }
    public function updateCategory(Request $request, $id)
{
        // 1. Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255|unique:menu_categories,name,' . $id,
            'item_types' => 'required|string',
        ]);

        // 2. Find the category or fail
        $category = \App\Models\MenuCategory::findOrFail($id);

        // 3. Update the fields
        $category->update([
            'name' => $request->name,
            'item_types' => $request->item_types,
        ]);

        // 4. Redirect back with the correct view preserved
        return redirect()->back()->with([
            'success' => 'Category updated successfully!',
            'redirect_view' => 'manageCategoryView'
        ]);
    }

// --- RESTAURANT TABLE INVENTORY ACTIONS ---

public function storeTable(Request $request) {
    $request->validate([
        'table_no'    => 'required|unique:restaurant_tables,table_no',
        'chairs'      => 'required|integer|min:1',
        'description' => 'required|string|max:500',
    ]);

    \App\Models\RestaurantTable::create([
        'table_no'    => $request->table_no,
        'chairs'      => $request->chairs,
        'description' => $request->description,
    ]);

    return back()->with('success', 'Table Added Successfully!');
}

public function updateTable(Request $request, $id) {
    $table = \App\Models\RestaurantTable::findOrFail($id);

    $request->validate([
        'table_no'    => 'required|unique:restaurant_tables,table_no,' . $id,
        'chairs'      => 'required|integer|min:1',
        'description' => 'required|string|max:500',
    ]);

    $table->update([
        'table_no'    => $request->table_no,
        'chairs'      => $request->chairs,
        'description' => $request->description,
    ]);

    return back()->with('success', 'Table Updated Successfully!');
}

// ✅ ADD THIS MISSING METHOD:
public function deleteTable($id) {
    try {
        $table = \App\Models\RestaurantTable::findOrFail($id);
        $table->delete();
        return back()->with('success', 'Table Deleted Successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Failed to delete table: ' . $e->getMessage()]);
    }
}
    

    // --- ROOMS MANAGEMENT ---

    public function roomIndex() {
        $rooms = Room::latest()->get();
        return view('admin.rooms', compact('rooms'));
    }

    public function storeRoom(Request $request) {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'amenities'=>'required',
            'image'=>'required|image|max:2048'
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/rooms'), $imageName);

        Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'amenities' => $request->amenities,
            'image' => $imageName,
        ]);
        return back()->with('success', 'Room Added Successfully');
    }

    public function updateRoom(Request $request, $id) {
        $room = Room::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'amenities'=>'required',
            'image'=>'nullable|image|max:2048'
        ]);

        if($request->hasFile('image')){
            if($room->image && file_exists(public_path('images/rooms/'.$room->image))) { 
                @unlink(public_path('images/rooms/'.$room->image)); 
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/rooms'), $imageName);
            $room->image = $imageName;
        }
        
        $room->update($request->only(['name','description','price','amenities']));
        return back()->with('success', 'Changes Saved Successfully');
    }

    public function toggleRoomStatus($id) {
        $room = Room::findOrFail($id);
        $room->status = ($room->status == 'available') ? 'unavailable' : 'available';
        $room->save();
        return response()->json(['status' => $room->status]);
    }

    public function deleteRoom($id) {
        $room = Room::findOrFail($id);
        if($room->image && file_exists(public_path('images/rooms/'.$room->image))) { 
            @unlink(public_path('images/rooms/'.$room->image)); 
        }
        $room->delete();
        return back()->with('success', 'Room Deleted Successfully');
    }


    // --- SPA MANAGEMENT ---

    public function spaIndex() {
        $categories = SpaCategory::all();
        $services = SpaService::with('category')->latest()->get();
        return view('admin.spa', compact('categories', 'services'));
    }

    public function storeSpaCategory(Request $request) {
        $request->validate(['name' => 'required|unique:spa_categories,name']);
        SpaCategory::create(['name' => $request->name]);
        return back()->with('success', 'Category Added Successfully');
    }

    public function deleteSpaCategory($id) {
        $cat = SpaCategory::findOrFail($id);
        $cat->delete(); 
        return back()->with('success', 'Category and its services deleted');
    }

    public function storeSpaService(Request $request) {
        $request->validate([
            'name'=>'required', 'price'=>'required', 'description'=>'required', 
            'duration'=>'required', 'category_id'=>'required', 'image'=>'required|image'
        ]);
    
        $imageName = time().'.'.$request->image->extension();
        // --- ADD THIS BLOCK ---
        $path = public_path('images/spa');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        // ----------------------  
        $request->image->move(public_path('images/spa'), $imageName);

        SpaService::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => 'Nu. ' . $request->price,
            'duration' => $request->duration,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);
        return back()->with('success', 'Spa Service Added Successfully');
    }

    public function storeSpaPackage(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'services_included' => 'required' 
        ]);

        SpaService::create([
            'name' => $request->name,
            'description' => $request->services_included, 
            'price' => 'Nu. ' . $request->price,
            'duration' => 'Package',
            'category_id' => $request->category_id,
            'image' => null, 
        ]);

        return back()->with('success', 'Package Added Successfully');
    }

    public function updateSpaService(Request $request, $id) {
        $service = SpaService::findOrFail($id);
        
        $request->validate([
            'name'=>'required', 'price'=>'required', 'description'=>'required', 
            'category_id'=>'required', 'image'=>'nullable|image|max:2048'
        ]);

        if($request->hasFile('image')){
            if($service->image && file_exists(public_path('images/spa/'.$service->image))) { 
                @unlink(public_path('images/spa/'.$service->image)); 
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/spa'), $imageName);
            $service->image = $imageName;
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = 'Nu. ' . str_replace('Nu. ', '', $request->price);
        $service->category_id = $request->category_id;
        
        if ($service->duration !== 'Package') {
            $service->duration = $request->duration;
        }

        $service->save();
        return back()->with('success', 'Item Updated Successfully');
    }

    public function deleteSpaService($id) {
        $service = SpaService::findOrFail($id);
        if($service->image) { 
            @unlink(public_path('images/spa/'.$service->image)); 
        }
        $service->delete();
        return back()->with('success', 'Service Deleted Successfully');
    }
}
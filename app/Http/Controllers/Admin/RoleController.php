<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Throwable;
class RoleController extends Controller
{
    public function index(){
        try {
            $roles = Role::orderBy('id','asc')->get();
            return view('admin.roles.index',compact('roles'));
            
        } catch (Throwable $th) {
           
            return redirect()->back()->with(['type' => 'error', 'message' =>'Roles could not be loaded.']);
        }

    }

    public function store(Request $request)
    {  
       
        $request->validate([
            'title' => 'required|min:2|max:255',
        ]);
        $type = $request->type;
      try {
         if ($type != 'update') {
            
             Role::create([
                'role_name' => $request->title,
                'status' => 1,
            ]);
              return redirect()->back()->with(['type' => 'success', 'message' =>'Role Created Successfully.']);
        }else{
            $id = $request->id;
            $data = Role::where('id', $id)->first();
            $data->update([
                'role_name' => $request->title
            ]);
            return redirect()->back()->with(['type' => 'success', 'message' =>'Role Updated Successfully.']);
        }    
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'The Role could not be saved.']);
        }
    }
    public function switchdata(Request $request)
    { 
        try {
            Role::find($request->id)->update([
                'status' => $request->status=="true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
           
            return $th;
        }
        return $request->status;
    }
    public function editrole(Request $request){
        
        $id = $request->id;
        $data = Role::where('id',$id)->first();
        return response()->json(['status' => true,'data'=> $data]);
    }
    public function delete($id){
       
        try {
                $data = Role::find($id);
                $data->delete();
                return redirect()->route('admin.role.index')->with(['type' => 'success', 'message' =>'Role has beed deieted .']);
            
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'The Role could not be deleted.']);
        }
    }
    public function show(Request $request)
    {  
        try {
        Role::find($request->id)->update([
            'status' => $request->status=="true" ? 1 : 0
        ]);
    } catch (Throwable $th) {
       
        return $th;
    }
    return $request->status;

    }
 

}

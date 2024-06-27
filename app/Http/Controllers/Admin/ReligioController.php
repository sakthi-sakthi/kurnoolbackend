<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Religio;
use App\Models\Log;
use App\Models\Option;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ReligioController extends Controller
{
    public function index()
    {
        try {
            $articles = Religio::all();
            return view('admin.religio.index',compact('articles'));
        } catch (Throwable $th) {
          return redirect()->back()->with(['type' => 'error', 'message' =>'Religio page could not be loaded.']);
        }
    }

    public function create()
    { 
        try {
            $categories = Category::whereIn('id',['11','12'])->get();
            $languages = Option::where('key','=','language')->orderBy('id','desc')->get();
            return view('admin.religio.create',compact('categories','languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Religio create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        //  dd($request->all());
        try {
            Religio::create([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'email' => $request->email,
                'phone' => $request->phone,
                'fathername' => $request->fathername,
                'mothername' => $request->mothername,
                'address' => $request->address,
                'priest_type' => $request->priest_type,
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'date_of_ordination' => $request->date_of_ordination, 
                'feast_day' => $request->feast_day, 
                'blood_group' => $request->blood_group, 
                'residence' => $request->residence, 
                'ministry' => $request->ministry, 
            ]);
            
            return redirect()->route('admin.religio.index')->with(['type' => 'success', 'message' =>'Religio details are Saved.']);

        } catch (Throwable $th) {
            dd($th);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio could not be saved.']);
        }
    }

    public function edit($id)
    { 
        try {
            $categories = Category::whereIn('id',['11','12'])->get();
            $value =Religio::where('id',$id)->first();
            return view('admin.religio.edit',compact('categories','value'));
        } catch (Throwable $th) {
            
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {
        
        $article =Religio::where('id' ,$id)->first();

        try {
                $article->update([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'email' => $request->email,
                'phone' => $request->phone,
                'fathername' => $request->fathername,
                'mothername' => $request->mothername,
                'address' => $request->address,
                'priest_type' => $request->priest_type,
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'date_of_ordination' => $request->date_of_ordination, 
                'feast_day' => $request->feast_day, 
                'blood_group' => $request->blood_group, 
                'residence' => $request->residence, 
                'ministry' => $request->ministry, 
                ]);
          
            return redirect()->route('admin.religio.index')->with(['type' => 'success', 'message' =>'Religio Has Been Updated.']);
        } catch (Throwable $th) {
            dd($th);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio could not be updated.']);
        }
    }

    public function delete($id)
    {
       
        try {
            $articledata = Religio::where('id',$id)->first();
            $articledata->delete();
            return redirect()->route('admin.religio.index')->with(['type' => 'success', 'message' =>'Religio To Recycle Bin.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Religio::onlyTrashed()->get();
            return view('admin.religio.trash',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Religio page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Religio::withTrashed()->find($id)->restore();
            return redirect()->route('admin.religio.trash')->with(['type' => 'success', 'message' =>'Religio Recovered.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio could not be recovered.']);
        }
    }

    public function destroy($id)
    {
    
        try {
            $article = Religio::withTrashed()->find($id);
            $article->forceDelete();
            return redirect()->route('admin.religio.trash')->with(['type' => 'warning', 'message' =>'Religio Deleted.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Religio could not be destroyed.']);
        }
    }

    public function switched(Request $request)
    {
        try {
            Religio::find($request->id)->update([
                'status' => $request->status=="true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
        }
        return $request->status;
    }
}

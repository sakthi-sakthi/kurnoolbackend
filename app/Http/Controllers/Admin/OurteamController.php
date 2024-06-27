<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Ourteam;
use App\Models\Log;
use App\Models\Option;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Throwable;

class OurteamController extends Controller
{
    public function index()
    {
        try {
            $articles = Ourteam::all();
            return view('admin.ourteam.index',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages page could not be loaded.']);
        }
    }

    public function create()
    { 
        try {
            $categories = Category::whereIn('id',['1','2'])->get();
            return view('admin.ourteam.create',compact('categories'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        try {
            Ourteam::create([
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'title' => $request->title,
                'content' => $request->content,
            ]);
            return redirect()->route('admin.ourteam.index')->with(['type' => 'success', 'message' =>'Messages Saved.']);

        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be saved.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages could not be saved.']);
        }
    }

    public function edit($ourteam)
    { 
        try {
            $categories = Category::all();
            $value =Ourteam::where('id',$ourteam)->first();
            return view('admin.ourteam.edit',compact('categories','value','languages'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {
        
        $article =Ourteam::where('id' ,$id)->first();
       
        $request->validate([
            'title' => 'required|min:3|max:255',
            'media_id' => 'nullable|numeric|min:1',
            'category_id' => 'nullable|numeric|min:1',
        ]);
        try {
                $article->update([
                    'media_id' => $request->media_id ?? 1,
                    'category_id' => $request->category_id ?? 1,
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
          
            return redirect()->route('admin.ourteam.index')->with(['type' => 'success', 'message' =>'Messages Has Been Updated.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be updated.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages could not be updated.']);
        }
    }

    public function delete($article)
    {
        try {
            $articledata = Ourteam::where('id',$article)->first();
            $articledata->delete();
            return redirect()->route('admin.ourteam.index')->with(['type' => 'success', 'message' =>'Messages To Recycle Bin.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Ourteam::onlyTrashed()->get();
            return view('admin.ourteam.trash',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Ourteam::withTrashed()->find($id)->restore();
            return redirect()->route('admin.ourteam.trash')->with(['type' => 'success', 'message' =>'Messages Recovered.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be recovered.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages could not be recovered.']);
        }
    }

    public function destroy($id)
    {
        try {
            $article = Ourteam::withTrashed()->find($id);
            $article->getSlug()->delete();
            $article->forceDelete();
            $filepath = 'newletter/'.$article->file_id;
            unlink($filepath);
            return redirect()->route('admin.ourteam.trash')->with(['type' => 'warning', 'message' =>'Messages Deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be destroyed.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Messages could not be destroyed.']);
        }
    }

    public function switch(Request $request)
    {
        try {
            Ourteam::find($request->id)->update([
                'status' => $request->status=="true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Messages could not be switched.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
        }
        return $request->status;
    }
}

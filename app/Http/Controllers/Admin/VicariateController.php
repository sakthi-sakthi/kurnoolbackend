<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Priest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Vicariate;
use App\Models\Log;
use App\Models\Option;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Throwable;

class VicariateController extends Controller
{
    public function index()
    {
        try {
            $articles = Vicariate::all();
            return view('admin.vicariate.index',compact('articles'));
        } catch (Throwable $th) {
          return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate page could not be loaded.']);
        }
    }

    public function create()
    { 
        try {
            $vicariates = Vicariate::all();
            $priests = Priest::where('status',1)->get();
            
            return view('admin.vicariate.create',compact('vicariates','priests'));
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate create page could not be loaded.'.$th.'']);
        }
    }

    public function store(Request $request)
    {
        //  dd($request->all());
        try {
            Vicariate::create([
                'media_id' => $request->media_id ?? 1,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 1,
                'establishment_date' => $request->establishment_date,
                'priest_id' => $request->priest_id,
                'vicarare_forane_mobile' => $request->vicarare_forane_mobile, 
                'patron' => $request->patron
            ]);
            
            return redirect()->route('admin.vicariate.index')->with(['type' => 'success', 'message' =>'Vicariate details are Saved.']);

        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate could not be saved.']);
        }
    }

    public function edit($id)
    { 
        try {
            $priests = Priest::where('status',1)->get();
            $value =Vicariate::where('id',$id)->first();
            $imagedata = Priest::where('id',$value->priest_id)->first();
            if($imagedata != null){
                $image = $imagedata->getMedia->getUrl('thumb') ?? '';
            }else{
                $image = '';
            }
            return view('admin.vicariate.edit',compact('value','priests','image'));
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {
        
        $article =Vicariate::where('id' ,$id)->first();

        try {
                $article->update([
                    'media_id' => $request->media_id ?? 1,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'establishment_date' => $request->establishment_date,
                    'vicarare_forane_mobile' => $request->vicarare_forane_mobile, 
                    'priest_id' => $request->priest_id,
                    'patron' => $request->patron
                ]);
          
            return redirect()->route('admin.vicariate.index')->with(['type' => 'success', 'message' =>'Vicariate Has Been Updated.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate could not be updated.']);
        }
    }

    public function delete($id)
    {
       
        try {
            $articledata = Vicariate::where('id',$id)->first();
            $articledata->delete();
            return redirect()->route('admin.vicariate.index')->with(['type' => 'success', 'message' =>'Vicariate To Recycle Bin.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Vicariate::onlyTrashed()->get();
            return view('admin.vicariate.trash',compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Vicariate page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Vicariate::withTrashed()->find($id)->restore();
            return redirect()->route('admin.vicariate.trash')->with(['type' => 'success', 'message' =>'Vicariate Recovered.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate could not be recovered.']);
        }
    }

    public function destroy($id)
    {
    
        try {
            $article = Vicariate::withTrashed()->find($id);
            $article->forceDelete();
            return redirect()->route('admin.vicariate.trash')->with(['type' => 'warning', 'message' =>'Vicariate Deleted.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' =>'Vicariate could not be destroyed.']);
        }
    }

    public function switched(Request $request)
    {
        try {
            Vicariate::find($request->id)->update([
                'status' => $request->status=="true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
        }
        return $request->status;
    }
}

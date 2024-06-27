<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Parish;
use App\Models\Priest;
use App\Models\Log;
use App\Models\Option;
use App\Models\Vicariate;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\DB;

class ParishController extends Controller
{
    public function index()
    {
        try {
            $articles = Parish::select('parishes.*')
                ->orderBy('parishes.id', 'DESC')
                ->get();
            return view('admin.parish.index', compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Parish page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            $priests = Priest::where('status', 1)->get();
            $categories = Category::where('parent', 'parish')->get();
            $vicariate = Vicariate::where('status', 1)->get();
            return view('admin.parish.create', compact('vicariate', 'priests', 'categories'));
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {


        try {
            Parish::create([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'priest_image' => $request->priest_image,
                'email' => $request->email,
                'phone' => $request->phone,
                'parish_name' => $request->parish_name,
                'parish_priest' => $request->parish_priest,
                'patron' => $request->patron,
                'status' => 1,
                'established_year' => $request->established_year,
                'tamil_population' => $request->tamil_population,
                'malayalam_population' => $request->malayalam_population,
                'vicariate' => $request->vicariate,
                'address' => $request->address,
                'history' => $request->history,
                'pious_associations' => $request->pious_associations,
                'social_movements' => $request->social_movements,
            ]);

            return redirect()->route('admin.parish.index')->with(['type' => 'success', 'message' => 'Parish details are Saved.']);

        } catch (Throwable $th) {

            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish could not be saved.']);
        }
    }

    public function edit($id)
    {
        try {
            $priests = Priest::where('status', 1)->get();
            $categories = Category::where('parent', 'parish')->get();
            $vicariate = Vicariate::where('status', 1)->get();
            $value = Parish::where('id', $id)->first();
            $imagedata = Priest::where('id', $value->parish_priest)->first();
            if ($imagedata != null) {
                $image = $imagedata->getMedia->getUrl('thumb') ?? '';
            } else {
                $image = '';
            }
            return view('admin.parish.edit', compact('categories', 'value', 'image', 'vicariate', 'priests'));
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {

        $article = Parish::where('id', $id)->first();

        try {
            $article->update([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'email' => $request->email,
                'phone' => $request->phone,
                'priest_image' => $request->priest_image,
                'parish_name' => $request->parish_name,
                'parish_priest' => $request->parish_priest,
                'patron' => $request->patron,
                'established_year' => $request->established_year,
                'tamil_population' => $request->tamil_population,
                'malayalam_population' => $request->malayalam_population,
                'vicariate' => $request->vicariate,
                'address' => $request->address,
                'history' => $request->history,
                'pious_associations' => $request->pious_associations,
                'social_movements' => $request->social_movements,
            ]);

            return redirect()->route('admin.parish.index')->with(['type' => 'success', 'message' => 'Parish Has Been Updated.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish could not be updated.']);
        }
    }

    public function delete($id)
    {

        try {
            $articledata = Parish::where('id', $id)->first();
            $articledata->delete();
            return redirect()->route('admin.parish.index')->with(['type' => 'success', 'message' => 'Parish To Recycle Bin.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Parish::onlyTrashed()->get();
            return view('admin.parish.trash', compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Parish page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Parish::withTrashed()->find($id)->restore();
            return redirect()->route('admin.parish.trash')->with(['type' => 'success', 'message' => 'Parish Recovered.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish could not be recovered.']);
        }
    }

    public function destroy($id)
    {

        try {
            $article = Parish::withTrashed()->find($id);
            $article->forceDelete();
            return redirect()->route('admin.parish.trash')->with(['type' => 'warning', 'message' => 'Parish Deleted.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Parish could not be destroyed.']);
        }
    }

    public function switch(Request $request)
    {
        try {
            Parish::find($request->id)->update([
                'status' => $request->status == "true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
        }
        return $request->status;
    }

    public function show(Request $request)
    {

        try {
            $data = Priest::where('id', $request->id)->first();
            if ($data->media_id != 1) {
                $image = $data->getMedia->getUrl('thumb') ?? '';
            } else {
                $image = '' . asset('admin') . '/img/empty.png' ?? '';
            }

        } catch (Throwable $th) {

        }
        return $image;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Role;
use App\Models\Priest;
use App\Models\Log;
use App\Models\Option;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PriestController extends Controller
{
    public function index()
    {
        try {
            $articles = Priest::all();
            return view('admin.priest.index', compact('articles'));
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            $Roles = Role::all();
            $categories = Category::where('parent', 'priest')->get();
            return view('admin.priest.create', compact('categories', 'Roles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Priest create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest create page could not be loaded.']);
        }
    }

    public function store(Request $request)
    {
        $roles = $request->roles;
        if (!empty ($roles)) {
            $inColumn = implode(", ", $roles);
            $request->merge([
                'roles' => $inColumn,
            ]);
        } else {
            $request->merge([
                'roles' => '',
            ]);
        }
        try {
            Priest::create([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'email' => $request->email,
                'roles' => $request->roles,
                'phone' => $request->phone,
                'address' => $request->address,
                'priest_type' => $request->priest_type,
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'date_of_ordination' => $request->date_of_ordination,
                'feast_day' => $request->feast_day,
                'blood_group' => $request->blood_group,
                'residence' => $request->residence,
                'ministry' => $request->ministry,
                'status' => 1,
            ]);

            return redirect()->route('admin.priest.index')->with(['type' => 'success', 'message' => 'Priest details are Saved.']);

        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest could not be saved.']);
        }
    }

    public function edit($id)
    {
        try {
            $Roles = Role::where('status', 1)->get();
            $categories = Category::where('parent', 'priest')->get();
            $value = Priest::where('id', $id)->first();
            return view('admin.priest.edit', compact('categories', 'value', 'Roles'));
        } catch (Throwable $th) {

            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {

        $article = Priest::where('id', $id)->first();

        $roles = $request->roles;
        if (!empty ($roles)) {
            $inColumn = implode(", ", $roles);
            $request->merge([
                'roles' => $inColumn,
            ]);
        } else {
            $request->merge([
                'roles' => '',
            ]);
        }
        try {
            $article->update([
                'user_id' => Auth::id(),
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'email' => $request->email,
                'roles' => $request->roles,
                'phone' => $request->phone,
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

            return redirect()->route('admin.priest.index')->with(['type' => 'success', 'message' => 'Priest Has Been Updated.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest could not be updated.']);
        }
    }

    public function delete($id)
    {

        try {
            $articledata = Priest::where('id', $id)->first();
            $articledata->delete();
            return redirect()->route('admin.priest.index')->with(['type' => 'success', 'message' => 'Priest To Recycle Bin.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest could not be deleted.']);
        }
    }

    public function trash()
    {
        try {
            $articles = Priest::onlyTrashed()->get();
            return view('admin.priest.trash', compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'TeamMember',
                'message' => 'Priest page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            Priest::withTrashed()->find($id)->restore();
            return redirect()->route('admin.priest.trash')->with(['type' => 'success', 'message' => 'Priest Recovered.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest could not be recovered.']);
        }
    }

    public function destroy($id)
    {

        try {
            $article = Priest::withTrashed()->find($id);
            $article->forceDelete();
            return redirect()->route('admin.priest.trash')->with(['type' => 'warning', 'message' => 'Priest Deleted.']);
        } catch (Throwable $th) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Priest could not be destroyed.']);
        }
    }

    public function switched(Request $request)
    {
        try {
            Priest::find($request->id)->update([
                'status' => $request->status == "true" ? 1 : 0
            ]);
        } catch (Throwable $th) {
        }
        return $request->status;
    }
}

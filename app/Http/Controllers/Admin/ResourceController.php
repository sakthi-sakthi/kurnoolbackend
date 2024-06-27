<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Article;
use App\Models\Log;
use App\Models\Option;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ResourceController extends Controller
{
    public function index()
    {
        try {
            $articles = Resource::all();
            return view('admin.resources.index', compact('articles'));
        } catch (Throwable $th) {

            return redirect()->back()->with(['type' => 'error', 'message' => 'Upcoming Events page could not be loaded.']);
        }
    }

    public function create()
    {
        try {
            $categories = Category::whereIn('id', [1, 9])->where('parent', 'newsevents')->get();
            return view('admin.resources.create', compact('categories'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'The Projects create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The Upcoming Events create page could not be loaded.']);
        }
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|min:3|max:255',
        //     'slug' => 'required|min:3|max:255',
        //     'file_id' => 'required',
        //     'language' => 'required',
        //     'no_index' => 'nullable|in:on',
        //     'no_follow' => 'nullable|in:on',
        //     'media_id' => 'nullable|numeric|min:1',
        //     'category_id' => 'nullable|numeric|min:1',
        // ]);
        try {
            $file = $request->file('file_id');
            if ($file != null) {

                $filename = $file->getClientOriginalName();
                Resource::create([
                    'user_id' => Auth::id(),
                    'media_id' => $request->media_id ?? 1,
                    'file_id' => $filename,
                    'status' => 1,
                    'category_id' => $request->category ?? 1,
                    'title' => $request->title,
                    'content' => $request->content,
                    'eventdate' => $request->eventdate,
                    'end_date' => $request->end_date
                ]);
                $destinationPath = "newletter";
                $file->move($destinationPath, $filename);
            } else {
                Resource::create([
                    'user_id' => Auth::id(),
                    'media_id' => $request->media_id ?? 1,
                    'category_id' => $request->category ?? 1,
                    'status' => 1,
                    'title' => $request->title,
                    'content' => $request->content,
                    'eventdate' => $request->eventdate,
                    'end_date' => $request->end_date
                ]);
            }
            return redirect()->route('admin.resource.index')->with(['type' => 'success', 'message' => 'Upcoming Events Saved.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'The Projects could not be saved.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The Upcoming Events could not be saved.']);
        }
    }

    public function edit($newsletter)
    {
        try {
            $categories = Category::where('parent', 'newsevents')->get();
            $value = Resource::where('id', $newsletter)->first();
            return view('admin.resources.edit', compact('categories', 'value'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'The Projects edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Upcoming Events edit page could not be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {

        $article = Resource::where('id', $id)->first();
        $request->validate([
            'title' => 'required|min:3|max:255',
            'media_id' => 'nullable|numeric|min:1',
            'category' => 'nullable|numeric|min:1',
        ]);
        try {
            $file = $request->file('file_id');
            if ($file != null) {

                $filename = $file->getClientOriginalName();
                $article->update([
                    'media_id' => $request->media_id ?? 1,
                    'file_id' => $filename,
                    'category_id' => $request->category ?? 1,
                    'title' => $request->title,
                    'content' => $request->content,
                    'eventdate' => $request->eventdate,
                    'end_date' => $request->end_date
                ]);

                $destinationPath = "newletter";
                $file->move($destinationPath, $filename);
            } else {
                $article->update([
                    'media_id' => $request->media_id ?? 1,
                    'category_id' => $request->category ?? 1,
                    'title' => $request->title,
                    'content' => $request->content,
                    'eventdate' => $request->eventdate,
                    'end_date' => $request->end_date
                ]);
            }
            return redirect()->route('admin.resource.index')->with(['type' => 'success', 'message' => 'Upcoming Events Has Been Updated.']);
        } catch (Throwable $th) {

            return redirect()->back()->with(['type' => 'error', 'message' => 'Upcoming Events could not be updated.']);
        }
    }

    public function delete($article)
    {
        try {
            $articledata = Resource::where('id', $article)->first();
            $articledata->delete();
            return redirect()->route('admin.resource.index')->with(['type' => 'success', 'message' => 'Upcoming Events Moved To Recycle Bin.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'The Projects could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The Upcoming Events could not be deleted.']);
        }
    }

    public function gettrash()
    {

        try {
            $articles = Resource::onlyTrashed()->get();
            return view('admin.resources.trash', compact('articles'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'Projects trash page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Upcoming Events trash page could not be loaded.']);
        }
    }
    public function recover($id)
    {
        try {
            Resource::withTrashed()->find($id)->restore();
            return redirect()->route('admin.resource.trash')->with(['type' => 'success', 'message' => 'Projects Recovered.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Projects',
                'message' => 'The Projects could not be recovered.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The Upcoming Events could not be recovered.']);
        }
    }

    public function destroy($id)
    {

        try {
            $article = Resource::withTrashed()->find($id);
            $article->getSlug()->delete();
            $article->forceDelete();
            $filename = $article->file_id;
            if ($filename) {
                $filepath = 'newletter/' . $article->file_id;
                unlink($filepath);
            } else {

            }
            return redirect()->route('admin.resource.trash')->with(['type' => 'warning', 'message' => 'Projects Deleted.']);
        } catch (Throwable $th) {

            return redirect()->back()->with(['type' => 'error', 'message' => 'The Upcoming Events could not be destroyed.']);
        }
    }

    public function show(Request $request)
    {
        try {
            Resource::find($request->id)->update([
                'status' => $request->status == "true" ? 1 : 0
            ]);
        } catch (Throwable $th) {

        }
        return $request->status;
    }
}

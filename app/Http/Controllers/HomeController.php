<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\MainMenu;
use App\Models\Option;
use App\Models\Ourteam;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Slug;
use App\Models\Slide;
use App\Models\Article;
use App\Models\Newsletter;
use App\Models\Resource;
use App\Models\Socialmedia;
use App\Models\Media;
use App\Models\Page;
use App\Models\Image;
use GuzzleHttp\Client;
use DB;

class HomeController extends Controller
{
    private $status = 200;
    public function gethomepagedetails(Request $request)
    {

        $testid = $request->input('testid', null);
        $projectid = $request->input('projectid', null);

        #region Slider Data
        $Slides = Slide::orderBy('order', 'asc')->get();

        $SlidesData = [];

        foreach ($Slides as $key => $slides) {
            $data = [
                'id' => $slides->id,
                'title' => $slides->title,
                'content' => $slides->content,
                'image' => asset('slideimages/' . $slides->bg),
                'date' => optional($slides->created_at)->format('d-m-Y'),
            ];
            $SlidesData[] = $data;
        }
        #endregion

        #region project Data
        $resource = Resource::select('resources.title', 'resources.file_id', 'resources.id', 'resources.content', 'resources.media_id', 'resources.eventdate', 'resources.end_date', 'resources.created_at', 'categories.title as category_name', 'categories.id as category_id')
        ->leftJoin('categories', 'resources.category_id', '=', 'categories.id')
        ->where('resources.status', 1)
        ->when($projectid, function ($query) use ($projectid) {
            $query->where('resources.category_id', $projectid);
        })
        ->orderBy('resources.created_at', 'desc')
        ->get();
    
        $resource->each(function ($newsletter) {
            $mediaUrl = null;
            $newsletter->created_date = optional($newsletter->created_at)->format('d-m-Y');
            $newsletter->eventdate = optional(date_create($newsletter->eventdate))->format('d-m-Y');
            if ($newsletter->end_date) {
                $newsletter->end_date = optional(date_create($newsletter->end_date))->format('d-m-Y');
            }
            $media = Media::find($newsletter->media_id);
            if ($media) {
                $mediaUrl = $media->getUrl();
            }
            $newsletter->file_url = $newsletter->file_id ? asset('newsletter/' . $newsletter->file_id) : null;
        
            if ($newsletter->media_id != 1) {
                $newsletter->media_url = $mediaUrl;
            }
        
            $newsletter->content = strip_tags($newsletter->content);
        });
        
        #endregion

        #region youtube Data
        $data = Socialmedia::all();
        #endregion

        #region Allgallery Data
        $Image = Image::select('images.id', 'images.title', 'images.alt', 'images.path', 'images.created_at', 'categories.title as categoryname')->leftJoin('categories', 'categories.id', '=', 'images.category_id')->orderBy('images.id', 'desc')->get();
        $imagesData = [];

        foreach ($Image as $key => $image) {
            $data = [
                'id' => $image->id,
                'title' => $image->title,
                'alt_tag' => $image->alt,
                'image' => asset($image->path),
                'date' => $image->created_at->format('d-m-Y'),
                'categoryname' => $image->categoryname,
            ];
            $imagesData[] = $data;
        }
        #endregion

        #region footer contact Data
        $contactpage = Option::where('key', 'contact')->first();

        if ($contactpage != null) {
            $arrayData = unserialize($contactpage->value);
            $map = $arrayData['map'];
            $zoom = $arrayData['zoom'];
            $contactdata = [
                'mobile' => $arrayData['phone'],
                'cell' => $arrayData['cell'],
                'email' => $arrayData['email'],
                'address' => $arrayData['address'],
                'googleMapsUrl' => 'https://maps.google.com/maps?q=' . $map . '&t=&z=' . $zoom . '&ie=UTF8&iwloc=&output=embed',
            ];
        }

        #endregion

        #region Header menu Data

        $results = DB::table('main_menus')->select('main_menus.id', 'main_menus.title as label', 'main_menus.link as url', 'submenus.title as submenutitle', 'submenus.link as submenuUrl', 'submenus.id as submenuid', 'child_sub_menus.title as childsubmenutitle', 'child_sub_menus.link as childsubmenuUrl', 'child_sub_menus.id as childsubmenuid', 'main_menus.status')->leftJoin('submenus', 'submenus.parent_id', 'main_menus.id')->leftJoin('child_sub_menus', 'child_sub_menus.parent_id', 'submenus.id')->where('main_menus.status', 1)->orderBy('main_menus.Position', 'asc')->orderBy('submenus.Position', 'asc')->orderBy('child_sub_menus.Position', 'asc')->get();

        $groupedResults = collect($results)->groupBy('id');

        $finalResult = $groupedResults
            ->map(function ($group) {
                $mainMenu = $group->first();

                $children = $group
                    ->groupBy('submenuid')
                    ->map(function ($subGroup) {
                        $submenu = $subGroup->first();

                        $childSubmenus = $subGroup
                            ->groupBy('childsubmenuid')
                            ->map(function ($childSubGroup) {
                                $childSubmenu = $childSubGroup->first();

                                return [
                                    'id' => $childSubmenu->childsubmenuid,
                                    'label' => $childSubmenu->childsubmenutitle,
                                    'url' => $childSubmenu->childsubmenuUrl,
                                ];
                            })
                            ->values()
                            ->filter(function ($value) {
                                return $value['id'] !== null;
                            });

                        return [
                            'id' => $submenu->submenuid,
                            'label' => $submenu->submenutitle,
                            'url' => $submenu->submenuUrl,
                            'subchildren' => $childSubmenus->isNotEmpty() ? $childSubmenus : null,
                        ];
                    })
                    ->values()
                    ->filter(function ($value) {
                        return $value['id'] !== null;
                    });

                return [
                    'id' => $mainMenu->id,
                    'label' => $mainMenu->label,
                    'url' => $mainMenu->url,
                    'children' => $children->isNotEmpty() ? $children : null,
                ];
            })
            ->values()
            ->filter();

        $response = $finalResult->toArray();

        #endregion

        $result = [
            'sliderdata' => $SlidesData ?? '',
            'newsdata' => $resource ?? '',
            'youtubedata' => $data ?? '',
            'gallerydata' => $imagesData ?? '',
            'footerdata' => $contactdata ?? '',
            'headerdata' => $response ?? '',
        ];
        if (!empty($result)) {
            return response()->json([
                'message' => 'Data found successfully',
                'count' => count($result),
                'status' => 'success',
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'success' => false,
                'message' => 'No records found',
            ]);
        }
    }
}

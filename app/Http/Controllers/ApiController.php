<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Option;
use App\Models\Ourteam;
use App\Models\Testimonial;
use App\Models\Parish;
use App\Models\Religio;
use App\Models\Priest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\Role;
use App\Models\Slide;
use App\Models\Article;
use App\Models\Newsletter;
use App\Models\Resource;
use App\Models\Socialmedia;
use App\Models\Media;
use App\Models\Page;
use App\Models\Image;
use App\Models\Event;
use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    Private $status = 200;
  
    public function storecontact(Request $request)
    {
      $data = [
            'name' =>  $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'message' => $request['message'],
      ];
      Contact::create($data);
        //  $email = $request['email'];
         $bodyContent = [
             'toName' => $request['name'],
             'toemail'   => $request['email'],
             'tomobile'=> $request['mobile'],
             'tosubject'=> $request['message'],
             ];
         {  
             try {
               Mail::to('sakthiganapathi@dbcyelagiri.edu.in ')->send(new ContactFormMail($bodyContent));
            //    Mail::to($email)->send(new ContactFormMail($bodyContent));
            return response()->json(['status' => 'success', 'message'=> 'Request sent successfully']);
                }
                 catch (Exception $e) {
                    dd($e);
                    return response()->json(['status' => 'failed', 'message'=> 'Request Not sent successfully']);
             }
         } 
     
    }
   
    public function getsliderimages(){
        $Slides = Slide::orderBy('order','asc')->get();
        $SlidesData = [];
        foreach ($Slides as $key => $slides) {
            $data = [
                'id' => $slides->id,
                'title' => $slides->title,
                'content' => $slides->content,
                'image' => asset('slideimages/' . $slides->bg),
                'date' =>  $slides->created_at->format('d-m-Y'),
            ]; 
            $SlidesData[] = $data; 
        }
        if(count($SlidesData) > 0) {
            return response()->json(["status" => $this->status, "success" => true, 
                        "count" => count($SlidesData), "data" => $SlidesData]);
        }
        else {
            return response()->json(["status" => "failed",
            "success" => false, "message" => "Whoops! no record found"]);
        }
    }
    public function getnewsletter(){
   
    $newsletters = Newsletter::where('status' ,1)->orderBy('created_at' , 'desc')->get();
    $newsletters->each(function ($newsletter) {
        $newsletter->created_date = $newsletter->created_at->format('d-m-Y');
        $newsletter->eventdate = date("d-m-Y", strtotime($newsletter->eventdate));
        $newsletter->file_url = asset('newletter/' . $newsletter->file_id);
        $newsletter->media_url = $newsletter->media_id != 1 ? $newsletter->getMedia->getUrl() : null;
        $newsletter->category_id =$newsletter->category_id ? $newsletter->getCategory->id : null;
        $newsletter->category_name = $newsletter->category_id ? $newsletter->getCategory->title : null;
 });     
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $newsletters,
        ]);
    
    }
    public function getpage(){
  
        $pages = Page::where('status',1)->get();
        $pages->each(function ($page) {
            $page->media_url = $page->media_id != 1 ? $page->getMedia->getUrl() : null;
        });
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $pages,
        ]);
    }
    public function getslidebar(){

        
        $articles = Article::where('status' ,1)->get();
        $articles->each(function ($article) {
            $article->media_url = $article->media_id != 1 ? $article->getMedia->getUrl() : null;
            $article->category_id = $article->category_id ? $article->getCategory->id : null;
            $article->category_name = $article->category_id ? $article->getCategory->title : null;
            $article->created_at = $article->created_at->format('d-m-Y');
        });
       
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $articles,
        ]);
    }

    public function getGalleryimages(){

        $Image =Image::select('images.id','images.title','images.alt','images.path','images.created_at','categories.title as categoryname')->leftJoin('categories' ,'categories.id','=','images.category_id')
        ->orderBy('images.id','desc')->get();
// dd( $Image);
        $imagesData = [];
        
        foreach ($Image as $key => $image) {
            $data = [
                'id' => $image->id,
                'title' => $image->title,
                'alt_tag' => $image->alt,
                'image' => asset($image->path),
                'date' =>  $image->created_at->format('d-m-Y'),
                'categoryname' => $image->categoryname,
            ]; 
            $imagesData[] = $data; 
        }
        if(count($Image) > 0) {
            return response()->json(["status" => $this->status, "success" => true, 
                        "count" => count($imagesData), "data" => $imagesData]);
        }
        else {
            return response()->json(["status" => "failed",
            "success" => false, "message" => "Whoops! no record found"]);
        }
    }

    public function getteam(){

        
        $teams = Ourteam::where('status',1)->orderBy('id','desc')->get();
        $teams->each(function ($team) {
            $team->media_url = $team->media_id != 1 ? $team->getMedia->getUrl() : null;
            $team->created_date = $team->created_at->format('d-m-Y');
            $team->category_id = $team->category_id ? $team->getCategory->id : null;
            $team->category_name = $team->category_id ? $team->getCategory->title : null;
        });
       
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $teams,
        ]);
    }

    public function getresourcedata($id){
      
    $resources = Resource::where('category_id', $id)->where('status', 1)->get();
    $resources->each(function ($resource) {
        $resource->created_date = $resource->created_at->format('d-m-Y');
        $resource->eventdate = date("d-m-Y", strtotime($resource->eventdate));
        $resource->media_url = $resource->media_id != 1 ? $resource->getMedia->getUrl() : null;
        $resource->file_url = $resource->file_id ? asset('newletter/' . $resource->file_id) : null;
        $resource->category_id = $resource->category_id ? $resource->getCategory->id : null;
        $resource->category_name = $resource->category_id ? $resource->getCategory->title : null;
    });
    $count = count($resources);
    return response()->json([
        'success' => true,
        'message' => 'success',
        'count' => $count,
        'data' => $resources,
    ]);
    }

    
    public function youtubedata(){
           
            $data = Socialmedia::where('id',1)->first();
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $data,
            ]);
    }
   
    public function getcontactpage(){
       $contactpage = Option::where('key','contact')->first();
       
       
       $arrayData = unserialize($contactpage->value);
       $map = $arrayData['map'];
       $zoom = $arrayData['zoom'];
       $contactdata = [
            'mobile' => $arrayData['phone'],
            'cell' => $arrayData['cell'],
            'email' => $arrayData['email'],
            'address' => $arrayData['address'],
            'googleMapsUrl' => "https://maps.google.com/maps?q=".$map."&t=&z=".$zoom."&ie=UTF8&iwloc=&output=embed"
        ];
    
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $contactdata,
        ]);
       
    }

    public function getactivitylist($id){


        $activties = Activity::where('category_id',$id)->where('status',1)->get();
        $activties->each(function ($activity) {
            $activity->created_date = $activity->created_at->format('d-m-Y');
            $activity->activitydate = date("d-m-Y", strtotime($activity->activitydate));
            $activity->media_url = $activity->media_id != 1 ? $activity->getMedia->getUrl() : null;
            $activity->category_id = $activity->category_id ? $activity->getCategory->id : null;
            $activity->category_name = $activity->category_id ? $activity->getCategory->title : null;
        });
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $activties,
            'count' => count($activties),
        ]); 

    }
    public function getmenus()
{
    $results = DB::table('main_menus')
        ->select('main_menus.id', 'main_menus.title as label', 'main_menus.link as url', 'submenus.title as submenutitle', 'submenus.link as submenuUrl', 'submenus.id as submenuid', 'child_sub_menus.title as childsubmenutitle', 'child_sub_menus.link as childsubmenuUrl', 'child_sub_menus.id as childsubmenuid', 'main_menus.status')
        ->leftJoin('submenus', 'submenus.parent_id', 'main_menus.id')
        ->leftJoin('child_sub_menus', 'child_sub_menus.parent_id', 'submenus.id')
        ->where('main_menus.status', 1)
        ->orderBy('main_menus.Position', 'asc')
        ->orderBy('submenus.Position', 'asc')
        ->orderBy('child_sub_menus.Position', 'asc')
        ->get();

    $groupedResults = collect($results)->groupBy('id');

    $finalResult = $groupedResults->map(function ($group) {
        $mainMenu = $group->first();

        $children = $group->groupBy('submenuid')->map(function ($subGroup) {
            $submenu = $subGroup->first();

            $childSubmenus = $subGroup->groupBy('childsubmenuid')->map(function ($childSubGroup) {
                $childSubmenu = $childSubGroup->first();

                return [
                    'id' => $childSubmenu->childsubmenuid,
                    'label' => $childSubmenu->childsubmenutitle,
                    'url' => $childSubmenu->childsubmenuUrl,
                ];
            })->values()->filter(function ($value) {
                return $value['id'] !== null;
            }); // <-- Exclude entries where id is null

            return [
                'id' => $submenu->submenuid,
                'label' => $submenu->submenutitle,
                'url' => $submenu->submenuUrl,
                'subchildren' => $childSubmenus->isNotEmpty() ? $childSubmenus : null,
            ];
        })->values()->filter(function ($value) {
            return $value['id'] !== null;
        }); 

        return [
            'id' => $mainMenu->id,
            'label' => $mainMenu->label,
            'url' => $mainMenu->url,
            'children' => $children->isNotEmpty() ? $children : null,
        ];
    })->values()->filter(); // <-- Exclude empty arrays

    $response = $finalResult->toArray();
    return response()->json($response);
}

    
    

    public function gettestimonialdata($id){

        $articles = Testimonial::where('status', 1)->where('category_id', $id)->get();

        $articles->each(function ($article) {
        $article->date = $article->created_at->format('d-m-Y');
        $article->media_url = $article->media_id ? $article->media->getUrl() : null;
        $article->category_name = $article->category_id ? $article->getCategory->title : null;
        $article->category_description = $article->category_id ? $article->getCategory->content : null;
        });

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'category_name'=> $articles[0]->category_name,
            'category_description'=> $articles[0]->category_description,
            'data' => $articles,
        ]);

    }

    public function getparishdata($id){

    //     $articles = Parish::select(
    //         'parishes.*',
    //         'categories.title as category_name',
    //         'categories.content as category_description',
    //         'vicariates.status',
    //         // 'vicariates.id as vicariates_id',
    //         'vicariates.name as VicariatesName',
    //     )
    //     ->leftJoin('categories', 'parishes.category_id', '=', 'categories.id')
    //     ->leftJoin('vicariates', 'parishes.vicariate', '=', 'vicariates.id')
    //     ->where('parishes.status', 1)
    //     ->where('vicariates.status', 1);
       
    
    // if ($id != 'NaN') {
    //     $articles->where('parishes.category_id', $id);
    // }
    
    // $articles = $articles->get();
    
            
    //     $articles->each(function ($article) {
           
    //         $mediaUrl = null;
    //         $media = Media::find($article->media_id);
          
    //           if ($media) {
    //               $mediaUrl = $media->getUrl();
    //           }
    //           if($article->media_id != 1){
    //               $article->parishimage = $mediaUrl;
    //           }
            
     

    //         $article->date = $article->created_at->format('d-m-Y');
    //     });
    $parishes = Parish::where('status', 1);
    if ($id != 'NaN') {
        $parishes->where('category_id', $id);
    }
    $parishes = $parishes->get();
    $parishes->each(function ($parish) {
    $parish->date = $parish->created_at->format('d-m-Y');
    $parish->media_url = $parish->media_id != 1 ? $parish->getMedia->getUrl() : null;
    $parish->category_name = $parish->category_id ? $parish->getCategory->title : null;
    $parish->category_description = $parish->category_id ? $parish->getCategory->content : null;
    $parish->vicariate_name = $parish->vicariate ? $parish->getvicariates->name : null;
    });
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'category_name'=> $parishes[0]->category_name ?? '',
            'category_description'=> $parishes[0]->category_description ?? '',
            'count' =>count($parishes),
            'data' => $parishes,
        ]);
    }

    
    public function getpreistdata($id){
       
        $priests = Priest::where('status', 1);
        if ($id != 'NaN') {
            $priests->where('category_id', $id);
        }
        $priests = $priests->get();
        $priests->each(function ($priest) {
          $priest->media_url = $priest->media_id != 1 ? $priest->getMedia->getUrl() : null;
          $priest->category_name = $priest->category_id ? $priest->getCategory->title : null;
          $priest->category_description = $priest->category_id ? $priest->getCategory->content : null;
          $roles = $priest->roles;
          $rolesArray = explode(', ', $roles);
          $rolesArray = array_map('trim', $rolesArray);
          $rolenamedd = [];
          
          foreach ($rolesArray as $item) {
              $id = (int)$item;
              $role = Role::find($id);
              if ($role) {
                  $rolenamedd[] = $role->role_name;
              }
          }
          $priest->roles = implode(', ', $rolenamedd);

        });
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'category_name'=> $priests[0]->category_name ?? '',
            'category_description'=> $priests[0]->category_description ?? '',
            'data' => $priests,
        ]);
    }
    public function getreligiodata($id){
      
       
        $religious = Religio::where('status', 1)->where('category_id', $id)->get();
        $religious->each(function ($religio) {
            $religio->media_url = $religio->media_id != 1 ? $religio->getMedia->getUrl() : null;
            $religio->category_name = $religio->category_id ? $religio->getCategory->title : null;
            $religio->category_description = $religio->category_id ? $religio->getCategory->content : null;
            $religio->date = $religio->created_at->format('d-m-Y');
        });
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'category_name'=> $religious[0]->category_name ?? '',
            'category_description'=> $religious[0]->category_description ?? '',
            'data' => $religious,
        ]);
    }
    public function geteventdata() {
        return response()->json([
            'success' => true,
            'count' => Event::count(),
            'message' => 'Data retrieved successfully',
            'data' => Event::all(['id', 'ename', 'startdate', 'enddate', 'place', 'edesc'])->map(function ($event) {
            $event->startdate = \Carbon\Carbon::parse($event->startdate)->format('m/d/Y h:i A');
            $event->enddate = $event->enddate ? \Carbon\Carbon::parse($event->enddate)->format('m/d/Y h:i A') : null;
            return $event;
        }),

        ]);
    }

    public function getmessagedata($id) {
        $messages = Message::where('category_id', $id)
            ->where('status', 1)
            ->select('id', 'title', 'content', 'activitydate', 'category_id', 'file', 'status')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($message) {
                $filePath = !empty($message->file) ? asset('uploads/' . $message->file) : null;
                return [
                    'id' => $message->id,
                    'title' => $message->title,
                    'content' => $message->content,
                    'activitydate' => $message->activitydate,
                    'category_id' => $message->category_id,
                    'file' => $filePath,
                    'status' => $message->status,
                ];
            });
    
        return response()->json([
            'success' => true,
            'count' => $messages->count(),
            'message' => 'Data retrieved successfully',
            'data' => $messages->reverse(),
        ]);
    }    
    
}


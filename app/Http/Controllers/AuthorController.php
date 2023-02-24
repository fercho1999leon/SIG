<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Author\Entities\Author;
use Modules\Ebook\Entities\Ebook;
use Modules\Files\Entities\Files;
use Modules\User\Entities\User;
use Modules\User\Contracts\Authentication;


class AuthorController extends Controller
{  
    /*
    protected $auth;
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;

    }*/

    public function index()
    {
        $sort='latest';
        if(request()->has('sort')) {
            $sort=request()->sort;
        }
        $query = Author::withCount('ebooks')->where(['is_verified'=>1,'is_active'=>1]);
      
        $authors=$query->paginate(12)->appends(request()->query());
        return view('public.authors.index',compact('authors'));
    }
    /*

    public function show($slug)
    {
        $author=Author::where(['slug'=> $slug,'is_verified'=>1,'is_active'=>1])->firstOrFail();
        $user =auth()->user();
        $ebooks=Ebook::forCard()
                ->where('is_private',0)
                ->whereHas('authors', function ($authorQuery) use ($author) {
                    $authorQuery->where('id', $author->id);
                })
                ->paginate(9)->appends(request()->query());
        return view('public.authors.show', compact('author','user', 'ebooks'));
         
    }*/
}

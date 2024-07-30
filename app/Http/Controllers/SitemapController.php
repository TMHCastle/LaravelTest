<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
// {
//     //
//     public function index()
//     {
//       $post = Post::active()->orderBy('updated_at', 'desc')->first();
//       $podcast = Podcast::active()->orderBy('updated_at', 'desc')->first();
    
//       return response()->view('sitemap.index', [
//           'post' => $post,
//           'podcast' => $podcast,
//       ])->header('Content-Type', 'text/xml');
//     }

//         public function posts()
//     {
//         $posts = Post::active()->where('category_id', '!=', 21)->get();
//         return response()->view('sitemap.posts', [
//             'posts' => $posts,
//         ])->header('Content-Type', 'text/xml');
//     }

//     public function categories()
//     {
//         $categories = Category::all();
//         return response()->view('sitemap.categories', [
//             'categories' => $categories,
//         ])->header('Content-Type', 'text/xml');
//     }

//     public function podcasts()
//     {
//         $podcast = Podcast::active()->orderBy('updated_at', 'desc')->get();
//         return response()->view('sitemap.podcasts', [
//             'podcasts' => $podcast,
//         ])->header('Content-Type', 'text/xml');
//     }
// }
?>
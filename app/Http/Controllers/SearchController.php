<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q=trim($request->input('q',''));
        $users=$q ? User::where('name','like',"%{$q}%")->limit(20)->get() : collect();
        return view('search.index',compact('users','q'));
    }
}

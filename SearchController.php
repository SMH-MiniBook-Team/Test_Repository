<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;
class SearchController extends Controller
 {
    public function getResults(Request $request)
        {
            $query = $request->input('query');
            if(!$query)
                { 
                    return redirect()->route('home'); 
                 } 
            $users = User::where(DB::raw("CONCAT(name,' ',last_name)"),'LIKE',"%{$query}%")->get();

            return view('search.results')->with('users',$users); 
        } 
}
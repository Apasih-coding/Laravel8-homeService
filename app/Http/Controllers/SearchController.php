<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autoComplete(Request $request)
    {
        $data = Service::select('name')->where("name", "like", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }

    public function searchService(Request $request)
    {
        $service_slug = Str::slug($request->q, '-');
        if ($service_slug) {
            return redirect('/service/' . $service_slug);
        } else {
            return back();
        }
    }
}

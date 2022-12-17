<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ListController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->input('token');
        $validUser = DB::table('personal_access_tokens')->where('token', $token)->first();

        if ($validUser) {

            $page = $request->has('page') ? $request->input('page') : 1;
            $perPage = $request->has('perPage') ? $request->input('perPage') : 10;

            $endpoint = "https://api.punkapi.com/v2/beers";
            $params = [
                'page' => $page,
                'per_page' => $perPage,
            ];

            $response = Http::get($endpoint, $params);

            $returnHTML = view('partials.list', [
                'data' => $response->json()
            ])->render();

            return response()->json(['success' => true, 'html' => $returnHTML]);

        } else {
            return response()->json(['success' => false], 500);
        }
    }
}

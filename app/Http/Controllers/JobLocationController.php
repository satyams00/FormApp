<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobLocations;
use Exception;
use Illuminate\Http\Request;

class JobLocationController extends Controller
{
    public function store(Request $request)
    {
        try {
            JobLocations::create($request->all());
            return back()->with(['create_location_msg' => 'Location Created Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }
}

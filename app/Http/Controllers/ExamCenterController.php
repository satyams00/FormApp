<?php

namespace App\Http\Controllers;

use App\Models\ExamCenter;
use Exception;
use Illuminate\Http\Request;

class ExamCenterController extends Controller
{
    public function store(Request $request)
    {
        try {
            ExamCenter::create($request->all());
            return back()->with(['create_examCenter_msg' => 'Exam Center Created Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

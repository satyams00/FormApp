<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateApplication;
use App\Models\Application;
use App\Models\ExamCenter;
use App\Models\Job;
use App\Models\JobLocations;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateApplication $request)
    {
        try {
            auth()->user()->applications()->create($request->only('height', 'highSchoolPercentage', 'intermediatePercentage', 'preferredJobLocation', 'preferredExamCenter', 'address', 'job_id'));
            return response()->json(['msg' => 'Application submitted Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        try {
            if ($request->ajax()) {
                return DataTables::of(Application::Where('user_id', Auth::user()->id))
                    ->addIndexColumn()
                    ->editColumn('title', fn($application) => $application->job->title)
                    ->editColumn('post', fn($application) => $application->job->post)
                    ->editColumn('created_at', function ($application) {
                        return Carbon::parse($application->created_at)->format('d-m-Y');
                    })
                    ->editColumn('status', function ($application) {
                        if ($application->status == 'pending') {
                            return "<span class='text-warning'>{$application->status}</span>";
                        }
                        if ($application->status == 'rejected') {
                            return "<span class='text-danger'>{$application->status}</span>";
                        }
                        if ($application->status == 'accepted') {
                            return "<span class='text-success'>{$application->status}</span>";
                        }
                    })
                    ->editColumn('edit', function ($application) {
                        if ($application->status == 'pending') {
                            return "<button class='btn btn-primary editBtn' name='applicationId' value='{$application->id}' data-bs-toggle='modal' data-bs-target='#appliedForModal' type='submit'>Edit</button>";
                        }
                        return "<button class='btn btn-primary' disabled>Edit</button>";
                    })
                    ->rawColumns(['edit', 'status'])
                    ->make(true);
            }
            return view('admin.applications.applied_for', compact('user'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        try {
            $post = $application->job->post;
            $title = $application->job->title;
            $jobLocations = JobLocations::all();
            $selectedLocation = JobLocations::find($application->preferredJobLocation)->name;
            $examcenters = ExamCenter::all();
            $selectedExamCenter = ExamCenter::find($application->preferredExamCenter)->name;
            return response()->json([
                "status" => 200,
                "application" => $application,
                "title" => $title,
                "post" => $post,
                "jobLocations" => $jobLocations,
                "examCenters" => $examcenters,
                "selectedLocation" => $selectedLocation,
                "selectedExamCenter" => $selectedExamCenter
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateApplication $request, Application $application)
    {
        try {
            // $application = Application::findOrFail($request->id);
            $application->update($request->only('height', 'highSchoolPercentage', 'intermediatePercentage', 'preferredJobLocation', 'preferredExamCenter', 'address', 'job_id'));
            return response()->json(['msg' => 'Application Updated successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function viewRequest(Request $request)
    {
        try {
            if ($request->ajax()) {
                return DataTables::of(Application::where('status', '=', 'pending'))
                    ->addIndexColumn()
                    ->editColumn('name', fn($application) => User::findOrFail($application->user_id)->name)
                    ->editColumn('email', fn($application) => User::findOrFail($application->user_id)->email)
                    ->editColumn('post', fn($application) => Job::findOrFail($application->job_id)->post)
                    ->editColumn('title', fn($application) => Job::findOrFail($application->job_id)->title)
                    ->editColumn('accept', 'admin.applications.accept')
                    ->editColumn('reject', 'admin.applications.reject')
                    ->rawColumns(['accept', 'reject'])
                    ->make(true);
            }
            return view('admin.applications.view-request');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function accept(Application $application)
    {
        try {
            $application->update(['status' => 'accepted']);
            return back()->with(['accept_application_msg' => 'Application Accpeted!!']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }
    public function reject(Application $application)
    {
        try {
            $application->update(['status' => 'rejected']);
            return back()->with(['reject_application_msg' => 'Application Rejected!!']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

}

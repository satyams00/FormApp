<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateJob;
use App\Models\Application;
use App\Models\Job;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return DataTables::of(Job::query())
                    ->addIndexColumn()
                    ->editColumn('apply_count', function ($job) {
                        return count(Application::whereJobId($job->id)->get());
                    })
                    ->editColumn('view', 'admin.jobs.view')
                    ->editColumn('action', 'admin.jobs.action')
                    ->rawColumns(['action', 'view'])
                    ->make(true);
            }
            return view('admin.jobs.index');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.jobs.create');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateJob $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $job = Auth::user()->jobs()->create($request->except(['jobLocation', 'examCenter']));
                $job->jobLocations()->attach($request->jobLocation);
                $job->examCenters()->attach($request->examCenter);
                return back()->with(['create_job_msg' => 'Job Created Successfully']);
            });
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        try {
            return view('admin.jobs.edit', compact('job'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateJob $request, Job $job)
    {
        try {
            DB::transaction(function () use ($request, $job) {
                $job->update($request->except(['jobLocation', 'examCenter', '_token', '_method']));
                $job->jobLocations()->sync($request->jobLocation);
                $job->examCenters()->sync($request->examCenter);
                return redirect()->route('jobs.index')->with(['update_job_msg' => 'Job Created Successfully']);
            });
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        try {
            $job->delete();
            return back()->with(['job_delete_msg' => 'Job Deleted Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function apply(Job $job)
    {
        try {
            $locations = $job->jobLocations;
            $examCenters = $job->examCenters;
            return response()->json([
                "status" => 200,
                "job" => $job,
                'locations' => $locations,
                'examCenters' => $examCenters
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function viewJob(Job $job)
    {
        try {
            return view('admin.jobs.view-job', compact('job'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

}

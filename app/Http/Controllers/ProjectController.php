<?php

namespace App\Http\Controllers;

use App\Mail\ProjectSent;
use App\Models\Project as ModelsProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->productFilter) {
            $projects = Auth::user()->projects()->orderBy('id', 'desc')
                ->where(function ($projects) use ($request) {
                    if ($request->name) {
                        $projects->where('name', 'like', "%$request->name%");
                    }
                    if ($request->startDateFrom) {
                        $projects->where('start_date', '>=', $request->startDateFrom);
                    }
                    if ($request->startDateTo) {
                        $projects->where('start_date', '<=', $request->startDateTo);
                    }
                    if ($request->stopDateFrom) {
                        $projects->where('stop_date', '>=', $request->stopDateFrom);
                    }
                    if ($request->stopDateTo) {
                        $projects->where('stop_date', '<=', $request->stopDateTo);
                    }
                });
        } else {
            $projects = Auth::user()->projects()->orderBy('id', 'desc');
        }
        $projects = $projects->paginate(3);
        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
            'startDate' => 'required',
            'stopDate' => 'required',
            'message' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $project = new ModelsProject();
        $project->name = $request->name;
        $project->start_date = $request->startDate;
        $project->stop_date = $request->stopDate;
        $project->message = $request->message;
        $project->user_id = auth()->user()->id;

        if ($file = $request->file('image')) {
            $project->image = $this->uploadImage($file, $request);
            try {
                DB::beginTransaction();
                $project->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                Storage::disk('public')->delete($project->image);
                throw $e;
            }
        } else {
            $project->save();
        }
        return redirect()->route('projects.index');
    }

    protected function uploadImage($file, $request)
    {
        $fileName = $file->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME) . '-' . $file->hashName();
        $path = $file->storeAs(
            'projects/' . date("Y"),
            $name,
            'public'
        );
        return $path;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = ModelsProject::findOrFail($id);
        return view('projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
            'startDate' => 'required',
            'stopDate' => 'required',
            'message' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        $project = ModelsProject::findOrFail($id);
        $project->name = $request->name;
        $project->start_date = $request->startDate;
        $project->stop_date = $request->stopDate;
        $project->message = $request->message;
        if ($file = $request->file('image')) {
            $project->image = $this->uploadImage($file, $request);
            try {
                DB::beginTransaction();
                $project->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                Storage::disk('public')->delete($project->image);
                throw $e;
            }
        } else {
            $project->save();
        }
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = ModelsProject::findOrFail($id);
        Storage::disk('public')->delete($project->image);
        $project->delete();
        return redirect()->route('projects.index');
    }

    /**
     * Send product email.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectsEmail(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $project = ModelsProject::findOrFail($id);
        // dd(111);//mmmyyy
        Mail::to($request->email)->send(new ProjectSent($project));

        return true;
    }
}

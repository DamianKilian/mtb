<?php

namespace App\Http\Controllers;

use App\Models\Project as ModelsProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => 'projects',
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
        $project->image = $this->uploadImage('image', $request);
        $project->user_id = auth()->user()->id;
        try {
            DB::beginTransaction();
            $project->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Storage::delete('public/' . $project->image);
            throw $e;
        }
        return redirect()->route('projects.index');
    }

    protected function uploadImage($name, $request)
    {
        $file = $request->file($name);
        $fileName = $file->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME) . '-' . $file->hashName();
        $path = 'storage/' . $file->storeAs(
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

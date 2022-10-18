<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class FileUploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \App\Models\User
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFileUploadForm()
    {
        return view('file-upload');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,gif,jpg,jpeg|max:2048',
        ]);
 
        $fileName = $request->file->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;
 
        $path = Storage::disk('public')->put($filePath, file_get_contents($request->file));
        $path = Storage::disk('public')->url($path);
        Auth()->user()->update(['image'=>$fileName]);
 
        // Perform the database operation here
 
        return back()
            ->with('success','L\'image a bien été téléchargée');
    }

}
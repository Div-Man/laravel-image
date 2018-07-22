<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Services\ImageService;

class ImagesController extends Controller 
{
    
    private $images;
    
    public function __construct(ImageService $imageService) {
        $this->images = $imageService;
    }
    
    public function index()
            
    {
       return view('welcome', ['imagesInView' => $this->images->all()]);
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Request $request)
    {
      $image = $request->file('image');
      
      $description = $request->input('description');
      
      $this->images->add($image, $description);
      
      return redirect('/');
    }
    
    public function show($id)
    {
        $myImage = $this->images->one($id);
        
        return view('show', ['imageInView' => $myImage]);
    }
    
    public function edit($id)
    {
        $myImage = $this->images->one($id);
         return view('edit', ['imageInView' => $myImage]);
    }
    
    public function update(Request $request, $id)
    {
        $this->images->update($id, $request->image, $request->description);
        
         return redirect('/');
    }
     public function delete($id) {
  
      $this->images->delete($id);
    
     return redirect('/');
    }
}


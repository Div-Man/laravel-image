<?php


namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImageService
{
    
    public function dateForImage()
    {
        return Carbon::now();
    }
    
    public function all()
    {
        $images = DB::table('images')->select('*')->get();
        
        return $images;
    }
    
    public function add($image, $description)
    {
        $fileName = $image->store('uploads');
        

        DB::table('images')->insert(
                ['image' => $fileName, 'created_at' => $this->dateForImage(), 'description' => $description]
            );
       
        
    }
    
    public function one($id)
    {
        $image = DB::table('images')->select('*')->where('id', $id)->first();
        
        
        return $image;
    }
    
    public function update($id, $image, $description)
    {
        //Выбираю текущий id в базе
        
         $images = DB::table('images')->select('*')->where('id', $id)->first();

         if($image) {
            Storage::delete($images->image);
            $fileName = $image->store('uploads');
         }
         

         DB::table('images')
                 ->where('id', $id)
                 ->update([
                     'image' => $fileName ?? $images->image,
                     'updated_at' => $this->dateForImage(),
                     'description' => $description
                        ]);
         
        
    }
    
    public function delete($id)
   {
         
    $image = $this->one($id); 
    Storage::delete($image->image);
    
    DB::table('images')->where('id', $id)->delete();
   }
}


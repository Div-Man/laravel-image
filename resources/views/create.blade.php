@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Add Image</h1>
            <form action="/store" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="image"> 
                <div class="form-group">
                 <label for="formGroupExampleInput">Описание</label>
                 <input name="description" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите что-нибудь">
               </div> 
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
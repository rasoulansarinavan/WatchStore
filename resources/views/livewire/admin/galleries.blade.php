<div class="mt-5 row">
    @foreach($galleries as $gallery)
        <div class="p-2 border col-md-4 d-flex justify-content-around align-items-center border-danger">
            <img src="{{url('/images/admin/products/big/' . $gallery->image)}}" style="width: 100px;" alt="">
            <div>
                <button class="btn btn-info"><i wire:clicke="" class="fa fa-trash"></i></button>
            </div>
        </div>
    @endforeach

</div>

<div class="mt-5 row">
    @foreach($galleries as $gallery)
        <div class="p-2 border col-md-4 d-flex justify-content-around align-items-center border-danger">
            <img src="{{url('/images/admin/products/big/' . $gallery->image)}}" style="width: 100px;" alt="">
            <div>
                <button class="btn btn-info" type="submit"
                        wire:clicke="deleteGallery({{$product_id}},{{$gallery->id}})">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>
@section('scripts')
    <script>
        window.addEventListener('deleteGallery', event => {
            Swal.fire({
                text: "آیا از حذف  مطمن هستی؟؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', event.detail.product_id, event.detail.id);
                    Swal.fire(
                        'دسته بندی با موفقیت حذف شد'
                    )
                }
            });
        });
    </script>
@endsection

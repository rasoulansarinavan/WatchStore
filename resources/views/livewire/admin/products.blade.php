<div class="table overflow-auto" tabindex="8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left" dir="rtl" wire:model="search">
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عکس محصول</th>
            <th class="text-center align-middle text-primary">نام محصول</th>
            <th class="text-center align-middle text-primary">نام انگلیسی محصول</th>
            <th class="text-center align-middle text-primary">قیمت</th>
            <th class="text-center align-middle text-primary">بازدید</th>
            <th class="text-center align-middle text-primary">تعداد محصول</th>
            <th class="text-center align-middle text-primary">گالری محصول</th>
            <th class="text-center align-middle text-primary">گارانتی محصول</th>
            <th class="text-center align-middle text-primary">تخفیف</th>
            <th class="text-center align-middle text-primary">محصول شگفت انگیز</th>
            <th class="text-center align-middle text-primary">وضعیت</th>
            <th class="text-center align-middle text-primary">برند محصول</th>
{{--            <th class="text-center align-middle text-primary">رنگ محصول</th>--}}
            <th class="text-center align-middle text-primary">دسته بندی محصول</th>
            <th class="text-center align-middle text-primary">توضیحات محصول</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td class="text-center align-middle">{{$loop->index+1}}</td>
                <td class="text-center align-middle">
                    <figure class="avatar avatar">
                        <img src="{{url('images/admin/products/big/'.$product->image)}}" class="rounded-circle"
                             alt="image">
                    </figure>
                </td>
                <td class="text-center align-middle">{{$product->title}}</td>
                <td class="text-center align-middle">{{$product->title_en}}</td>
                <td class="text-center align-middle">{{$product->price}}</td>
                <td class="text-center align-middle">{{$product->review}}</td>
                <td class="text-center align-middle">{{$product->count}}</td>
                <td class="text-center align-middle">{{$product->guaranty}}</td>
                <td class="text-center align-middle">{{$product->discount}}</td>
                <td class="text-center align-middle">{{$product->is_special ==0?'---------------':'شگفت انگیز'}}</td>
                <td class="text-center align-middle">{{$product->status}}</td>
                <td class="text-center align-middle">{{$product->brand->title}}</td>
{{--                <td class="text-center align-middle">{{@$product->colors()->pluck('id')->toArray()}}</td>--}}
                <td class="text-center align-middle">{{$product->category->title}}</td>
                <td class="text-center align-middle">{{$product->description}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('create.product.gallery',$product->id)}}">
                        گالری
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('products.edit',$product->id)}}">
                        ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deleteProduct({{$product->id}})">
                        حذف
                    </a>
                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($product->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;"
         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$products->appends(Request::except('page'))->links()}}
    </div>
</div>
@section('scripts')
    <script>
        window.addEventListener('deleteProduct', event => {
            Swal.fire({
                text: "آیا از حذف محصول مطمن هستی؟؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', event.detail.id);
                    Swal.fire(
                        'محصول با موفقیت حذف شد'
                    )
                }
            });
        });
    </script>
@endsection


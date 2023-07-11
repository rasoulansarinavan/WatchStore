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
            <th class="text-center align-middle text-primary">نام گزوه ویژگی ها</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($property_groups as $property_group)
            <tr>
                <td class="text-center align-middle">{{$loop->index+1}}</td>
                <td class="text-center align-middle">{{$property_group->title}}</td>

                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('property_groups.edit',$property_group->id)}}">
                        ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deletePropertyGroup({{$property_group->id}})">
                        حذف
                    </a>
                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($property_group->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;"
         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$property_groups->appends(Request::except('page'))->links()}}
    </div>
</div>
@section('scripts')
    <script>
        window.addEventListener('deletePropertyGroup', event => {
            Swal.fire({
                text: "آیا از حذف برند مطمن هستی؟؟",
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
                        'گزوه ویژگی با موفقیت حذف شد'
                    )
                }
            });
        });
    </script>
@endsection


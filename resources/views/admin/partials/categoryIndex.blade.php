@foreach($categories as $sub_category)
    <tr role="row" class="odd">
        <td class="sorting_1">{{$sub_category->id}}</td>
        <td>{{str_repeat('--', $level)}}{{$sub_category->name}}</td>
        <td>
            <a href="{{route('categories.edit', $sub_category->id)}}" class="d-block pull-right">
                <button class="btn btn-warning">ویرایش</button>
            </a>
            <a class="p-2" href="{{route('categorySettings.edit', $sub_category->id)}}">
                <button class="btn btn-primary">ویژگی ها</button>
            </a>
            <form action="{{route('categories.destroy', $sub_category->id)}}" method="post" class="pull-left">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="حذف" class="btn btn-danger">
            </form>
        </td>
    </tr>
    @if(count($sub_category->childrenRecursive) > 0)
        @include('admin.partials.categoryIndex', ['categories'=>$sub_category->childrenRecursive, 'level'=> ++$level])
    @endif
@endforeach

@foreach($categories as $category)
    <option value="{{$category->id}}">{{str_repeat('---', $level)}}{{$category->name}}</option>
    @if(count($category->childrenRecursive) > 0)
        @include('admin.partials.createCategory', ['categories'=> $category->childrenRecursive, 'level' => ++$level])
    @endif
@endforeach

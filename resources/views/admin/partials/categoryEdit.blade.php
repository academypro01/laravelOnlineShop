@foreach($categories as $category)
    <option {{($category->id == $selected_category->parent_id) ? 'selected': ''}} value="{{$category->id}}">{{str_repeat('---', $level)}}{{$category->name}}</option>
    @if(count($category->childrenRecursive) > 0)
        @include('admin.partials.categoryEdit', ['categories'=> $category->childrenRecursive, 'level' => ++$level])
    @endif
@endforeach

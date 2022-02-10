 <div class="dropdown-menu">
        <ul>
            @foreach($categories as $sub_category)
            <li><a href="{{route('frontend.category.products', $sub_category->id)}}">{{$sub_category->name}} @if(count($sub_category->childrenRecursive) > 0) <span>&rsaquo;</span> @endif </a>
                @if(count($sub_category->childrenRecursive) > 0)
                    @include('frontend.partials.categoryChild', ['categories' => $sub_category->childrenRecursive])
                @endif
            </li>
            @endforeach
        </ul>
    </div>


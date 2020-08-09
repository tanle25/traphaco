<ol class="dd-list" >
    @php
        $list = $list->sortBy('sort');
    @endphp
    @foreach ($list as $item)
        <li class="dd-item" data-id="{{$item->id}}">
            <div class="dd-handle" >
                <i class="fa {{$item->icon}}"></i> 
                <span>{{$item->department_name}}</span>
                
                <span class="float-right dd-nodrag">
                    <a href="{{route('admin.department.edit', $item->id)}}"><i
                            class="fa fa-edit text-success"></i></a>
                    <span data-id="{{$item->id}}" class="remove-department"><i class="fa fa-trash text-danger"></i></span>
                </span>
            </div>
            @if ($item->child)
                @include('admin.pages.departments.department_tree_child', ['list' => $item->child])
            @endif
        </li>
    @endforeach
</ol>
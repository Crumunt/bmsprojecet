@props(['dropdownMenu' => ['Option 1', 'Option 2', 'Option 3']])

<div class="btn-group dropend">
    <div type="button" class="bi bi-three-dots-vertical h4" data-bs-toggle="dropdown"
        aria-expanded="false">
        &#8942
    </div>
    <ul class="dropdown-menu">
        @foreach ($dropdownMenu as $link)
            <li class="link-opacity-10-hover">
                <a href="#" class="dropdown-item">{{$link}}</a>
            </li>
        @endforeach
        {{$slot}}
    </ul>
</div>

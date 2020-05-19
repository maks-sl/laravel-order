<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('cabinet.home') }}">Cabinet</a></li>
    <li class="nav-item"><a class="nav-link{{ $page === 'parser-single' ? ' active' : '' }}" href="{{ route('cabinet.single.parser.index') }}">Single</a></li>
</ul>

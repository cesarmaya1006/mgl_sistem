@if ($item['submenu'] == [])
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ MayoHelper::getMenuActivo($item['url']) }}" href="{{ url($item['url']) }}" aria-expanded="false" >
            <i class="{{ $item['icono'] }}"></i>
            <span class="hide-menu">{{ utf8_decode(utf8_encode($item['nombre'])) }}</span>
        </a>
    </li>
@else
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
            <i class="{{ $item['icono'] }}"></i>
            <span class="hide-menu">{{ utf8_decode(utf8_encode($item['nombre'])) }}</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            @foreach ($item['submenu'] as $submenu)
                @include("layouts.menu-item", ["item" => $submenu])
            @endforeach
        </ul>
    </li>
@endif

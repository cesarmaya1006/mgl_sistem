@if ($item['submenu'] == [])
    <li class="nav-item">
        <a href="{{ url($item['url']) }}" class="nav-link {{ MayoHelper::getMenuActivo($item['url']) }}"
            style="{{ $item['nombre'] == 'Otras opciones' ? 'color:gray' : '' }}">
            <i class="nav-icon {{ $item['icono'] }}"></i>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        {{ utf8_decode(utf8_encode($item['nombre'])) }}</font>
                </font>
            </p>
        </a>
    </li>
@else
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link"
            style="{{ $item['nombre'] == 'Otras opciones' ? 'background-color: rgb(206,206,206);color: black;' : '' }}"
            onmouseover="{{ $item['nombre'] == 'Otras opciones' ? 'this.style.color=\'#FFFFFF\';this.style.backgroundColor=\'rgb(90,90,90)\';' : '' }}"
            onmouseout="{{ $item['nombre'] == 'Otras opciones' ? 'this.style.color=\'black\';this.style.backgroundColor=\'rgb(206,206,206)\';' : '' }}">
            <i class="nav-icon {{ $item['icono'] }}"></i>
            <p>
                {{ utf8_decode(utf8_encode($item['nombre'])) }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($item['submenu'] as $submenu)
                @include("layouts.menu-item", ["item" => $submenu])
            @endforeach
        </ul>
    </li>

@endif

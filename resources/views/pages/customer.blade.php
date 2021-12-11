<div class="customer-sidebar card border-0">
    <div class="customer-profile">
        <a class="d-inline-block" href="#">
            <img class="img-fluid rounded-circle customer-image" src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"></a>
        <h5> {{Auth::user()->name}} </h5>
        <p class="text-muted text-sm mb-0">Ostrava, República Checa</p>
    </div>
    <nav class="list-group customer-nav">
        <a  class="list-group-item d-flex justify-content-between align-items-center active"     href="{{route('miPanel')}}">
            <span><svg class="svg-icon svg-icon-heavy mr-2"><use
                        xlink:href="/icons/orion-svg-sprite.svg#paper-bag-1"> </use></svg><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pedidos</font></font></span>
            <div class="badge badge-pill badge-dark font-weight-normal px-3"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font>
            </div>
        </a><a class="list-group-item d-flex justify-content-between align-items-center" href="{{route('panel.perfil')}}"><span><svg
                    class="svg-icon svg-icon-heavy mr-2"><use
                        xlink:href="/icons/orion-svg-sprite.svg#male-user-1"> </use></svg><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Perfil</font></font></span></a><a
            class="list-group-item d-flex justify-content-between align-items-center" href="{{route('logout')}}"><span><svg
                    class="svg-icon svg-icon-heavy mr-2"><use
                        xlink:href="/icons/orion-svg-sprite.svg#exit-1"> </use></svg><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar sesión</font></font></span></a>
    </nav>
</div>

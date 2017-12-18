
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
</li>

<li class="{{ Request::is('terminos*') ? 'active' : '' }}">
    <a href="{!! route('terminos.index') !!}"><i class="fa fa-edit"></i><span>Términos</span></a>
</li>

<li class="{{ Request::is('documentos*') ? 'active' : '' }}">
    <a href="{!! route('documentos.index') !!}"><i class="fa fa-edit"></i><span>Noticias</span></a>
</li>

<li class="{{ Request::is('ubicacions*') ? 'active' : '' }}">
    <a href="{!! route('ubicacions.index') !!}"><i class="fa fa-edit"></i><span>Ubicacions</span></a>
</li>

<li class="">
    <a href="{!! url('/noticias') !!}"><i class="fa fa-edit"></i><span>obtener noticias</span></a>
</li>




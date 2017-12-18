<table class="table table-responsive" id="documentos-table">
    <thead>
        <tr>
            <th>Titulo</th>
        <th>Link</th>
        <th>Fecha</th>
        <th>Ubicacion</th>
      <!--  <th>Contenido</th>-->
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($documentos as $documento)
        <tr>
            <td>{!! $documento->titulo !!}</td>
            <td><a target="_blank" href="{!! $documento->link !!}">Ver noticia</a></td>
            <td>{!! $documento->fecha !!}</td>
            <td>{!! $documento->ubicacion !!}</td>
            <!--<td>{!! $documento->contenido !!}</td>-->
            <td>
                {!! Form::open(['route' => ['documentos.destroy', $documento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('documentos.show', [$documento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('documentos.edit', [$documento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
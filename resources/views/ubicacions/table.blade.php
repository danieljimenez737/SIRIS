<table class="table table-responsive" id="ubicacions-table">
    <thead>
        <tr>
            <th>Ubicacion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ubicacions as $ubicacion)
        <tr>
            <td>{!! $ubicacion->ubicacion !!}</td>
            <td>
                {!! Form::open(['route' => ['ubicacions.destroy', $ubicacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ubicacions.show', [$ubicacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ubicacions.edit', [$ubicacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
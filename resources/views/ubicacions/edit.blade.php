@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ubicacion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($ubicacion, ['route' => ['ubicacions.update', $ubicacion->id], 'method' => 'patch']) !!}

                        @include('ubicacions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mapper
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mapper, ['route' => ['mappers.update', $mapper->id], 'method' => 'patch']) !!}

                        @include('mappers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
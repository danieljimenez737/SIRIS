@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Read Html
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($readHtml, ['route' => ['readHtmls.update', $readHtml->id], 'method' => 'patch']) !!}

                        @include('read_htmls.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
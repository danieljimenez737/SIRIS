@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Read Html
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('read_htmls.show_fields')
                    <a href="{!! route('readHtmls.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

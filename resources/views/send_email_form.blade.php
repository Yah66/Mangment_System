@extends('layouts.master')
@section('css')

@section('title')
    Title Empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Send Email</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                Post
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <!-- add_form -->
                            <form action="{{ route('send_mails') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="title" class="mr-sm-2">Title
                                            :</label>
                                        <input id="title" type="text" name="title" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Body
                                        :</label>
                                    <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                        </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

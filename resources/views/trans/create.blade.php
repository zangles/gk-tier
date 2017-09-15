@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">New Translations</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('trans.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('trans.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="namespace">Namespace</label>
                                <input type="text" class="form-control" id="namespace" name="namespace" placeholder="*">
                            </div>
                            <div class="form-group">
                                <label for="group">Group</label>
                                <input type="text" class="form-control" id="group" name="group" placeholder="gk">
                            </div>
                            <div class="form-group">
                                <label for="item">Item</label>
                                <input type="text" class="form-control" id="item" name="item" placeholder="gk.item">
                            </div>

                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($locales as $locale)
                                    <li role="presentation" class="@if($loop->first ) active @endif"><a href="#{{ $locale->locale }}" aria-controls="{{ $locale->locale }}" role="tab" data-toggle="tab">{{ $locale->name }} ({{ $locale->locale }})</a></li>
                                @endforeach
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                @foreach($locales as $locale)
                                    <div role="tabpanel" class="tab-pane @if($loop->first ) active @endif" id="{{ $locale->locale }}">
                                        <br>
                                        <div class="form-group">
                                            <label for="item">{{ strtoupper($locale->locale) }} Text</label>
                                            <input type="text" class="form-control" id="item" name="text_{{ $locale->locale }}" placeholder="text">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="tab-footer text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('/css/plugins/dataTables/jquery.dataTable.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('/js/plugins/dataTables/jquery.dataTables.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 100,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',

            });

        });

    </script>

@endsection


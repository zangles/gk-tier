@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Create Translations</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('trans.create') }}" class="btn btn-success">New translation</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($locales as $locale)
                                <li role="presentation" class="@if($loop->first ) active @endif"><a href="#{{ $locale->locale }}" aria-controls="{{ $locale->locale }}" role="tab" data-toggle="tab">{{ $locale->name }} ({{ $locale->locale }})</a></li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($locales as $locale)
                                <div role="tabpanel" class="tab-pane @if($loop->first ) active @endif" id="{{ $locale->locale }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Text</th>
                                                    <th>Trans Key (test)</th>
                                                    <th>Locked</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($transRepo->allByLocale($locale->locale, 10) as $trans)
                                                    <tr>
                                                        <td>{{ $trans->item }}</td>
                                                        <td>{{ $trans->text }}</td>
                                                        <td>{{ $trans->group }}.{{ $trans->item }} ( {{ trans($trans->group.'.'.$trans->item,[],$locale->locale) }} )</td>
                                                        <td class="text-center">
                                                            @if ($trans->locked == 1)
                                                                <button class="btn btn-danger btn-xs" type="button">
                                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                                </button>
                                                            @else
                                                                <button class="btn btn-success btn-xs" type="button">
                                                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('trans.edit', $trans) }}" class="btn btn-sm btn-primary">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('trans.destroy', $trans) }}" method="post" style="display:inline-block;">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $transRepo->allByLocale($locale->locale, 10)->links() }}
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

//        $(document).ready(function(){
//            $('.dataTables-example').DataTable({
//                pageLength: 100,
//                responsive: true,
//                dom: '<"html5buttons"B>lTfgitp',
//
//            });
//
//        });

    </script>

@endsection


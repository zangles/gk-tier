@extends('inspinia.base')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Guides list</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('guides.create') }}" class="btn btn-success">Create Guide</a>
                        </div>
                    </div>

                </div>
                <div class="ibox-content">
                    <table class="table">
                        <thead>
                                <tr>
                                    <th>Title</th>
                                    <th width="150px">Autor</th>
                                    <th width="150px">Score</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach($guides as $guide)
                               <tr>
                                    <td>
                                        <a href="{{ route('guides.show', $guide) }}">
                                            {{ $guide->title }}
                                        </a>
                                    </td>
                                    <td>{{ $guide->user()->name }}</td>
                                    <td>
                                        0 votes <br>
                                        0 views
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
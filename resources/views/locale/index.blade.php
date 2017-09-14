@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Locales</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('locale.create') }}" class="btn btn-success">New locale</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Locale</th>
                                    <th>Name</th>
                                    <th>Translate</th>
                                    <th width="150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locales as $locale)
                                    <tr @if ($locale->trashed()) class="bg-warning" @endif>
                                        <td>
                                            {{ $locale->locale }}
                                        </td>
                                        <td>
                                            {{ $locale->name }}
                                        </td>
                                        @if ($locale->trashed())
                                            <td>
                                                -
                                            </td>
                                            <td >
                                                <a href="{{ route('locale.edit', $locale) }}" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('locale.restore', $locale) }}" method="get" style="display: inline-block">
                                                    <button class="btn btn-warning" type="submit">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                {{ $langRepo->percentTranslated($locale->locale)  }} %
                                            </td>
                                            <td>
                                                <a href="{{ route('locale.edit', $locale) }}" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('locale.destroy', $locale) }}" method="post" style="display: inline-block">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
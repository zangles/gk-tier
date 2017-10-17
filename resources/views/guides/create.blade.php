@extends('inspinia.base')

@section('content')
    <form action="{{ route('guides.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            @if ($errors->any())
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pilot positions</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                @include('guides.partials.guidePilotSelectPosition')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Guide Data</h5>
                    </div>
                    <div class="ibox-content" style="overflow: auto">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea class="input-block-level" id="summernote" name="content" rows="18">
					</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content  text-center">
                        <button class="btn btn-primary">Save guide</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    @parent()
    <script>
        $(document).ready(function(){
            $('#summernote').summernote();

        });
    </script>
@endsection
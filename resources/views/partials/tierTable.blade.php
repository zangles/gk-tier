<div class="form-group">
    <label for="">Search</label>
    <input type="text" class="form-control" id="search">
</div>
<hr>
@foreach($pilots as $pilot)

    @include('partials.pilotTier')

@endforeach

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                searchPilot();
            });
        });

        function searchPilot(){
            var search = $("#search").val().toUpperCase();
            if (search != '') {
                if (search.length >= 3){
                    $(".pilotList .pilotDiv").hide();
                    $(".pilotList .pilotDiv .pilotName:contains('"+search+"')").parents('.pilotDiv').show();
                }
            } else {
                $(".pilotList .pilotDiv").show();
            }
        }
    </script>
@endsection
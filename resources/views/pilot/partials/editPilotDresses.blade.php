<div class="row">
    <div class="col-md-12">
        <div class="col-md-offset-4 col-md-4" id="divDresses">
            @foreach($pilot->dress()->get() as $dress)
                <div class="form-group" id="forclone">
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dressname[]" value="{{ $dress->name }}">
                        <span class="input-group-btn">
                    <button class="btn btn-danger deleteDress" type="button">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
   <div class="col-md-12 text-center">
      <button type="button" class="btn btn-primary" id="addDress">Add</button>
   </div>
</div>

@section('scripts')
   @parent()
   <script>
       $(document).ready(function(){
            $(document).on( "click", ".deleteDress" , function() {
                $(this).parents(".form-group").remove();
            });

            $("#addDress").click(function(){
                var newDressHtml = $("#forclone").clone();
                newDressHtml.find('input').val('');
                $("#divDresses").append(newDressHtml);
            });
       });
   </script>
@endsection

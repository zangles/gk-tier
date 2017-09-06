<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary raid-btn-all">All</button>
                    @foreach($raids as $raid)
                        <button type="button" class="btn btn-primary raid-btn" data-id="{{ $raid->id }}">{{ $raid->name }}</button>
                    @endforeach
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary type-btn-all">All</button>
                    <button type="button" class="btn btn-primary type-btn" data-id="Attack">Attack</button>
                    <button type="button" class="btn btn-primary type-btn" data-id="Defense">Tank</button>
                    <button type="button" class="btn btn-primary type-btn" data-id="Support">Support</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pilot</th>
                            @foreach($raids as $raid)
                                <th class="td_tier td_{{ $raid->id }}" id="th_{{ $raid->name }} ">{{ $raid->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pilots as $pilot)
                            <tr class="tr_type tr_{{ $pilot->type }}">
                                <td>
                                    <div style="height: 128px; width: 128px">
                                        <img src="http://gkgirls.info.gf/img/pilots/c_{{ $pilot->formatedId() }}.png" alt="" style="position: absolute">
                                        <img src="http://gkgirls.info.gf/img/frame.png" class="pilot-headshot"  style="position: absolute">
                                    </div>
                                    <p><strong>{{ $pilot->name }}</strong></p>
                                </td>
                                @foreach($pilot->raid as $tier)
                                    <td class="td_tier td_{{ $tier->id }}
                                            @if($tier->pivot->tier == 'S')
                                                bg-success
                                            @elseif($tier->pivot->tier == 'A')
                                                bg-primary
                                            @elseif($tier->pivot->tier == 'B')
                                                bg-info
                                            @elseif($tier->pivot->tier == 'C')
                                                bg-secundary
                                            @elseif($tier->pivot->tier == 'D')
                                                bg-warning
                                            @elseif($tier->pivot->tier == 'E')
                                                bg-danger
                                            @elseif($tier->pivot->tier == 'F')
                                                bg-dark
                                            @endif
                                            ">
                                        {{ $tier->pivot->tier }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $(".type-btn").click(function(){
                var id = $(this).data('id');
                $(".tr_type").hide();
                $(".tr_"+id).show();
            });

            $(".type-btn-all").click(function(){
                $(".tr_type").show();
            });

            $(".raid-btn-all").click(function(){
                $(".td_tier").show();
            });
            $(".raid-btn").click(function(){
                var id = $(this).data('id');
                $(".td_tier").hide();
                $(".td_"+id).show();
            })
        });
    </script>
</body>
</html>
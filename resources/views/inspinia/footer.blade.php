<div class="footer fixed">
    <div class="pull-right">
        v 0.3.0 <span class="label label-info" style="cursor: pointer" data-toggle="modal" data-target="#changeLogModal">Change log</span>
    </div>
    <div>
        <strong>Copyright</strong> Zangles &copy; 2017
    </div>

    <div class="modal fade" id="changeLogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body changeLogBody">
                <?php
                    $Parsedown = new Parsedown();

                    echo $Parsedown->text(file_get_contents(app_path().'/../CHANGELOG.md'));
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')

@endsection
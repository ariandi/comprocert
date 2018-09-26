<div class="col-md-12" id="deleteanalyses">
    <hr />
    <div class="">
        <form action="{{ Route('api.analyses.delete') }}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <input name="nodeid" type="hidden" id="nodeid" value="">
        <div class="">
            <div class="modal-header" style="width: 80%;float: left;">
              <h4 class="modal-title" id="myModalLabel">ClEAR SCORE PROSJEKT X</h4>
            </div>
            <div align="right" style="width: 20%;float: left;margin-top: 15px; padding-right: 15px;">
              <button type="button" class="btn btn-danger closeDeleteAnalyses">{{ Menus::getLanguageString('idClose') }}</button>
            </div>

            <div style="clear: both;"></div>
            <div class="modal-body">
                <label>
                    Your data score will removed based on the options listed below
                </label>

                <label>{{ Menus::getLanguageString('idClickOnTheMassage') }}</label>

                <div style="margin-bottom: 10px;">
                   <table class="table">
                        <tbody>
                            <tr>
                                <td><i class="fa fa-dot-circle-o"></i> {{ Menus::getLanguageString('idCurrentMonth') }}</td>
                                <td><input type="radio" class="form-control" name="clear" value="1" data-toggle="toggle"></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-dot-circle-o"></i> {{ Menus::getLanguageString('idAllScore') }}</td>
                                <td><input type="radio" class="form-control" name="clear" value="2" data-toggle="toggle"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="row">
                    <div class="col-md-12 push-right" style="text-align: right;">
                        <input type="submit" name="simpan" class="btn btn-success deletes" value="{{ Menus::getLanguageString('idDelete') }}">
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

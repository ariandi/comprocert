<style type="text/css">
  .form-control.error {
    border-color: #f50000;
  }
</style>
<!-- Modal -->
  <div class="col-md-12" id="inviteTeamMember">
    <hr />
    <div class="">
      <div class="">
        <div class="modal-header" style="width: 80%;float: left;">
          <h4 class="modal-title" id="myModalLabel">{{ Menus::getLanguageString('idInviteTMOC') }}</h4>
        </div>
        <div align="right" style="width: 20%;float: left;margin-top: 15px; padding-right: 15px;">
          <button type="button" class="btn btn-danger closeInviteTeam">{{ Menus::getLanguageString('idClose') }}</button>
        </div>

        <div style="clear: both;"></div>
        <form action="{{ Route('api.invite.sendEmail') }}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="nodeid" type="hidden" id="nodeid" value="">
        <div class="modal-body">
          <div class="form-group">
            <label>{{ Menus::getLanguageString('idSelectEQ') }}</label>
            <select name="extraquestion" id="extraquestion" class="form-control">
              <option value="0">{{ Menus::getLanguageString('idSelect') }}</option>

              @foreach($dataquestion as $keyquest => $valquest)

                @if( $valquest->NodeID != 149 && $valquest->NodeID != 277)
                  <option value="{{ $valquest->NodeID }}">{{ $valquest->Title }}</option>
                @endif

              @endforeach
           </select>
          </div>
          <div style="overflow:auto;height:300px;margin-bottom: 10px;">
            <table class="table table-bordered">
              <thead>
                <tr class="my_planHeader my_plan1">
                  <th>#</th>
                  <th>{{ Menus::getLanguageString('idName') }}</th>
                  <th>{{ Menus::getLanguageString('idEmail') }}</th>
                  <th>{{ Menus::getLanguageString('idPosition') }}</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                @if($data->data1)
                @foreach($data->data1 as $key => $val)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $val->FirstName }} {{ $val->LastName }}</td>
                    <td>{{ $val->Email }}</td>
                    <td>{{ $val->Type }}</td>
                    <td>
                      <input type="checkbox" name="personmail[]" value="{{ $val->PersonID }}">
                    </td>
                  </tr>
                @endforeach
                  <tr class="my_planHeader my_plan1">
                    <th colspan="5">
                      {{ Menus::getLanguageString('idListPD') }} {{ $data->data2[0]->CompanyNameDept }}
                    </th>
                  </tr>
                  <tr>
                    @if($data->data2)
                    @foreach($data->data2[0]->subData as $subkey => $subval)
                      <tr>
                        <td>{{ $subkey+1 }}</td>
                        <td>{{ $subval->FirstName }} {{ $subval->LastName }}</td>
                        <td>{{ $subval->Email }}</td>
                        <td>{{ $subval->Type }}</td>
                        <td>
                          <input type="checkbox" name="personmail[]" class="person" id="{{ $subval->PersonID }}" value="{{ $subval->PersonID }}">
                        </td>
                      </tr>
                    @endforeach
                    @endif
                  </tr>
                  @else
                   <tr>
                    <td colspan="5">Data empty</td>
                  </tr>
                  @endif
              </tbody>
            </table>
          </div>

          <textarea cols="10" rows="5" name="textnote" id="note" class="form-control" placeholder="Wrire a note"></textarea>
          <br>
          <div class="row">
            <div class="col-md-12" style="text-align: right;">
              <input type="submit" name="simpan" class="btn btn-success sendemail" value="{{ Menus::getLanguageString('idSend') }}">
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

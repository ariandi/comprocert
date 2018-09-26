<!-- Modal -->
  <div class="col-md-12" id="selectPersonTeam">
    <hr />
    <div class="">
      <div class="">
        <div class="modal-header" style="width: 80%;float: left;">
          <h4 class="modal-title" id="myModalLabel">List Team Members of WiseHouse AS Company</h4>
        </div>
        <div style="width: 20%;float: left;margin-top: 15px;">
          <button type="button" class="btn btn-danger closeSelectPersonTeam">Close</button>
        </div>

        <div style="clear: both;"></div>
        <div class="modal-body">
            
        <div style="overflow:auto;height:300px">          
        <table class="table table-bordered">
          <thead>
            <tr class="my_planHeader my_plan1">
              <th>#</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Position</th>
              <th>#</th>
            </tr>
          </thead>
          
          <tbody>
            @foreach($data['data'] as $key => $val)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $val->first_name }} {{ $val->last_name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{-- {{ $val->Type }} --}}</td>
                <td>
                  <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID, 'month' => date('m'), 'year' => date('Y'), 'team' => 'not', 'PersonID' => $val->user_id]) }}" 
                  class="btn btn-success">
                    Score
                  </a>
                  
                  <a href="{{ route('notes.getnotes.no', ['PersonID' => $val->user_id]) }}" class="btn btn-primary">
                    <i class="fa fa-book" aria-hidden="true" style="margin-right:3px;"></i> Note                 
                  </a>
                </form>
                </td>
              </tr>
            @endforeach
          </tbody>
            </table>
        </div>
        </div>

      </div>
    </div>
  </div>
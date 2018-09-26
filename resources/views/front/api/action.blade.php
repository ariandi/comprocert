<div id="yesdoit" class="">
  <div class="">

    <!-- Modal content-->
    <div>
      <div style="border-bottom: 2px solid #ccc;">
        <div style="float: left;">
          <h2 class="" id="" style="margin-bottom: 5px;text-transform: none;">
            <i class="fa fa-book" aria-hidden="true" style="margin-right:10px;"></i>
            {{ Auth::user()->first_name }}'s {{ Menus::getLanguageString('idNote') }}
          </h2>
        </div>

        <div style="float: right;">
        <button class="btn btn-danger cancelProfile" type="button"><i class="fa fa-close"></i> {{ Menus::getLanguageString('idClose') }}</button>
          <!-- <button class="btn btn-danger cancelProfile" type="button">{{ Menus::getLanguageString('idClose') }}</button> -->
        </div>

        <div style="clear:both;"></div>
      </div>

      <div class="modal-body">

        @foreach($getNoteX as $key => $getData)
        <form action="#" method="post">
          <input type="hidden" name="PersonID" value="{{ Auth::user()->id }}">
          <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td style="min-width:200px;">

                  <i class="glyphicon glyphicon-user"></i>
                  {{ Auth::user()->first_name }}
                   <hr />
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                  {{ date('d F Y', strtotime($getData->Date)) }}

                </td>

                <td style="width: 75%;">

                  <div>
                    <div style="float: left;margin-bottom: 10px;">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <span>
                          <i class="fa fa-circle-o"
                              style="background:{{  $getData->colorlist }} !important;margin-left:0px;"></i></span>
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                              href="#collapse{{ $key }}" style="text-transform: none;font-size: 18px;">
                              {{ Menus::getLanguageString('idParent') }}
                            </a>
                        </div>

                        <div id="collapse{{ $key }}" class="panel-collapse collapse">
                          <div class="panel-body">
                            <ul>
                              @foreach( $getData->parent as $key2 => $parentData )
                                <li>{{ $parentData->title }}</li>
                              @endforeach
                            </ul>
                          </div>
                        </div>

                      </div>

                      <i>{{ $getData->getActionList()->title }}</i>
                      <input type="hidden" class="NodeName_{{ $getData->id }}" value="{{ $getData->getActionList()->title }}" />
                    </div>

                    <div  style="float: right;">
                      <button type="button" class="btn btn-info hilang saveMyWayCalendar" idCalendar="{{ $getData->id }}">
                        <i class="fa fa-book"></i> {{ Menus::getLanguageString('idSendtoCalendar') }}
                      </button>
                    </div>

                  </div>

                </td>
              </tr>

              <tr>
                <td colspan="2">
                  <div class="row">
                    <div class="col-md-9">

                      <i class="glyphicon glyphicon-pencil" style="margin-right: 20px;"></i>

                      <label>
                        {{ $getData->Note }}
                        <input type="hidden" class="note_{{ $getData->id }}" value="{{ $getData->Note }}" />
                      </label>

                      <textarea class="form-control" id="myWhy_{{ $getData->id }}">{{ $getData->MyWhy }}</textarea>

                    </div>

                    <div class="col-md-3">
                      <i class="glyphicon glyphicon-pencil" style="margin-right: 20px;"></i>
                      <br /><br />

                      <button class="bp btn btn-danger hilang" onclick="return confirm('Do you want to delete this note?');" name="delete" value="delete"><i class="fa fa-trash"></i> {{ Menus::getLanguageString('idDelete') }}</button>

                      <button class="bp btn btn-success saveMyWay" id="{{ $getData->id }}" name="update" value="Save" type="button"><i class="fa fa-save"></i> {{ Menus::getLanguageString('idSave') }}</button>
                    </div>
                  </div>

                </td>
              </tr>

            </tbody>
          </table>
          </div>
        </form>
        @endforeach

      </div>

    </div>

  </div>
</div>

<div class="" id="subscription">
  <div class="">
    <div>
      <div class="" style="border-bottom: 2px solid #ccc;">
        <h2 class="" id="" style="margin-bottom: 5px;text-transform: none;">
          {{ Menus::getLanguageString('idSubscription') }}
        </h2>
      </div>

      <div class="modal-body" style="margin-top: -5px;">
        <h5 style="margin-bottom: 15px;text-transform: none;">
          {{ Menus::getLanguageString('idAktiveAbonnementFor') }} :
        </h5>

        <label>
          <b>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</b>
          {{ Auth::user()->email }}
        </label>

        <label style="text-transform: none;">
          {{ Menus::getLanguageString('idTextSubscriptionText1') }}
        </label>

        <br>

        <label style="text-transform: none;">{{ Menus::getLanguageString('idTextSubscriptionText2') }}</label>

        <br>

        <input type="checkbox" name="" class="" value="">

        <br><br>

        <label style="text-transform: none;">{{ Menus::getLanguageString('idTextSubscriptionText3') }}</label>

        <br><br>
        <div class="table-responsive">
        <table class="table">
          <tbody>
          <tr>
            <td style="min-width:200px;"><i class="fa fa-dot-circle-o"></i> {{ Menus::getLanguageString('idNews') }}</td>
            <td>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-success active">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked>{{ Menus::getLanguageString('idOff') }}
                </label>
                <label class="btn btn-success">
                  <input type="radio" name="options" id="option2" autocomplete="off">{{ Menus::getLanguageString('idOn') }}
                </label>
              </div>
            </td>
          </tr>

          <tr>
            <td><i class="fa fa-dot-circle-o"></i> {{ Menus::getLanguageString('idYourMonthlyStatus') }}</td>
            <td>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-success active">
                  <input type="radio" name="options" id="option3" autocomplete="off" checked>{{ Menus::getLanguageString('idOff') }}
                </label>
                <label class="btn btn-success">
                  <input type="radio" name="options" id="option4" autocomplete="off">{{ Menus::getLanguageString('idOn') }}
                </label>
              </div>
            </td>
          </tr>

          <tr>
            <td><i class="fa fa-dot-circle-o"></i> {{ Menus::getLanguageString('idCourseAndInvitation') }}</td>
            <td>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-success active">
                  <input type="radio" name="options" id="option5" autocomplete="off" checked>{{ Menus::getLanguageString('idOff') }}
                </label>
                <label class="btn btn-success">
                  <input type="radio" name="options" id="option6" autocomplete="off">{{ Menus::getLanguageString('idOn') }}
                </label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

      </div>
      <div class="modal-footer" style="justify-content: flex-start;">
        <button class="btn btn-primary cancelProfile" type="button">{{ Menus::getLanguageString('idSave') }}</button>
        <button class="btn btn-danger cancelProfile" type="button">{{ Menus::getLanguageString('idCancel') }}</button>
      </div>
    </div>
  </div>
</div>

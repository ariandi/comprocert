
<script>

    $(function() {
        $('#years_date').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            yearRange: '1945:2050',
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
        $('#years_date').focus(function () {
                $(".ui-datepicker-month").hide();
            });

        $('#years_date_mobile').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            yearRange: '1945:2050',
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
        $('#years_date_mobile').focus(function () {
                $(".ui-datepicker-month").hide();
            });


    });


    
</script>

<div class="container">
  <form method="POST" action="{{ route('api.profile.update') }}" class="table table-user-information">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-25">
        <label for="email">{{ Menus::getLanguageString('idEmail') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class=" form-control Email text" readonly />
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="first_name">{{ Menus::getLanguageString('idFirstName') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class=" form-control text" />
      </div>
    </div>


    <div class="row">
      <div class="col-25">
        <label for="last_name">{{ Menus::getLanguageString('idLastName') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class=" form-control text" />
      </div>
    </div>


     <div class="row">
      <div class="col-25">
        <label for="position">{{ Menus::getLanguageString('idPosition') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="position" name="position" value="" class=" form-control text" />
      </div>
    </div>

      <div class="row">
      <div class="col-25">
        <label for="years_date">{{ Menus::getLanguageString('idYearOfBirth') }}</label>
      </div>
      <div class="col-75">
        <input type="text" id="years_date" name="years_date"  value="{{ Auth::user()->birth_date }}"  readonly class="datepicker form-control" />
      </div>
    </div>

      <div class="row">
      <div class="col-25">
        <label for="gender">{{ Menus::getLanguageString('idGender') }}:</label>
      </div>
      <div class="col-75">
      <select id="gender" class=" form-control text">
            <option value="M" {{ Auth::user()->gender == 'm'? 'selected' : '' }}>{{ Menus::getLanguageString('idMale') }}</option>
            <option value="F" {{ Auth::user()->gender == 'f'? 'selected' : '' }}>{{ Menus::getLanguageString('idFemale') }}</option>
          </select>
      </div>
    </div>


    <div class="row">
      <div class="col-25">
        <label for="address" id="address">{{ Menus::getLanguageString('idAddress') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="address" name="address"  value="{{ Session()->get('userData')->Address ?? '' }}" class=" form-control text" />
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="mobile_phone">{{ Menus::getLanguageString('idMobilePhoneNumber') }}:</label>
      </div>
      <div class="col-75">
        <input type="text" id="mobile_phone" name="mobile_phone"  value="{{ Auth::user()->no_hp }}" class=" form-control text" />
      </div>
    </div>

     <div class="row" style="margin-top: 25px;">
      <button class="btn btn-primary saveProfile" type="button">{{ Menus::getLanguageString('idSave') }}</button>&nbsp;
      <button class="btn btn-danger menuprofil" targets="{{ route('api.profile.index') }}" type="button">{{ Menus::getLanguageString('idCancel') }}</button>
    </div>
      </form>
</div>



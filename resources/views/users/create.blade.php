@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('إدارة المستخدمين')])

@section('content')
<div style="margin-top:70px; ">
      <div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('إضافة مستخدم') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{url()->previous()}}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <label class="col-sm-4 col-form-label">{{ __('الاسم  ') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group form-info {{ $errors->has('first_name') ? ' has-danger' : '' }} ">
                          <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="input-first_name" type="text" placeholder="{{ __('الاسم') }}" value="{{ old('first_name') }}" required="true" aria-required="true"/>
                          @if ($errors->has('first_name'))
                            <span id="first_name-error" class="error text-danger" for="input-first_name">{{ $errors->first('first_name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <label class="col-sm-4 col-form-label">{{ __('الكنية') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group form-info {{ $errors->has('last_name') ? ' has-danger' : '' }} ">
                          <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="input-last_name" type="text" placeholder="{{ __('  الكنية') }}" value="{{ old('last_name') }}" required="true" aria-required="true"/>
                          @if ($errors->has('last_name'))
                            <span id="last_name-error" class="error text-danger" for="input-last_name">{{ $errors->first('last_name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <label class="col-sm-4 col-form-label">{{ __('البريد الإلكتروني') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('البريد الإلكتروني') }}" value="{{ old('email') }}" required />
                          @if ($errors->has('email'))
                            <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                    </div>

                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="row">
                      <label class="col-sm-4 col-form-label" for="input-password">{{ __(' كلمة المرور') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('كلمة المرور') }}" value="" required />
                          @if ($errors->has('password'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __(' تأكيد كلمة المرور') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('تأكيد كلمة المرور') }}" value="" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('نوع المستخدم') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">



                        <div class="radio">
                          <label>
                            <input type="radio" name="userType" value="1" checked="true"  onclick="displayCouncils();hideDepartments();hideFaculties()">
                            رئيس مجلس
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input id="is_activ" type="radio" name="userType"  value="2" onclick="displayCouncils();displayDepartments();hideFaculties()">
                            عضو مجلس
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="userType"  value="3" onclick="displayCouncils();hideDepartments();hideFaculties()">
                            أمين سر مجلس
                          </label>
                        </div>

                        <!-- <div class="radio">
                          <label>
                            <input type="radio" name="userType"  value="4" onclick="hideCouncils();hideDepartments();hideFaculties()">
                            ممثل نقابة
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="userType"  value="5" onclick="displayFaculties();hideCouncils();hideDepartments()">
                           وكيل علمي
                          </label>
                        </div> -->


                        <div class="radio">
                          <label>
                            <input type="radio" name="userType" value="4" onclick="displayFaculties();displayDepartments();hideCouncils()">
                            رئيس قسم
                          </label>
                        </div>




                      <div class="row">

                        <div id="councils_group" >
                          <select class="selectpicker" data-style="btn btn-info btn-round" name="council" id="councils" title="Single Select" >
                            <option disabled selected> اختر المجلس</option>
                            @foreach($councils as $council)
                              <option value="{{$council->id}}" >{{$council->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('council'))
                            <span id="council-error" class="error text-danger" for="councils">يجب أن تختار المجلس</span>
                          @endif
                        </div>

                      
                        <div id="faculties_group" hidden="hidden">
                          <select class="selectpicker" data-style="btn btn-info btn-round" name="faculty" id="faculties" title="Single Select" >
                            <option disabled selected> اختر الكلية</option>
                            @foreach($faculties as $faculty)
                              <option id="input" value="{{$faculty->id}}" >{{$faculty->name}}</option>
                            @endforeach
                          </select>

                        </div>
                          @if ($errors->has('department'))
                              <span id="department-error" class="error text-danger" for="departments">يجب أن تختار القسم وأعد اختيار نوع المستخدم</span>
                          @endif

                          @if ($errors->has('faculty'))
                              <span id="faculty-error" class="error text-danger" for="faculties">يجب أن تختار الكلية وأعد اختيار نوع المستخدم</span>
                          @endif

                          <div id="departments_group" hidden="hidden">
                          <select class="selectpicker" data-style="btn btn-info btn-round" name="department" id="departments" title="Single Select" >
                            <option disabled selected> اختر القسم</option>
                
                            @foreach($departments as $department)
                              <option value="{{$department->id}}" >{{$department->name}}:{{$department->faculty->name}}</option>
                            @endforeach
                          </select>

                        </div>


                      </div>

                    </div>

                  </div>
                </div>



              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">{{ __('حفظ') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>  
      var councilsGroup=document.getElementById("councils_group");
      var councils=document.getElementById("councils");

      var departmentsGroup=document.getElementById("departments_group");
      var departments=document.getElementById("departments");
      var input=document.getElementById("input").value;

      var facultiesGroup=document.getElementById("faculties_group");
      var faculties=document.getElementById("faculties");
      function displayCouncils()
      {
          councilsGroup.hidden=false;
      }
      function hideCouncils()
      {
          councilsGroup.hidden=true;
          councils.value='';
      }

          function displayDepartments()
          {
              departmentsGroup.hidden=false;
          }
          function hideDepartments()
          {
              departmentsGroup.hidden=true;
              departments.value='';
          }

      function displayFaculties()
      {
          facultiesGroup.hidden=false;
      }
      function hideFaculties()
      {
          facultiesGroup.hidden=true;
          faculties.value='';
      }
  </script>
@endsection

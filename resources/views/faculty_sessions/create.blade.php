@extends('layouts.app', ['activePage' => 'sessions', 'titlePage' => __(' الجلسات')])

@section('content')
<div style="margin-top:70px; ">
      <div>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('facultySession.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-info">
                                <h4 class="card-title">{{ __('إضافة جلسة جديدة') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ url()->previous()}}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __(' رقم الجلسة ') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('session_number') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="session_number" id="input-session_number" type="text" pattern="[0-9]*"
                                                   placeholder="{{ __(' رقم الجلسة') }}" value="{{ old('session_number') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('session_number'))
                                                <span id="session_number-error" class="error text-danger" for="input-session_number">{{ $errors->first('session_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-date">{{ __(' تاريخ الجلسة ') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" input type="date" name="date" id="input-date" placeholder="{{ __(' تاريخ الجلسة') }}" value="" required />
                                            @if ($errors->has('date'))
                                                <span id="date-error" class="error text-danger" for="date-name">{{ $errors->first('date') }}</span>
                                            @endif
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



@endsection

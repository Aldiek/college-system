@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => __('القرارات')])

@section('content')
<div style="margin-top:70px; ">
        <div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('decision.update', $decision) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('تعديل القرار') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>
                  </div>
                </div>



                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('الموضوع') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="input-subject" type="text" placeholder="{{ __('الموضوع') }}" value="{{ $decision->subject }}" required="true" aria-required="true"/>
                      @if ($errors->has('subject'))
                        <span id="subject-error" class="error text-danger" for="input-subject">{{ $errors->first('subject') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __(' المستندات') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" id="input-content"  placeholder="{{ __('المستندات') }}"  required> {{ $decision->content}}</textarea>
                      @if ($errors->has('content'))
                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __(' وبعد الاطلاع على') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content1') ? ' has-danger' : '' }}">
                      <textarea class="form-control{{ $errors->has('content1') ? ' is-invalid' : '' }}" name="content1" id="input-content1"  placeholder="{{ __(' وبعد الاطلاع على') }}"  required> {{ $decision->content1}}</textarea>
                      @if ($errors->has('content1'))
                        <span id="content1-error" class="error text-danger" for="input-content1">{{ $errors->first('content1') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __(' قرر المجلس مايلي') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content2') ? ' has-danger' : '' }}">
                      <textarea class="form-control{{ $errors->has('content2') ? ' is-invalid' : '' }}" name="content2" id="input-content2"  placeholder="{{ __('  قرر المجلس مايلي') }}"  required> {{ $decision->content2}}</textarea>
                      @if ($errors->has('content2'))
                        <span id="content2-error" class="error text-danger" for="input-content2">{{ $errors->first('content2') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-date">{{ __(' تاريخ القرار ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" input type="date" name="date" id="input-date" placeholder="{{ __(' تاريخ القرار') }}" value="{{ $decision->date}}" required />
                      @if ($errors->has('date'))
                        <span id="date-error" class="error text-danger" for="date-name">{{ $errors->first('date') }}</span>
                      @endif
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
@endsection

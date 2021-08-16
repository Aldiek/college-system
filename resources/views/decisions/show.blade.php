@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => (' القرارات')])

@section('content')
<div style="margin-top:70px; ">
    <div>
            <div class="row">
                <div class="col-md-12">


                    <div class="card ">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">{{ ('  تفاصيل القرار') }}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ ('الرجوع إلى القائمة') }}</a>
                                    @if(Auth::user()->is_council_presedent())
                                        <a href="/decision_votes/{{$decision->id}}" class="btn btn-sm btn-info">{{ (' استعراض الأصوات ') }}</a>
                                    @endif

                                </div>
                                @if(Auth::user()->is_secretary_council())
                                <div class="col-md-6 text-left">
                                    <form method="post" action="{{ route('decision.send',$decision) }}" autocomplete="off" class="form-horizontal">
                                        @csrf
                                        @method('post')
                                        @if ($errors->has('council'))
                                            <span id="council-error" class="error text-danger" for="councils">يجب أن تختار المجلس</span>
                                        @endif
                                        <select class="selectpicker" data-style="btn btn-info btn-round" name="council" id="councils" title="Single Select" >
                                        <option disabled selected> اختر المجلس</option>
                                        @foreach($councils as $council)
                                            <option value="{{$council->id}}" >{{$council->name}}</option>
                                        @endforeach
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-info">إرسال القرار</button>
                                    </form>
                                </div>
                                @endif

                            </div>
                            <div class="card text-center">
  <div class="card-header">
  قرار {{ $session->council->name }}
  قسم  {{$decision->department->name}}
  رقم  /{{ $decision->id}}/
  <br>
  المتخذ بالجلسة رقم /{{ $session->session_number }}/
  تاريخ {{ $session->date }}
  </div>
  <div class="card-body">
    <h5 class="card-text text-right">{{ ('الموضوع') }}</h5>
    <p class="card-text text-right">{!!html_entity_decode($decision->subject)!!}</p>
    <h5 class="card-text text-right">{{ ('المستندات') }}</h5>
    <p class="card-text text-right">{!!html_entity_decode($decision->content)!!}</p>
    <h5 class="card-text text-right">{{ ('وبعد الاطلاع على') }}</h5>
    <p class="card-text text-right">{!!html_entity_decode($decision->content1)!!}</p>
    <h5 class="card-text text-right">{{ ('قرر المجلس مايلي') }}</h5>
    <p class="card-text text-right">{!!html_entity_decode($decision->content2)!!}</p>
  </div>
  <div class="card-footer text-muted">

  </div>
</div>

                            @if(\Illuminate\Support\Facades\Auth::user()->is_council_member() ||Auth::user()->is_union_represintive() ||Auth::user()->is_scientific_council_member() )
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-date">{{ (' التصويت ') }}</label>
                                    <div class="col-sm-7  text-info" style="    padding-top: calc(0.4375rem + 1px);
                                                                         padding-bottom: calc(0.4375rem + 1px);
                                                                          ">



                                        @switch($vote)
                                            @case('agreed')
                                            <span> لقد قمت بالموافقة على القرار</span>
                                            @break

                                            @case('disagreed')
                                            <span>لم توافق على القرار</span>

                                            @break
                                            @case('discussed')
                                            <span>رغبت بنقاش هذا القرار</span>

                                            @break
                                            @default
                                            <span>لم تصوت بعد</span>
                                        @endswitch


                                    </div>
                                </div>

                                <form method="post" action="{{ route('votes.store2',$decision) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')

                                    <label class="col-sm-2 col-form-label" style="color:aqua;" >{{ ('  التصويت على القرار') }}</label>
                                    <div class="col-sm-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="vote_value" value="agreed" onclick="hideNotes()" checked="true">
                                                موافق
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="vote_value" value="disagreed" onclick="showNotes()" >
                                                 غير موافق
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="vote_value"  value="discussed" onclick="showNotes()">
                                                بحاجة لنقاش
                                            </label>
                                        </div>

                                    </div>
                                    <div id="notes" hidden>
                                        <label class="col-sm-4col-form-label">{{ ('الملاحظات حول هذا القرار') }}</label>
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note"
                                                       id="input-note" type="text" placeholder="{{ ('ملاحظات ') }}"
                                                       value="{{ old('note') }}" />
                                                @if ($errors->has('note'))
                                                    <span id="note-error" class="error text-danger" for="input-note">{{ $errors->first('note') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="card-footer ml-auto mr-auto">
                                            <button type="submit" class="btn btn-info">
                                                @if($had_voted)
                                                {{ ('تعديل التصويت') }}
                                            @else
                                                    {{ ('تصويت') }}
                                            @endif
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        el=document.getElementById('notes');
        function showNotes() {
            el.hidden=false;
        }
        function hideNotes() {
            el.hidden=true;
        }
    </script>

@endsection

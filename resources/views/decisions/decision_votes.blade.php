@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => __('الأصوات')])

@section('content')

    <style>
        .foot{
            color: #26c6da;
        }
    </style>
    <div style="margin-top:70px; ">
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">{{ __('الأصوات') }}</h4>
                            <p class="card-category"> {{ __('هنا يمكن استعراض الأصوات') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>

                                </div>
                                <div class="col-md-6 text-left">
                                    <a href="../adoption/{{$decision_id}}" class="btn btn-sm btn-success">{{ __('إصدار القرار') }}</a>

                                </div>
                            </div>
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                    <th>
                                        {{ __(' اسم العضو ') }}
                                    </th>



                                    <th>
                                        {{ __(' التصويت') }}
                                    </th>


                                    </thead>
                                    <tbody>
                                    @foreach($votes as $vote)
                                        <tr>
                                            <td>
                                                {{ $vote->council_member->user->first_name }}  {{ $vote->council_member->user->last_name }}
                                            </td>
                                            <td>
                                                @switch($vote->vote_value)
                                                    @case('agreed')
                                                    <span>وافق على القرار</span>
                                                    @break

                                                    @case('disagreed')
                                                    <span>لم يوافق على القرار</span>
                                                    @break
                                                    @case('discussed')
                                                    <span>يرغب بنقاش هذا القرار</span>
                                                    @break
                                                    @default
                                                    <span></span>
                                                @endswitch
                                            </td>
                                            <td>
                                                {{ $vote->note }}

                                            </td>



                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td> <td></td> <td></td>
                                    </tr>

                                    </tbody>
                                    <tfoot >
                                    <tr>
                                        <td class="foot">
                                            عدد الموافقين
                                        </td>
                                        <td>
                                            {{$agreed}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="foot">
                                            عدد المعترضين
                                        </td>
                                        <td>
                                            {{$disagreed}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="foot">
                                            عدد الذين يرغبون بنقاش القرار
                                        </td>
                                        <td>
                                            {{$discussed}}
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

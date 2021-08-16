@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => __('قرارات الكليات')])

@section('content')
<div style="margin-top:70px; ">
    <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">{{ __('الكليات') }}</h4>
                            <p class="card-category"> {{ __('هنا يمكن استعراض القرارات') }}</p>
                        </div>
                        <div class="card-body">
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
                                        {{ __(' الكلية ') }}
                                    </th>



                                    <th>
                                        {{ __(' القرارات') }}
                                    </th>

                                    </thead>
                                    <tbody>
                                    @foreach($faculties as $faculty)
                                        <tr>
                                            <td>
                                                {{ $faculty->name }}
                                            </td>


                                            <td>
                                            <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="استعراض القرارات" class="btn btn-info btn-link" href="{{ route('decision.index2',$faculty ) }}" data-original-title="" title="">
                                                <i class="material-icons">remove_red_eye</i>
                                                <div class="ripple-container"></div>
                                            </a>


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
        </div>
    </div>


@endsection

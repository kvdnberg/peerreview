@extends('app')

@section('content')
    <link rel="stylesheet" href="{{ elixir('css/pages/peerreviewboard.css') }}">
    <script src="{{ elixir('js/peerreviewboard.js') }}"></script>

    <h1>{{trans('messages.peerreviewboard')}}</h1>
    <script>
        $(document).ready(function() {

            var localDataVars = [];
@foreach($types as $index => $type)

            var thisBoard = '{{$type->slug}}_peerReviewBoard';

    @if($index==0)
            $('#{{$type->slug}}-tab').tab('show');
    @endif
            localDataVars['{{$index}}'] = thisBoard;
            restoreLocalData(thisBoard);

            $('#saveBoard_{{$type->slug}}').on('click', function() {
               storePeerReviewBoard(['{{$type->slug}}'], $('meta[name=_token]').attr('content'));
            });
@endforeach
        });
    </script>
    <ul id="boardTabs" class="nav nav-tabs" role="tablist">
        @foreach($types as $type)
            <li role="presentation"><a href="#{{$type->slug}}" role="tab" id="{{$type->slug}}-tab" data-toggle="tab" aria-controls="{{$type->slug}}" aria-expanded="true">{{$type->type}}</a></li>
        @endforeach
    </ul>
    <div id="boardTabContent" class="tab-content">
        @foreach($types as $type)
            <div id="{{$type->slug}}" role="tabpanel" class="tab-pane fade" aria-labelledby="{{$type->slug}}-tab">
                <button id="saveBoard_{{$type->slug}}" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i></button>
                <div class="col-md-6 peerReviewBoard" id="{{$type->slug}}_peerReviewBoard">
                    @foreach($columns as $column => $columnText)
                    <div class="col-md-6" id="{{$column}}Column">
                        {{$columnText}}
                        @for($i = 0 ; $i < count($type->developers); $i++)
                            <div class="well reviewBoardSlot" ondrop="drop(event)" ondragover="allowDrop(event)"  id="{{$type->slug}}_{{$column}}_{{$i}}"></div>
                        @endfor
                    </div>
                    @endforeach
                </div>
                @foreach($columns as $column => $columnText)
                <div class="col-md-3" id="peer{{$columnText}}GrabBag">
                    @foreach($type->developers as $developer)
                        <div class="well reviewBoardEntry" draggable="true" ondragstart="drag(event)" id="{{$type->slug}}_{{$column}}_{{$developer->id}}_developer">
                            <p>{{$developer->fullName}}</p>
                            <p>{{$developer->levelsString}}</p>
                            <p>{{$developer->skillsString}}</p>
                            &#64;{{$developer->gitHubHandle}}
                        </div>
                    @endforeach
                </div>
                @endforeach

            </div>
        @endforeach
    </div>
@stop

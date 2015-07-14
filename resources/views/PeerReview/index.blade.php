@extends('app')

@section('content')
    <link rel="stylesheet" href="{{ elixir('css/pages/peerreviewboard.css') }}">
<script>
    $(document).ready(function() {
        $('#{{$types[0]->slug}}-tab').tab('show');
    });
</script>
    <h1>{{trans('messages.peerreviewboard')}}</h1>
    <ul id="boardTabs" class="nav nav-tabs" role="tablist">
        @foreach($types as $type)
            <li role="presentation"><a href="#{{$type->slug}}" role="tab" id="{{$type->slug}}-tab" data-toggle="tab" aria-controls="{{$type->slug}}" aria-expanded="true">{{$type->type}}</a></li>
        @endforeach
    </ul>
    <div id="boardTabContent" class="tab-content">
        @foreach($types as $type)
            <div id="{{$type->slug}}" role="tabpanel" class="tab-pane fade" aria-labelledby="{{$type->slug}}-tab">
                 <div class="col-md6 peerReviewBoard" id="{{$type->slug}}_peerReviewBoard">
                    @foreach($columns as $column => $columnText)
                    <div class="col-md-6" id="{{$column}}Column">
                        {{$columnText}}
                        @foreach($boardDevelopers[$type->slug][$column] as $i => $developer)
                                    <div class="well reviewBoardEntry" draggable="true" ondragstart="drag(event)" id="{{$type->slug}}_{{$column}}_{{$developer->id}}_developer">
                                        <h4>{{$developer->fullName}}</h4>
                                       <p><i class="fa fa-github-alt"></i> <a href="https://github.com/{{$developer->gitHubHandle}}">&#64;{{$developer->gitHubHandle}}</a></p>
                                    </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@stop

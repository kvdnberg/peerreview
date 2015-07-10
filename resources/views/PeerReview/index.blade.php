@extends('app')

@section('content')
    <h1>{{trans('messages.peerreviewboard')}}</h1>

    <style>
        /* TODO: move to CSS / SCSS files */
        p {
            margin: 0 0 2px;
        }
        #div1 {
            width: 350px;
            height: 70px;
            padding: 10px;
            border: 1px solid #aaaaaa;
        }
        #dragDiv {
            width: 300px;
            height: 50px;
            padding: 10px;
            border: 1px solid #aaaaaa;
        }

        .reviewBoardSlot {
            width: 100%;
            height: 140px;
        }

        #authorColumn .reviewBoardSlot {
            background-color: #ffce75;
        }

        #peerAuthorsGrabBag .reviewBoardEntry, #authorColumn .reviewBoardEntry{
            background-color: #ff9629;
        }

        #reviewerColumn .reviewBoardSlot {
            background-color: #c9eda2;
        }

        #peerReviewersGrabBag .reviewBoardEntry, #reviewerColumn .reviewBoardEntry{
            background-color: #16cc19;
        }
    </style>

    <script>
        /* TODO: Move to js file */
        $(document).ready(function() {

            @foreach($types as $index => $type)
            @if($index==0)
                $('#{{$type->slug}}-tab').tab('show');
            @endif
                restoreLocalData('{{$type->slug}}_peerReviewBoard');
            @endforeach


        });

        function restoreLocalData(board)
        {
            var localData = localStorage.getItem(board);
            var localDataJSON = JSON.parse(localData);

            jQuery.each(localDataJSON, function(index) {
                var entry = document.getElementById(this);
                var slot = document.getElementById(index);
                slot.appendChild(entry);
            });
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
            var slot = $('#' + ev.target.id);
            var board = slot.closest('.peerReviewBoard').attr('id');

            updateLocalStorage(board);
        }

        function updateLocalStorage(board)
        {
            var localData = {};
            $('#' + board + ' .reviewBoardSlot').each(function(index) {
                //localData[index] = 'bla';
                var entry = $(this).find('.reviewBoardEntry').first();

                if(entry) {
                    localData[$(this).attr('id')] = entry.attr('id');
                }
            });
            localStorage.setItem(board, JSON.stringify(localData));
        }
    </script>
    <ul id="boardTabs" class="nav nav-tabs" role="tablist">
        @foreach($types as $type)
            <li role="presentation"><a href="#{{$type->slug}}" role="tab" id="{{$type->slug}}-tab" data-toggle="tab" aria-controls="{{$type->slug}}" aria-expanded="true">{{$type->type}}</a></li>
        @endforeach
    </ul>
    <div id="boardTabContent" class="tab-content">
        @foreach($types as $type)
            <div id="{{$type->slug}}" role="tabpanel" class="tab-pane fade" aria-labelledby="{{$type->slug}}-tab">
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

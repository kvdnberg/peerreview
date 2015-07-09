@extends('app')

@section('content')
    <h1>{{trans('messages.peerreviewboard')}}</h1>

    <style>
/* TODO: move to CSS / SCSS files */
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
           var localData = localStorage.getItem('peerReviewBoard');
           var localDataJSON = JSON.parse(localData);

            jQuery.each(localDataJSON, function(index) {
                var entry = document.getElementById(this);
                var slot = document.getElementById(index);
                slot.appendChild(entry);
               var bla = 'foo';
            });
        });

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

            updateLocalStorage();
        }

        function updateLocalStorage()
        {
            var localData = {};
            $('.reviewBoardSlot').each(function(index) {
                //localData[index] = 'bla';
                var entry = $(this).find('.reviewBoardEntry').first();

                if(entry) {
                   localData[$(this).attr('id')] = entry.attr('id');
                }
            });
            localStorage.setItem('peerReviewBoard', JSON.stringify(localData));
        }
    </script>
    <div class="con"
    <div class="col-md-6" id="peerReviewBoard">
        <div class="col-md-3" id="authorColumn">
            Authors
            @for($i = 0 ; $i < count($developers); $i++)
                <div class="well reviewBoardSlot" ondrop="drop(event)" ondragover="allowDrop(event)"  id="author_{{$i}}"></div>
            @endfor
        </div>
        <div class="col-md-3" id="reviewerColumn">
            Reviewers
            @for($i = 0 ; $i < count($developers); $i++)
                <div class="well reviewBoardslot" ondrop="drop(event)" ondragover="allowDrop(event)" id="reviewer_{{$i}}"></div>
            @endfor
        </div>
    </div>
    <div class="col-md-3" id="peerAuthorsGrabBag">
        @foreach($developers as $developer)
            <div class="well reviewBoardEntry" draggable="true" ondragstart="drag(event)" id="author_{{$developer->id}}_developer">
                {{$developer->fullName}}<br />
                {{$developer->developerType()->first()->type}}<br />
                &#64;{{$developer->gitHubHandle}}

            </div>
        @endforeach
    </div>
    <div class="col-md-3" id="peerReviewersGrabBag">
        @foreach($developers as $developer)
            <div class="well reviewBoardEntry" draggable="true" ondragstart="drag(event)" id="reviewer_{{$developer->id}}_developer">
                {{$developer->fullName}}<br />
                {{$developer->developerType()->first()->type}}<br />
                &#64;{{$developer->gitHubHandle}}

            </div>
        @endforeach
    </div>
@stop

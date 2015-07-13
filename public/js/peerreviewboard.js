
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
    if(board) {
        var localData = {};
        $('#' + board + ' .reviewBoardSlot').each(function (index) {
            var entry = $(this).find('.reviewBoardEntry').first();

            if (entry) {
                localData[$(this).attr('id')] = entry.attr('id');
            }
        });
        localStorage.setItem(board, JSON.stringify(localData));
    }
}

function getReviewBoardJSON(types)
{
    if(types) {
        var jsonArray = {};
        jQuery.each(types, function(index)
        {
            jsonArray[this] = {};
            var currentType = this;
            var localData = localStorage.getItem(this + '_peerReviewBoard');
            var localDataJSON = JSON.parse(localData);
            jQuery.each(localDataJSON, function (index) {

                var splitIndex = index.split('_');
                var splitData = this.split('_');
                var jsonIndex = splitIndex[2];
                if(jsonArray[currentType][jsonIndex] == undefined) {
                    jsonArray[currentType][jsonIndex] = {};
                }

                var devId = splitData[2];
                var devRole = splitIndex[1];
                jsonArray[currentType][jsonIndex][devRole] = devId;
            });
        });

        return JSON.stringify(jsonArray);
    }

}

function storePeerReviewBoard(types, _token)
{
    var boardResult = getReviewBoardJSON(types);
   // data['_token'] = _token;
    $.ajax({
        url: storeAjaxRoute,
        type: 'post',
        data: {'reviewBoard': boardResult},
        success: function (data) {

        }
    });
}


function restoreLocalData(board)
{
    var localData = localStorage.getItem(board);
    if(localData) {
        var localDataJSON = JSON.parse(localData);

        jQuery.each(localDataJSON, function (index) {
            var entry = document.getElementById(this);
            var slot = document.getElementById(index);
            slot.appendChild(entry);
        });
    }
}

function allowDrop(ev)
{
    ev.preventDefault();
}

function drag(ev)
{
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, allowMultiple)
{
    ev.preventDefault();

    var board = $('#' + ev.target.id).closest('.tab-pane').find('.peerReviewBoardEdit').attr('id');
    var data = ev.dataTransfer.getData("text");
    if (dropNotAllowed(ev, allowMultiple, data, board)) { return; }


    ev.target.appendChild(document.getElementById(data));

    updateLocalData(board);
}

/**
 * Check conditions under which drop is allowed
 * @param ev
 * @param allowMultiple
 * @returns {boolean}
 */
function dropNotAllowed(ev, allowMultiple, data, board)
{
    if(ev.target.hasChildNodes() && allowMultiple == false) { //only 1 developer per slot
        return true;
    }
    if($('#' + ev.target.id).hasClass('reviewBoardEntry')) {
        return true; //no developers inside developers! 
    }
    var column = findColumn(ev.target.id);
    if(column) {
        return !$('#' + data).hasClass(column);
    }
    return true;

}

function resetLocalData(board)
{
    if(board) {
        localStorage.removeItem(board);
    }
}

function findColumn(targetId)
{
    var columns = ['author', 'reviewer'];

    for(i=0 ; i < columns.length; i++) {
        if(targetId.indexOf(columns[i]) > -1) {
            return columns[i];
        }
    }
}

function updateLocalData(board)
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

function getReviewBoardJSON(type)
{
            var jsonArray = {};
            jsonArray[type] = {};

            var localData = localStorage.getItem(type + '_peerReviewBoard');
            var localDataJSON = JSON.parse(localData);
            jQuery.each(localDataJSON, function (index) {

                var splitIndex = index.split('_');
                var splitData = this.split('_');
                var jsonIndex = splitIndex[2];
                if(jsonArray[type][jsonIndex] == undefined) {
                    jsonArray[type][jsonIndex] = {};
                }

                var devId = splitData[2];
                var devRole = splitIndex[1];
                jsonArray[type][jsonIndex][devRole] = devId;
            });

        return JSON.stringify(jsonArray);

}

function storePeerReviewBoard(type, _token)
{
    var boardResult = getReviewBoardJSON(type);
    $.ajax({
        url: storeAjaxRoute,
        type: 'post',
        data: {'reviewBoard': boardResult},
        success: function (data) {
            $('#saveBoard_' + type).button('reset');
        },
        error: function() {
            //TODO
        }
    });
}

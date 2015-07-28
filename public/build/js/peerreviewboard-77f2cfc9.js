$(document).ready(function() {
    hideNamesInSmallWindows();

    $(window).resize(function () {
        hideNamesInSmallWindows();
    });
});

/**
 * When the window size is smaller, hide some information (lastname, github icon) and adjust the styles
 * to make things fit better. Combined with Bootstrap grid styles (col-md-6 + col-xs-12 etc.)
 */
function hideNamesInSmallWindows()
{
    if($(window).width() < 988) {
        $('.reviewBoardEntry').css('padding', '10px');
        $('.reviewBoardEntry').css('margin-bottom', '5px');
        $('.reviewBoardEntry h4.developerFullname').fadeOut();
        $('.reviewBoardEntry h4.developerFirstname').fadeIn();
        $('.columnTitle_2').fadeOut();
        $('.fa-github-alt').fadeOut();
    } else {
        $('.reviewBoardEntry').css('padding', '19px');
        $('.reviewBoardEntry').css('margin-bottom', '20px');
        $('.reviewBoardEntry h4.developerFullname').fadeIn();
        $('.reviewBoardEntry h4.developerFirstname').fadeOut();
        $('.columnTitle_2').fadeIn();
        $('.fa-github-alt').fadeIn();
    }
}

/**
 * On page load, read local storage and load the board from there.
 * @param board - ID of the board and local storage key (i.e. frontend_peerReviewBoard)
 */
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

/**
 * HTML5 draggable
 * @param ev
 */
function allowDrop(ev)
{
    ev.preventDefault();
}

/**
 * HTML5 draggable
 * @param ev
 */
function drag(ev)
{
    ev.dataTransfer.setData("text", ev.target.id);
}

/**
 * HTML5 draggable
 *
 * Checks whether or not a drop is allowed (i.e. is it the right column? not dropping in the wrong element?)
 *
 * @param ev
 * @param allowMultiple - whether or not the target element can contain more than one child
 */
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

/**
 * Clears the local data key for the given board
 * @param board: ID of the board and localstorage key (i.e. frontend_peerReviewBoard)
 */
function resetLocalData(board)
{
    if(board) {
        localStorage.removeItem(board);
    }
}

/**
 * Checks whether the target is an author or reviewer column (used in dropNotAllowed to check if the column matches the dropped item)
 * @param targetId - ID of the target element
 * @returns {string} - author/reviewer
 */
function findColumn(targetId)
{
    var columns = ['author', 'reviewer'];

    for(i=0 ; i < columns.length; i++) {
        if(targetId.indexOf(columns[i]) > -1) {
            return columns[i];
        }
    }
}

/**
 * After dropping an element in or out of the board, read the current state and store this in localstorage.
 *
 * @param board - ID of the board and local storage key (i.e. frontend_peerReviewBoard)
 */
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

/**
 * Reads the current state from localstorage and returns a stringified JSON array to send to the DB
 * @param type - frontend/backend
 * @returns {*} - stringified JSON array i.e. jsonArray['frontend'][0]['author'] = 7 (devId)
 */
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

/**
 * Send the current state of the given board type to store in the DB
 * @param type - frontend/backend
 */
function storePeerReviewBoard(type)
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


function loadPeerReviewBoard(board)
{
    var boardItems = JSON.parse(board['board']);
    var type = board['type'];
    var localData = {};
    var boardKey = type + '_peerReviewBoard';
   jQuery.each(boardItems, function(index, item) {
       jQuery.each(item, function(column, id)
       {
           var dataIndex = type + '_' + column + '_' + index;
           var developerId = type + '_' + column + '_' + id + '_developer';
           localData[dataIndex] = developerId;
       });

   });
    localStorage.setItem(boardKey, JSON.stringify(localData));
    restoreLocalData(boardKey);

}
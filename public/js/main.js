$(document).ready(function() {
    getSocialLinks();
    statistics();

    if($("body").has("#home-list").length > 0 && $("#home-list").data('board')) {
        getList('latest', 1, $("#home-list").data('board'));
        getList('popular', 1, $("#home-list").data('board'));
    } else {
        getList('latest', 1, 'all');
        getList('popular', 1, 'all');
    }

});

$(window).resize(function() {
    getSocialLinks();
});

function statistics()
{
    if($("body").has("#the-statistics").length > 0) {
        $.get("/api/stats", function(data) {
            $("#the-statistics").html('');
            stats = data.stats;
            
            var threadCount = stats.thread_count;
            var threadViews = stats.views_count;
            var postCount = stats.posts_count;
            var imageCount = stats.image_count;
            
            $("#the-statistics").append("<p><span class=\"stat-name\">Threads archived</span>: " + threadCount + "</p>");
            $("#the-statistics").append("<p><span class=\"stat-name\">Posts archived</span>: " + postCount + "</p>");
            $("#the-statistics").append("<p><span class=\"stat-name\">Images archived</span>: " + imageCount + "</p>");
            $("#the-statistics").append("<p><span class=\"stat-name\">Total thread views</span>: " + threadViews + "</p>");
        });
    }
}

function getList(type, page, board)
{
    if($("body").has("#" + type + "-threads").length > 0) {
        page = page > 0 ? page : 1;
        uri = "/api/threads/" + type + "/" + page + "/" + board;


        $.get(uri, function(data) {
            $("#" + type + "-threads").html('');
            var threads = data.threads;
            if(Object.keys(threads).length > 0) {
                $.each(threads, function(key, val) {
                    $("#" + type + "-threads").append('<a href="/' + val.board + '/thread/' + val.thread_id + '" class="thread-link">Thread #' + val.thread_id + ' from /' + val.board + '/</a> - <span title="' + val.created_at + '">' + moment().from(val.created_at, true) + ' ago</span><br />');
                });

                var total_rows = data.total_rows;
                var pages = Math.ceil(total_rows / 15);
                page = parseInt(page);
                $("#" + type + "-threads-list .pagination").html('<a onClick="getList(\'' + type + '\', \'1\', \'' + board + '\');"><<</a> ');
                for(var i = page - 5; i <= page + 5; i++) {
                    if(i > 0 && i <= pages) {
                        if(i == (page + 5)) {
                            var sep = ' ';
                        } else {
                            var sep = ' | ';
                        }
                        $("#" + type + "-threads-list .pagination").append('<a ' + ((i == page) ? 'class="underline" ' : '') + 'onClick="getList(\'' + type + '\', \'' + i + '\', \'' + board + '\');">' + i + '</a>' + sep);
                    }
                }

                $("#" + type + "-threads-list .pagination").append('<a onClick="getList(\'' + type + '\', \'' + pages + '\', \'' + board + '\');">>></a>');
            } else {
                $("#" + type + "-threads").html('Whoa! There\'s no threads in the database!');
            }
        });
    }
}

function getSocialLinks()
{
    socialLinks.style["top"] = "20px";
    if($(window).width() < 970) {
        $("#socialLinks").hide();
    } else {
        $("#socialLinks").show();
    }
}

$("#archiveForm").submit(function(e) {
    processForm();
    e.preventDefault();
});

function processForm()
{
    var threadUrl = $("#threadUrl").val();
    formElementsPower(0);
    if(threadUrl.length == 0){
        msg("archiveForm", "error", 'Enter a thread URL!');
        formElementsPower(1);
        return;
    }
    threadUrl = threadUrl.replace("https://", "http://");
    if(threadUrl.indexOf("http://") == -1) {
        threadUrl = "http://" + threadUrl;
    }
    if(threadUrl.indexOf("http://www.") != -1) {
        threadUrl = threadUrl.replace("http://www.", "http://");
    }
    var hashtagSpot = threadUrl.indexOf("#");
    if(hashtagSpot != -1) {
        threadUrl = threadUrl.substr(0, hashtagSpot);
    }
    var checkUrl = new RegExp("^http://boards\.4chan\.org/([a-zA-Z.]{1,4})/thread/([1-9][0-9]{0,9})/?(.*?)/?$", "i");
    var matchUrl = threadUrl.match(checkUrl);
    if(threadUrl.length < 24 ||threadUrl.substring(0, 24) != "http://boards.4chan.org/" || matchUrl == null)
    {
        msg("archiveForm", "error", 'Malformed URL. Make sure you enter a valid 4chan thread URL');
        formElementsPower(1);
        return;
    }
    
    var board = matchUrl[1];
    var threadId = matchUrl[2];
    
    msg("archiveForm", "neutral", 'Archiving thread...');
    
    var time1 = setTimeout(function() { msg("archiveForm", "neutral", 'Archiving thread... Archiving can take a bit of time, so bear with us.') }, 7000);
    var time2 = setTimeout(function() { msg("archiveForm", "neutral", 'Archiving thread... Still working on this thread...') }, 14000);
    var time3 = setTimeout(function() { msg("archiveForm", "neutral", 'Archiving thread... We\'re still working on this thread. Hang in there.') }, 18000);
    var time4 = setTimeout(function() { msg("archiveForm", "neutral", 'Archiving thread... Don\'t go! We\'re still archiving this. Images can take a while.') }, 30000);
    
    $.post("/api/archive", {board:board, id:threadId}, function(data) {
        if(!data.success) {
            clearTimeout(time1);
            clearTimeout(time2);
            clearTimeout(time3);
            clearTimeout(time4);
            msg("archiveForm", "error", data.response.error);
            formElementsPower(1);
        } else {
            clearTimeout(time1);
            clearTimeout(time2);
            clearTimeout(time3);
            clearTimeout(time4);
            msg("archiveForm", "success", 'Your thread has been archived. You can see it <a href="/' + board + '/thread/' + threadId + '">here</a>');
            $("#threadUrl").val('');
            formElementsPower(1);
        }
    });
    return;
}
function msg(id, status, text)
{
    if($("body").has("#alert-box").length) {
        $("#" + id + " #alert-box").removeClass(function () {
            return $(this).attr("class");
        })
        .addClass("alert " + status)
        .html('<div class="status ' + status + '"></div> ' + text);
    } else {
        $("#" + id).prepend('<div class="alert ' + status + '" id=\"alert-box\">' + text + '</div>');
    }
}

function formElementsPower(status)
{
    if(status == 1) {
        $("#threadUrl").removeAttr("disabled");$("#btnArchive").removeAttr("disabled");
    } else {
        $("#threadUrl").attr("disabled", "true");$("#btnArchive").attr("disabled", "true");
    }
}
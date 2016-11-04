/**
 * Created by alwaysbollu on 11/2/16.
 */
var host = window.location.host,
    selfUserAvatar = $(".header-avatar"),
    chatBox = $(".chat-box"),
    usersPanel = $("#userspanel"),
    rightSideBar = $(".sidebar-300.offscreen-right");

rightSideBar.hide();

var aliveUrl = selfUserAvatar.data("alive-url"),
    selfUser = selfUserAvatar.data("selfuser"),
    selfUserName = selfUserAvatar.data("selfuser-name"),
    threadUrl = chatBox.data("thread-url"),
    onlineUrl = usersPanel.data("online-url"),
    offlineUrl = usersPanel.data("offline-url");

var partner, partnerName, partnerTitle;

function stillAlive() {
    $.ajax({
            url: 'http://' + host + aliveUrl + "&id=" + selfUser,
        dataType: 'json',
        success: function (data) {
            console.log("User is still alive: updated")
        }
    })
}

stillAlive();

window.setInterval(function(){
    stillAlive();
}, 30000);


function getOnlineUsers() {
    var url = onlineUrl + "&id=" + selfUser;
    $.ajax({
            url: 'http://' + host + url,
        dataType: 'json',
        success: function (data) {
            var onlineUsers = '';
            $.each(data, function (i, user) {
                onlineUsers += '<div class="chat-user" data-partner="' + user.id + '"> <div class="user-avatar"><img src="/projectFluxChat/web/img/faceless.jpg" class="img-circle" alt="">  <div class="status bg-success"></div>  </div> <div class="user-details"><p>' + user.firstname + ' ' + user.lastname + '</p> <small class="user-department">' + user.title + '</small> </div> </div>';
            });
            $("#online-users").html(onlineUsers);
        }
    });
}

function getOfflineUsers() {
    var url = offlineUrl + "&id=" + selfUser;
    $.ajax({
            url: 'http://' + host + url,
        dataType: 'json',
        success: function (data) {
            var offlineUsers = '';
            var timeNow = Math.floor(Date.now() / 1000);
            $.each(data, function (i, user) {
                var last_seen = "Last seen ";
                if (timeNow <= parseInt(user.last_seen) + 3600) {
                    last_seen += String(Math.floor((timeNow - user.last_seen) / 60));
                    last_seen += " minutes ago";
                } else if (timeNow <= parseInt(user.last_seen) + 86400) {
                    last_seen += String(Math.floor((timeNow - user.last_seen) / 3600));
                    last_seen += " hours ago";
                } else {
                    last_seen += String(Math.floor((timeNow - user.last_seen) / 86400));
                    last_seen += " days ago";
                }
                offlineUsers += '<div class="chat-user" data-partner="' + user.id + '"> <div href="javascript:;" class="user-avatar"><img src="/projectFluxChat/web/img/faceless.jpg" class="img-circle" alt="">  </div> <div class="user-details"><p>' + user.firstname + ' ' + user.lastname + '</p> <small class="user-department">' + last_seen + '</small> </div> </div>';
            });
            $("#offline-users").html(offlineUsers);
        }
    });
}

getOnlineUsers();
getOfflineUsers();

window.setInterval(function () {
    getOnlineUsers();
}, 30000);

window.setInterval(function () {
    getOfflineUsers();
}, 30000);



usersPanel.on("click", ".chat-user", function(){
    partner = this.getAttribute("data-partner");
    partnerName = $(this).find(".user-details").find("p").text();
    partnerTitle = $(this).find(".user-details").find("small").text();
    chatBox.data("partner", partner);
    chatBox.data("partner-name", partnerName);
    chatBox.data("partner-title", partnerTitle);
    $('.main-content.index-main').hide();
    $('.main-content.chatbox-holder').show();
    rightSideBar.show();
    $(rightSideBar).find('.panel-body').find('.h5').html('<b>' + partnerName + '</b>');
    $(rightSideBar).find('.panel-body').find('p.text-muted').html(partnerTitle);
    $(rightSideBar).find('.panel-footer').find('.bg-info').html('<a href="javascript:;"> <span class="ti-user show mb5"></span> ' + formatDate(1478020080) + ' </a>');
    refreshChatPane();
});

function refreshChatPane() {
    var url = threadUrl + "&user1=" + selfUser + "&user2=" + partner;
    var partnerFlag = false,
        selfFlag = false;
    $.ajax({
        url: 'http://' + host + url,
        dataType: 'json',
        success: function (data) {
            var messages = '',
                startFlag = true;
            chatBox.data("thread", data.thread_id);
            $.each(data.messages, function (i, msg) {
                if (msg.author_id !=  selfUser) {
                    if (partnerFlag) {
                        messages += "<p>" + msg.content + "</p>";
                    } else {
                        if (!startFlag) {
                            messages += '</div> </div><hr>';
                        } else {
                            startFlag = false;
                        }
                        messages += '<div class="media"><a class="pull-left" href="javascript:;"> <img class="media-object avatar"src="/projectFluxChat/web/img/faceless.jpg"alt=""> </a> <div class="comment"> <div class="comment-meta small">' + formatTime(msg.created_time) + '</div><div class="comment-author h6 no-m"><a href="javascript:;"><b>' + partnerName + '</b></a></div> <p style="margin-top: 2px">' + msg.content + '</p>';
                        partnerFlag = true;
                        selfFlag = false;
                    }
                }
                else {
                    if (selfFlag) {
                        messages += "<p>" + msg.content + "</p>";
                    } else {
                        if (!startFlag) {
                            messages += '</div> </div><hr>';
                        } else {
                            startFlag = false;
                        }
                        messages += '<div class="media"><a class="pull-left" href="javascript:;"> <img class="media-object avatar"src="/projectFluxChat/web/img/faceless.jpg"alt=""> </a> <div class="comment"> <div class="comment-meta small">' + formatTime(msg.created_time) + '</div><div class="comment-author h6 no-m"><a href="javascript:;"><b>' + selfUserName + '</b></a></div> <p style="margin-top: 2px">' + msg.content + '</p>';
                        partnerFlag = false;
                        selfFlag = true;
                    }
                }
            });
            chatBox.html(messages);
        }
    });
}

$(document).keypress(function(e) {
    if(e.which == 13 && $("#new-message").val() != "") {
        submitMessage();
    }
});

function submitMessage() {
    var url = $("#submit-message").data("url"),
        content = $("#new-message").val(),
        thread = chatBox.data("thread");

    $.post('http://' + host + url,
        {
            'content': content,
            'thread_id': thread,
            'author_id': selfUser,
            'user2': partner
        },
        function(data, status){
            if(data != "Failure"){
                $("#new-message").val("");
                refreshChatPane();
            } else {
                alert("Error while updating the messages");
            }
        });
}

window.setInterval(function () {
    if (partner != null)
        refreshChatPane();
}, 3000);

function formatDate(unixTimeStamp) {
    var timestampInMilliSeconds = unixTimeStamp*1000;
    var date = new Date(timestampInMilliSeconds);

    var day = (date.getDate() < 10 ? '0' : '') + date.getDate();
    var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1);
    var year = date.getFullYear();

    var hours = ((date.getHours() % 24 || 12) < 10 ? '0' : '') + (date.getHours() % 24 || 12);
    var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();

    var formattedDate = day + ' ' + GetMonthName(month) + ' ' + year;

    return formattedDate;

}

function formatTime(unixTimeStamp) {
    var timestampInMilliSeconds = unixTimeStamp*1000;
    var date = new Date(timestampInMilliSeconds);

    var day = (date.getDate() < 10 ? '0' : '') + date.getDate();
    var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1);
    var year = date.getFullYear();

    var hours = ((date.getHours() % 24 || 12) < 10 ? '0' : '') + (date.getHours() % 24 || 12);
    var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();

    var formattedDate = day + ' ' + GetMonthName(month) + ' ' + year + ', ' + hours + ':' + minutes;

    return formattedDate;

}

function GetMonthName(monthNumber) {
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return months[monthNumber - 1];
}
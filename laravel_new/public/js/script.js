var base = '';
$(document).ready(function () {

    var opener = {
        popup: null,
        newPopup: function (url) {
            var self = this;

            self.popup = window.open(url, "", "width=600, height=500");

            var winTimer = window.setInterval(function ()
            {
                if (self.popup.closed !== false)
                {
                    console.log('its closed');
                    listFollowers();
                    window.clearInterval(winTimer);
                }
            }, 200);
        },
    }

    $("#twitter_login").on('click', function () {
        var url = base + "/twitter/login";
        var twitter = opener;
        twitter.newPopup(url);
    });

    $(".submit_form").on('click', function (e) {
        e.preventDefault();
        var message = $("#message").val();
        var flage = false, isSubmit = false;
        var fb_count = $('#facebook_friend input:checked').length;
        var tw_count = $('#twitter_friend input:checked').length;
        var em_count = $("#emails").val().trim();


        console.log('FB : ' + fb_count);
        console.log('tw : ' + tw_count);
        console.log('em : ' + em_count);

        if (fb_count == 0 && tw_count == 0 && em_count == "")
        {
            flage = true;
        }

        if (message.trim() == "")
        {
            alert('Message is reuired');
        }
        else if (flage)
        {
            alert('Select at least one method');
        }
        else
        {


            var url = base + "/postSend";
            $.ajax({
                url: url,
                dataType: 'json',
                data: $("#mainForm").serialize(),
                type: 'POST',
                success: function (response) {
                    console.log('done');
                    console.log(response);

                    if (response.result)
                    {
                        var selected = "";
                        $('#facebook_friend input:checked').each(function () {
                            selected += $(this).attr('value') + ",";
                        });
                        message += " " + response.data.link;
                        options = {
                            'message': message,
                            'tags': selected
                        };

                        console.log(options);

                        FB.api('/me/feed', 'post', options, function (response) {
                            if (!response || response.error) {
                                console.log("error");
                                console.log(response);
                            } else {
                                console.log(response);
                                $("#mainForm").submit();
                            }

                        });

                        setTimeout(function () {
                            $("#mainForm").submit();
                        }, 500);
                    }
                },
                error: function (response)
                {
                    console.log('Error in ajax');
                    console.log(response);
                }
            });
        }
        return false;
    });

});
//
//
// function listSomeFollowers()
// {
//     var url = base + "/twitter/followers";
//     console.log('init Twitter listFollowers');
//     $("#twitter_login").addClass('hide');
//     $("#twitter_friend").html("Loading followers..");
//     $.ajax({
//         url: url,
//         dataType: 'json',
//         type: 'GET',
//         data: {},
//         success: function (response) {
//             console.log(response);
//             var temp = "";
//             for (var key in response.users)
//             {
//               //  var img = response.users[key].profile_image_url;
//                 temp += '<div class="col-lg-3 margin-bottom">' +
//                         '<label class="label-list">' +
//                         '<div class="pull-left">' +
//                         //'<img src="' + img + '" width="50" height="50" />' +
//                         '</div>' +
//                         '<div class="pull-left">' +
//                         '<span style="margin-left:10px">' + response.users[key].name + '</span>' +
//                         '<input type="checkbox" class="tw_post" name="invite_tw[' + response.users[key].id + ']" value="' + response.users[key].screen_name + '" />' +
//                         '</div>' +
//                         '</label>' +
//                         '</div><br>';
//             }
//
//             $("#twitter_friend").html(temp);
//         },
//         error: function (response) {
//             console.log('error in fetching followers');
//             console.log(response);
//             $("#twitter_friend").html("");
//             $("#twitter_login").removeClass('hide');
//         }
//     });
// }
//

function listFollowers()
{
    var url = base + "/twitter/followers";
    console.log('init listFollowerd');
    $("#twitter_login").addClass('hide');
    $("#twitter_friend").html("Loading followers..");
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        data: {},
        success: function (response) {
            console.log(response);
            var temp = "";
            for (var key in response.users)
            {
        //        var img = response.users[key].profile_image_url;
                temp += '<div class="col-lg-3 margin-bottom">' +
                        '<label class="label-list">' +
                        '<div class="pull-left">' +
            //            '<img src="' + img + '" width="50" height="50" />' +
                        '</div>' +
                        '<div class="pull-left">' +
                        '<span style="margin-left:10px">' + response.users[key].name + '</span>' +
                        '<input type="checkbox" class="tw_post" name="invite_tw[' + response.users[key].id + ']" value="' + response.users[key].screen_name + '" />' +
                        '</div>' +
                        '</label>' +
                        '</div><br>';
            }
            console.log(temp);
            $("#twitter_friend").html(temp);
        },
        error: function (response) {
            console.log('error in fetch followers');
            console.log(response);
            $("#twitter_friend").html("Could not fetch the users");
            $("#twitter_login").removeClass('hide');
        }
    });
}

function listFriends(response)
{
    var temp = "<select  class='js-example-basic-multiple' multiple='multiple'>";
    if (!response.data)
    {
        //return;
    }

    for (var key in response.data)
    {

    //    var img = response.data[key].picture.data.url;
        temp += '<div class="col-lg-3 margin-bottom">' +
                '<label class="label-list">' +
                '<div class="pull-left">' +
          //      '<img src="' + img + '" width="50" height="50" />' +
                '</div>' +
                '<div class="pull-left">' +
              //  '<span style="margin-left:10px">' + response.data[key].name + '</span>' +
                '<option type="checkbox" class="fb_post" name="invite_fb[]" value="' + response.data[key].id + '" >' +
response.data[key].name +
                '</option>' +
                '</div>';
    }
    temp += "</select>";
    $('#facebook_friend').html(temp);
}

function setBase(url)
{
    base = url;
}

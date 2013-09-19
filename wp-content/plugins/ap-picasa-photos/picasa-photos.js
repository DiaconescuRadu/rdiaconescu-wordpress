var PPUserName = "";
var PPAlbum = "";

jQuery(document).ready(function () {
    jQuery(BackToAlbumsButton).click(OnGetAlbums);
    jQuery(InsertAllImagesButton).click(InsertAllImagesButton_Click);
    PPUserName = ReadCookie("PicasaPhotosAccountUserName");
    PPAlbum = ReadCookie("PicasaPhotosAlbumId");
    jQuery(UserName).val(PPUserName);

    if (PPUserName != "") {
        if (PPAlbum != "")
            ShowImages(PPUserName, PPAlbum, "un titlu de album");
        else
            ShowAlbums(PPUserName, acToken);
    }
});

function InsertAllImagesButton_Click() {
    InsertImages(CurrentImages);
}

function OnGetAlbums() {
    try {
        PPUserName = jQuery(UserName).val();
        WriteCookie("PicasaPhotosAccountUserName", PPUserName);
        WriteCookie("PicasaPhotosAlbumId", "");
        ShowAlbums(PPUserName, acToken);
    }
    catch(e) {
        alert(e);
    }
}

function UserName_OnKeyPress(e) {
    if (e.keyCode == 13) {
        OnGetAlbums();
        return false;
    }
}

function InsertImages(srcs) {
    var html = "";
    jQuery.each(srcs, function(i, src) {
        html += '<img class="aligncenter" src="' + src + '"/>';
        html += "\n&nbsp;\n";
    });
    InsertHtml(html);
}

function InsertImage(src) {
    var html = '<img class="aligncenter" src="' + src + '"/>';
    html += "\n&nbsp;\n";
    InsertHtml(html);
}

function InsertHtml(html) {
    //console.log('sending to editor html: ' + html);
    var win = window.dialogArguments || opener || parent || top;

    win.send_to_editor(html);
}

function ShowAlbums(userid, token) {
    jQuery(DivImages).hide();
    jQuery(DivAlbums).show();
    jQuery(DivAlbums2).show();
    jQuery(DivAlbumsContainer).empty();

    var url = "http://picasaweb.google.com/data/feed/base/user/:user_id?alt=json&kind=album&hl=en_US&access=visible&fields=entry(id,media:group(media:thumbnail,media:description,media:keywords,media:title))&thumbsize=144c"
    url = url.replace(/:user_id/, userid);
    if (token && token != "")
        url = url + "&access_token=" + token;
    //console.log("Load albums from: " + url);

    jQuery.getJSON(url, function (data) {
        var album = null;
        var albums = [];
        if (data.feed.entry) {
            jQuery.each(data.feed.entry, function (i, element) {
                var div = document.createElement("div");
                div.className = "album";

                var title = element["media$group"]["media$title"]["$t"];

                var img = document.createElement("img");
                img.src = element["media$group"]["media$thumbnail"][0]["url"];
                img.className = "albumCoverImage";

                img.addEventListener("click", function () {
                    ShowImages(userid, element.id["$t"].split("?")[0].split("albumid/")[1], title);
                });
                div.appendChild(img);

                var divTitle = document.createElement("div");
                divTitle.className = "albumTitle";
                divTitle.innerHTML = title;
                div.appendChild(divTitle);

                jQuery(DivAlbumsContainer).append(div);
            });
        }
        else {
            jQuery(DivAlbumsContainer).html("no albums");
        }
    });
}

var CurrentImages;

function ShowImages(user_id, album_id) {
    jQuery(NumberOfImagesSpan).text("");
    jQuery(DivAlbums).hide();
    jQuery(DivImages).show();
    jQuery(DivImagesContainer).empty();

    WriteCookie("PicasaPhotosAlbumId", album_id);

    var urla = 'http://picasaweb.google.com/data/feed/base/user/' + user_id + '/albumid/' + album_id + '?alt=json&kind=photo&hl=en_US&fields=title,entry(title,gphoto:numphotos,media:group(media:content,media:thumbnail))';
    //console.log(urla);

    jQuery.getJSON(urla, function (data2) {
        album_title = data2.feed.title["$t"];
        jQuery(SpanAlbumTitle).text(album_title);
        CurrentImages = new Array();

        jQuery.each(data2.feed.entry, function (i2, element2) {
            var src = element2["media$group"]["media$content"][0]["url"];
            CurrentImages[i2] = src;
            //console.log(i2 + ": " + element2);
            var div = document.createElement("div");
            div.className = "imageContainer";
            var img = document.createElement("img");
            img.src = element2["media$group"]["media$thumbnail"][1]["url"];
            img.className = "image";
            img.addEventListener("click", function () {
                InsertImage(src);
            });
            div.appendChild(img);
            jQuery(DivImagesContainer).append(div);
        });

        jQuery(NumberOfImagesSpan).text("(" + CurrentImages.length + ")");
    });
};



// Google authentication

var OAUTHURL    =   'https://accounts.google.com/o/oauth2/auth?';
var VALIDURL    =   'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
var SCOPE       =   'http://picasaweb.google.com/data/';
var CLIENTID    =   '453140513664-8mlckjkoij59l2sh4fqbr4d7ppu696fv.apps.googleusercontent.com';
//var REDIRECT    =   'http://andreipana.net/oauth';
var REDIRECT    =   'http://localhost/oauth';
var LOGOUT      =   'http://accounts.google.com/Logout';
var TYPE        =   'token';
var _url        =   OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;
var acToken;
var tokenType;
var expiresIn;
var user;
var loggedIn    =   false;

    
function login() {
    var win = window.open(_url, "PicasaPhotosGoogleAuthWindow", 'width=600, height=400');

    var pollTimer = window.setInterval(function () {
        try {
            if (win.document.URL.indexOf(REDIRECT) != -1) {
                window.clearInterval(pollTimer);
                var url = win.document.URL;
                acToken = gup(url, 'access_token');
                tokenType = gup(url, 'token_type');
                expiresIn = gup(url, 'expires_in');
                win.close();
                
                validateToken(acToken);
            }
        } catch (e) {
        }
    }, 500);
}

function validateToken(token) {
    jQuery.ajax({
        url: VALIDURL + token,
        data: null,
        success: function (responseText) {
            //console.log("token is valid!");
            //console.log("token: " + token);
            //console.log("response: " + responseText);

            getUserInfo();
            loggedIn = true;
        },
        dataType: "jsonp"
    });
}

function getUserInfo() {
    jQuery.ajax({
        url: 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' + acToken,
        data: null,
        success: function(resp) {
            user    =   resp;
            //console.log(user);
            jQuery('#uName').text('Welcome ' + user.name);
            jQuery('#imgHolder').attr('src', user.picture);
        },
        dataType: "jsonp"
    });
}

//credits: http://www.netlobo.com/url_query_string_javascript.html
function gup(url, name) {
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\#&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( url );
    if( results == null )
        return "";
    else
        return results[1];
}
/*
function startLogoutPolling() {
    $('#loginText').show();
    $('#logoutText').hide();
    loggedIn = false;
    $('#uName').text('Welcome ');
    $('#imgHolder').attr('src', 'none.jpg');
}
*/



// Cookies support
function WriteCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else var expires = "";
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function ReadCookie(name) {
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
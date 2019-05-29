
var ads_priv = document.location.protocol + "//syndication.exosrv.com/ads-priv.php";
var c_name="splash_i";if(-1==document.cookie.indexOf(c_name+"=")){var expires,date=new Date;date.setTime(date.getTime()+31536e6),expires="; expires="+date.toGMTString(),value="true",isIE=function(i){this.ua=i;var e=this.ua.indexOf("msie ");if(e>0)return parseInt(this.ua.substring(e+5,this.ua.indexOf(".",e)),10);if(this.ua.indexOf("trident/")>0){var t=this.ua.indexOf("rv:");return parseInt(this.ua.substring(t+3,this.ua.indexOf(".",t)),10)}var n=this.ua.indexOf("edge/");return n>0&&parseInt(this.ua.substring(n+5,this.ua.indexOf(".",n)),10)},isSafari=function(i){this.ua=i;try{return!!window.safari||-1!=this.ua.indexOf("safari")&&-1===this.ua.indexOf("chrome")&&-1===this.ua.indexOf("crios")}catch(e){return!1}},isChrome=function(i){this.ua=i;try{return!!window.chrome||-1!==this.ua.indexOf("crios")||0===window.navigator.vendor.indexOf("Google")&&-1!==this.ua.indexOf("chrome")}catch(e){return!1}},isFirefox=function(i){this.ua=i;try{return-1!=this.ua.indexOf("firefox")}catch(e){return!1}},getBrowser=function(){var i=window.navigator.userAgent.toLowerCase(),e={ie:isIE,safari:isSafari,chrome:isChrome,firefox:isFirefox},t=null;for(browser_key in e){var n=e[browser_key];if(1==n(i)){t=browser_key;break}}return t},checkIncognito=function(i,e){var t={chrome:isChromeIncognito,ie:isIEIncognito,safari:isSafariIncognito,firefox:isFirefoxIncognito};if("function"==typeof t[i]){var n=t[i];n(e)}else e(!1)},isIEIncognito=function(i){if(this.browser.isIE<10)return i(!1),!1;try{i(window.indexedDB?!1:!0)}catch(e){i(!1)}},isSafariIncognito=function(i){try{window.localStorage.setItem("check",1),window.localStorage.getItem("check"),window.localStorage.removeItem("check"),i(!1)}catch(e){i(!0)}},isChromeIncognito=function(i){try{window.webkitRequestFileSystem?window.webkitRequestFileSystem(window.TEMPORARY,1,function(){i(!1)}.bind(this),function(){i(!0)}.bind(this)):i(!1)}catch(e){i(!1)}},isFirefoxIncognito=function(i){var e;try{e=window.indexedDB.open("test"),e.onerror=function(){i(!0)}.bind(this),e.onsuccess=function(){i(!1)}.bind(this)}catch(t){i(!0)}};var browser=getBrowser();if(null===browser){if(document.cookie=c_name+"=false"+expires+"; path=/",null===document.getElementById("ads_priv")){var i=document.createElement("script");i.id="ads_priv",i.src=ads_priv+"?i=0",document.body.appendChild(i)}}else checkIncognito(browser,function(i){if(document.cookie=c_name+"="+i+expires+"; path=/",null===document.getElementById("ads_priv")){i=1==i?1:0;var e=document.createElement("script");e.id="ads_priv",e.src=ads_priv+"?i="+i,document.body.appendChild(e)}})}
(function() {
var site_hostname = 'syndication.exosrv.com';
var widthExoLayer       = 300 + 20;
var heightExoLayer      = 100;
var frequency_period = 0;
var closeImage = '//static.exosrv.com/images/close-icon-circle.png';
var closedStatus = false;

function setCookie(c_name, value, minutes_ttl) {
    var exdate = new Date();
    exdate.setMinutes(exdate.getMinutes() + minutes_ttl);
    var c_value = escape(value) + "; expires=" + exdate.toUTCString() + ";domain=." + site_hostname + ";path=/";
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            return unescape(y);
        }
    }
}


var codeExoLayer = ''
    + '<div id="divExoLayerWrapper" style="height:0px; display:none; visibility:hidden; background: none repeat scroll 0 0 rgba(226, 226, 226, 0.8) !important;     bottom: 0 !important; left: 0 !important; position: fixed !important; text-align: center; width: 100%; z-index: 1999900 !important; transition: height 1s ease-in-out 0s; -webkit-transition: height 1s ease-in-out 0s; -o-transition: height 1s ease-in-out 0s; -moz-transition: height 1s ease-in-out 0s; -ms-transition: height 2s ease-in-out 0s;">'
    + '<div id="divExoLayer" style="position: relative; min-width: 150px; width: 100%; height: 0px;">'
    + '<div style="max-width: 300px; margin: 0 auto;">'
        + '<div id="exoCloseButton" style="height:24px;width:24px;float:right;top:-12px;right:-12px;position:relative;z-index:100;cursor:pointer;vertical-align:top;">'
            + '<img src="' + closeImage + '">'
        + '</div>'
    + '<iframe id="exoIMFrame" frameborder="0" scrolling="no" style="position: relative; top:-24px;" width="300px" height="100px"></iframe>'
    + '</div>'
    + '</div>'
    + '</div>';

function writeExoLayer() {
    document.write(codeExoLayer);
    var doc = document.getElementById('exoIMFrame').contentWindow.document;
    doc.open();
        doc.write('<body style="margin:0px;"><a id="Advert" style="width: 100%" href="https://main.exosrv.com/click.php?data=IHwzMDc0NDI0fHxodHRwcyUzQSUyRiUyRnd3dy5pb3FxLm5ldCUyRmhvbWUlMkYlM0ZzaXplJTNEMTAwJTNGY2FtcGFpZ24lM0QzMDc0NDI0JTNGY291bnRyeSUzRENITiUzRmtleXdvcmQlM0QlM0Z0YWdzJTNEc3luZGljYXRpb24lMkNleG9zcnYlMkNjb20lMkNzcGxhc2glMkNwaHAlMkNpZHpvbmUlMkMyOTk3NTgwJTJDY2FwcGluZyUyQzB8fHwwfHwxNTU2Njc0NTAwfDkxLnl6eXoubWx8MTgzLjE5OS4xNzIuMjh8fDMwNjUwMzcyfDI5OTc1ODB8NTEwfHwwfDEyfDEyfDUxOHwxfHwzMDB4MTAwfDF8MXx8fDMzNTk2MDY3fHwxfDB8c3luZGljYXRpb24uZXhvc3J2LmNvbXwwfDB8MHwgIHN5bmRpY2F0aW9uIGV4b3NydiBjb20gc3BsYXNoIHBocCBpZHpvbmUgMjk5NzU4MCBjYXBwaW5nIDAgfHwxfDJ8MHwwfDB8MTgwODc3M3wwfDE4MDgzOTJ8fHwwfDEwfHwwfDB8T0t8NDdhMzI4ZTVmZTE4YWM2ZGEzMDBmMTRhY2Y4NDg3MWI%3D" target="_blank"><img src="https://static.exosrv.com/library/587282/7562fb1c4d1c014b048e9479429544b512fd5dba.jpg" style="max-width: 300px; border: 0px; width:100%;"></a></body>');
        doc.close();
}

function closeExoLayer(e) {
    e.stopPropagation();
    e.preventDefault();
    document.getElementById('divExoLayerWrapper').style.display = "none";
    closedStatus = true;
    setCookie('splash-closed-2997580', closedStatus, frequency_period);
}

function adEvent(e) {
    e.stopPropagation();
}

function showExoLayer() {
    document.getElementById('divExoLayerWrapper').style.display = "block";
    if ( document.getElementById('divExoLayerWrapper').style.visibility == "hidden" ) {
        document.getElementById('divExoLayerWrapper').style.visibility = "visible";
    }
    window.setTimeout(function() {
        document.getElementById('divExoLayerWrapper').style.height = heightExoLayer + 'px';
    }, 100);
}

function loadExoLayer() {
    showExoLayer();

    var et = document.getElementById('exoCloseButton');
    et.addEventListener('mousedown',closeExoLayer,true);
    et.addEventListener('touchstart',closeExoLayer,true);
    et.addEventListener('mouseup',closeExoLayer,true);
    et.addEventListener('touchend',closeExoLayer,true);

    et = document.getElementById('Advert');
    if (et != null) {
        et.addEventListener('mouseup',adEvent);
        et.addEventListener('touchend',adEvent);
        et.addEventListener('mousedown',adEvent);
        et.addEventListener('touchstart',adEvent);
    }
}

var capping = '0';
var shownCookie = getCookie('splash-2997580');
closedStatus    = getCookie('splash-closed-2997580');

if (isNaN(shownCookie)) shownCookie = 0;
shownCookie = parseInt(shownCookie);

if ((capping>0 && shownCookie>=capping) || closedStatus) {
} else {
    writeExoLayer();
    window.setTimeout(loadExoLayer, 2000);
    shownCookie = shownCookie + 1;
    setCookie('splash-2997580', shownCookie, 6*60);
}

})();

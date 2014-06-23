/*
ex library
version : ex-0.1
url : http://webs-k.com/
*/
var ex = {};

// Property Extend
ex.extend = function(ext1, ext2) {
    for(var property in ext2) {
        ext1[property] = ext2[property]
    }
    return ext1
};

// is UserAgent true match
ex.isUA = function(userAgent) {
    return (navigator.userAgent.indexOf(userAgent) != -1)
};

// is UserAgent false match
ex.ifUA = function(userAgent) {
    return (navigator.userAgent.indexOf(userAgent) === -1)
};

// param check
ex.param = function(param1,param2) {
    return (param1 === undefined ? param2 : param1)
};

ex.isMobile = function() {
    var iOS = (ex.isUA('iPhone') || ex.isUA('iPod')),
        Android = (ex.isUA('Android') && ex.isUA('Mobile')),
        WindowsPhone = (ex.isUA('Windows') && ex.isUA('Phone')),
        AndroidOld = (ex.isUA('dream') || ex.isUA('CUPCAKE')),
        blackberry = (ex.isUA('blackberry9500') || ex.isUA('blackberry9530') || ex.isUA('blackberry9520') || ex.isUA('blackberry9550') || ex.isUA('blackberry9800')),
        webOS = ex.isUA('webOS'),
        Other = (ex.isUA('incognito') || ex.isUA('webmate'));
    return (iOS || Android || WindowsPhone || AndroidOld || blackberry || webOS || Other)
};


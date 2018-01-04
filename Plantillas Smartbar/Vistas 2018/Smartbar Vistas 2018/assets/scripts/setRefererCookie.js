/*
Se busca si existe la cookie que settea el lugar al cual llego el usuario, si no existe se crea la cookie
*/

if (!document.cookie.match('al-nice-to-meet-you')) {
   var expiry = new Date();
   var userAgent = navigator.userAgent;
   var cookieInfo = {
           'first-landing' : window.location.href,
           'when' : expiry.toUTCString(),
           'referrer' : document.referrer,
           'user-agent' : userAgent.replace(";", "")
       };
   var expiry = new Date();
   
   //Se pone cookie en 2 años
    expiry.setTime(expiry.getTime() + (730 *24*60*60*1000));
    document.cookie = 'al-nice-to-meet-you='+JSON.stringify(cookieInfo)+'; expires='+ expiry.toUTCString()+';path=/;domain=alegra.com';
}
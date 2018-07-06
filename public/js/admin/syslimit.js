/**
 * syslimit.js
 * //检测浏览器内核--返回的是两个key，name：浏览器内核的名称---version：浏览器的版本号
 */
var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串  
var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器  
var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器  
var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
if(isIE || isEdge || isIE11) {
    alert('检测到您的浏览器为IE内核，暂不支持IE内核浏览器！--请使用非IE浏览器或双核浏览器极速模式！以保证稳定运行--');
}
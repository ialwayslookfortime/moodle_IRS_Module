$(document).ready(function(){ $(window).resize(function(){ $("#container").css('width', $(window).width()); }); }); 

function goLite(FRM,BTN)
{
   window.document.forms[FRM].elements[BTN].style.backgroundColor = "#2888D8";
   window.document.forms[FRM].elements[BTN].style.borderTopColor = "#2888D8";
   window.document.forms[FRM].elements[BTN].style.borderBottomColor = "#2888D8";
   window.document.forms[FRM].elements[BTN].style.borderLeftColor = "#1864D0";
   window.document.forms[FRM].elements[BTN].style.borderRightColor = "#58A4E0";
}

function goDim(FRM,BTN)
{
   window.document.forms[FRM].elements[BTN].style.backgroundColor = "#000000";
   window.document.forms[FRM].elements[BTN].style.borderTopColor = "#000000";
   window.document.forms[FRM].elements[BTN].style.borderBottomColor = "#000000";
   window.document.forms[FRM].elements[BTN].style.borderLeftColor = "#000000";
   window.document.forms[FRM].elements[BTN].style.borderRightColor = "#000000";
}

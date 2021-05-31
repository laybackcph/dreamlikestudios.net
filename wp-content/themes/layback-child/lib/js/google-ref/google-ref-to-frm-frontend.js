var sAjaxURL 			= sGFFparam.sAjaxURL;
var aParaRef 			= sGFFparam.aParaRef;
var	iPostID			 	= sGFFparam.iPostID;
var aVisitedPagesKey  	= sGFFparam.aVisitedPagesKey;

// console.dir(aVisitedPagesKey);
// console.dir("22");
jQuery(document).ready(function()
{
	// console.log("/google-ref9")
	if(Cookies.get('sVisitedPages') != undefined)
	{
		aTempVisitedPagesList = JSON.parse(Cookies.get('sVisitedPages'));
		aTempVisitedPage = {
					'sPageID': iPostID,
					'sPageUrl': location.href,
					 };
		if (Object.keys(aTempVisitedPagesList).length > 10) 
		{
			delete aTempVisitedPagesList[getKey(aTempVisitedPagesList)]
		    delete aTempVisitedPagesList[getKey(aTempVisitedPagesList)]
		}					
		aTempVisitedPagesList[Date.now()] = aTempVisitedPage;
		Cookies.set('sVisitedPages', aTempVisitedPagesList, {expires: 29});
	}
	else
	{
		aTempVisitedPagesList = ({});
		aTempVisitedPage = {
					'sPageID': iPostID,
					'sPageUrl': location.href,
					   };
		if (Object.keys(aTempVisitedPagesList).length > 10) 
		{
			delete aTempVisitedPagesList[getKey(aTempVisitedPagesList)]
		    delete aTempVisitedPagesList[getKey(aTempVisitedPagesList)]
		}
		aTempVisitedPagesList[Date.now()] = aTempVisitedPage;
		Cookies.set('sVisitedPages', aTempVisitedPagesList, {expires: 29});
	}

	for (var iKey in aParaRef) 
	{
		var sRefParameter = aParaRef[iKey];
		if(findGetParameter(sRefParameter) != null)
		{
			var sGETPara = findGetParameter(sRefParameter);
			Cookies.set(sRefParameter, sGETPara, { expires: 29 });
			console.log("cookie set: " + sGETPara)
		}

		if(Cookies.get(sRefParameter) != 'undefined' && jQuery('#field_'+iKey).length == 1)
		{
			jQuery('#field_'+iKey).val(Cookies.get(sRefParameter));
		}
    }

    for (var iKey in aVisitedPagesKey)
    {
    	if(Cookies.get('sVisitedPages') != 'undefined' && jQuery('#field_'+aVisitedPagesKey[iKey] == 1))
    	{
    		jQuery('#field_'+iKey).val(Cookies.get('sVisitedPages'))
    	}
    }	
});



function findGetParameter(parameterName) 
{
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

function getKey(data) 
{
  for (var prop in data)
    return prop;
}
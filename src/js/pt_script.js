  function sleep(ms) {
		var dt = new Date();
		dt.setTime(dt.getTime() + ms);
		while (new Date().getTime() < dt.getTime());
	}

  function menuHandleClick(mAction) {
      var currentValue = 0;
      //alert('New value: ' + mAction.value);
      currentValue = mAction.value;
      window.location.href = "menu_update.php?mAction="+mAction.value;
  }

  function productSearchClick(url) {
      url = url + '?BestNr='+document.getElementById('searchTxt').value;
      window.location.replace(url);
      //return true;
      alert(url);
      //alert('Forwarding to product');
  }
  
  function chkDel(){
    return confirm("Really delete it?");
  } 

  function formCheckMenuEdit() {       
	 if (document.Edit.menutekst.value == ""){
        	alert("Input Menu Data");
        	return false;
    }
	 if (document.Edit.mOrder.value == ""){
        	alert("Input Menu order");
        	return false;
    }
    
		document.Edit.Upd.value = "save";
  }

  function enaFieldsMenuEdit() {       
    document.getElementById('3').readOnly = false;
    document.getElementById('8').readOnly = false;
    alert("You can now edit the Order and Image fields");
  }
  
  function cancelRedirect(url){
    location.href=url+'?cancel=1';
  }
  
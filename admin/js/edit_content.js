
	function ShowSelection(startText, EndText)
	{
	  var textComponent = document.getElementById('text');
	  var startPos = textComponent.selectionStart;
    var endPos = textComponent.selectionEnd;
	  Texts = textComponent.value.substring(0, startPos) + startText + textComponent.value.substring(startPos, endPos) + EndText + textComponent.value.substring(endPos, textComponent.length);
	  return Texts;
	}
		$(document).ready(function (){
			$('#button_1').click(function (){
	      $("#text").val(ShowSelection('[B]', '[/B]'));
	      return false;
	    });
			$('#button_2').click(function (){
				$("#text").val(ShowSelection('[I]', '[/I]'));
	      return false;
	    });
			$('#button_3').click(function (){
				$("#text").val(ShowSelection('[U]', '[/U]'));
	      return false;
	    });
			$('#button_4').click(function (){
				// text = $("#text").val() + '[URL]http://example.com[/URL]';
		   //    $("#text").val(text);
		   	var url=prompt("Enter URL","http://");
		   	$("#text").val(ShowSelection('[URL=' + url + ']', '[/URL]'));
	      return false;
	    });
			$('#button_5').click(function (){
	      $("#text").val(ShowSelection('[LIST]\n[*]', '[/*]\n[*][/*]\n[*][/*]\n[/LIST]'));
	      return false;
	    });
			$('#button_6').click(function (){
	      $("#text").val(ShowSelection('[LIST=1]\n[*]', '[/*]\n[*][/*]\n[*][/*]\n[/LIST=1]'));
	      return false;
	    });
			$('#button_7').click(function (){
				$("#text").val(ShowSelection('[HEADER]', '[/HEADER]'));
	      return false;
	    });
			$('#button_8').click(function (){
				$("#text").val(ShowSelection('[CENTER]', '[/CENTER]'));
	      return false;
	    });
			$('#button_9').click(function (){
				$("#text").val(ShowSelection('[LEFT]', '[/LEFT]'));
	      return false;
	    });
			$('#button_10').click(function (){
				$("#text").val(ShowSelection('[RIGHT]', '[/RIGHT]'));
	      return false;
	    });
		});
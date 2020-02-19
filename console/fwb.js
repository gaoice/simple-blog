$(function()
{
	//普通
	var buttonsid=["strong","em","blockquote","del","ins","code"];
	for(var i=0;i<buttonsid.length;i++)
	{	
		$("#"+buttonsid[i]).click(function()
		{
			var id=$(this).attr("id");
			var val=$(this).text();
			if(val.indexOf("/")<0)
			{
				$(this).text("/"+val);
				$("#content").insertContent("<"+id+">");
			}
			else
			{
				$(this).text(val.replace("/",""));
				$("#content").insertContent("</"+id+">");
			}
		});
	}
	//结构类
	$("#ul").click(function()
	{
		if($("#ul").text()=="ul")
		{
			$("#ul").text("/ul");
			$("#content").insertContent('\r\n<ul>');
		}
		else
		{
			$("#ul").text("ul");
			$("#content").insertContent('</ul>\r\n\r\n');
		}
	});
	$("#ol").click(function()
	{
		if($("#ol").text()=="ol")
		{
			$("#ol").text("/ol");
			$("#content").insertContent('\r\n<ol>');
		}
		else
		{
			$("#ol").text("ol");
			$("#content").insertContent('</ol>\r\n\r\n');
		}
	});
	$("#li").click(function()
	{
		if($("#li").text()=="li")
		{
			$("#li").text("/li");
			$("#content").insertContent('<li>');
		}
		else
		{
			$("#li").text("li");
			$("#content").insertContent('</li>');
		}
	});
	//引用类
	$("#a").click(function()
	{
		$("#content").insertContent('<a href=""></a>');
	});
	$("#img").click(function()
	{
		$("#content").insertContent('<img src="" alt="" />');
	});
	
	//表单
   $("form").submit(function(e)
	{
		if($("#title").val()=="")
		{
			e.preventDefault();
			alert("标题不能为空");
			return;
		}
		if($("#content").val()=="")
		{
			e.preventDefault();
			alert("内容不能为空");
			return;
		}
		$("button").attr("disabled","disabled");
	});
	
	
	(function($)
	{
		$.fn.extend(
		{
			insertContent : function(myValue, t) 
			{
				var $t = $(this)[0];
				if (document.selection) { // ie
					this.focus();
					var sel = document.selection.createRange();
					sel.text = myValue;
					this.focus();
					sel.moveStart('character', -l);
					var wee = sel.text.length;
					if (arguments.length == 2) {
						var l = $t.value.length;
						sel.moveEnd("character", wee + t);
						t <= 0 ? sel.moveStart("character", wee - 2 * t
								- myValue.length) : sel.moveStart(
								"character", wee - t - myValue.length);
						sel.select();
					}
				} else if ($t.selectionStart
						|| $t.selectionStart == '0') {
					var startPos = $t.selectionStart;
					var endPos = $t.selectionEnd;
					var scrollTop = $t.scrollTop;
					$t.value = $t.value.substring(0, startPos)
							+ myValue
							+ $t.value.substring(endPos,
									$t.value.length);
					this.focus();
					$t.selectionStart = startPos + myValue.length;
					$t.selectionEnd = startPos + myValue.length;
					$t.scrollTop = scrollTop;
					if (arguments.length == 2) {
						$t.setSelectionRange(startPos - t,
								$t.selectionEnd + t);
						this.focus();
					}
				} else {
					this.value += myValue;
					this.focus();
				}
			}
		})
	})(jQuery);
});
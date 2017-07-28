	
	function click_dong_y(){
		alert("Mặc > Dù > Em > Không > Đồng > Ý || Nhưng  Anh > Vẫn > Yêu > Em !!!");
	}

	function play(){
			       var audio = document.getElementById("audio");
			       audio.play();
			    
   			}
   	function play1(){

   			 var audio = document.getElementById("audio1");
			       audio.play();
   	}
   		function play2(){

   			 var audio = document.getElementById("audio2");
			       audio.play();
   	}
   	function play3(){

   			 var audio = document.getElementById("audio3");
			       audio.play();
		}
   	function mac_dinh(){

   			 var audio = document.getElementById("mac_dinh");
			       audio.play();
   	}
              function stop(){
              	var audio  = document.getElementById("audio");
              	var audio1 = document.getElementById("audio1");
              	var audio2 = document.getElementById("audio2");
			    var audio3 = document.getElementById("audio3");
			    var	mac_dinh = document.getElementById("mac_dinh");
			    mac_dinh.pause();
              	audio.pause();
              	audio1.pause();
              	audio2.pause();
              	audio3.pause();
              }
		function moveObj(obj){
		var w = 800, h = 600;


				newWidth = Math.floor(Math.random()*w);
				newHeight = Math.floor(Math.random()*h);
				obj.style.position="absolute";
				obj.style.left=newWidth+"px";
				obj.style.top=newHeight+"px";
		}
		function checkObj(event,obj){z
					var top = obj.style.top.split("px");
					var left = obj.style.left.split("px");
					if(top+5 > event.y || left+5 > event.x){moveObj(obj);}
		}
			window.setTimeout("checkObj(event,document.forms[0].elements[0]", 1);
			document.onkeydown = function(){return false;}
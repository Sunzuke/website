<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

echo "	<DIV
			ID='Heart'
			style='
				display: none;
				position: absolute;
				left: 0;
				top: 0;
				width: 0px;
				height: 0px;
			'
		></DIV>
		<script>
			HeartBeat();
			JSHeartBeat();
			function HeartBeat() {
				hiddenreload('Heart', 'heartbeat');
				setTimeout(function(){HeartBeat();}, 950);
			}
			function JSHeartBeat(UserID) {
				//1000/50 = 20 (50 FPS)
				//Suggestion: JavaScript only! (oww.. the server pain)
				
				setTimeout(function(){JSHeartBeat();}, 20);
			}
		</script>
";

?>
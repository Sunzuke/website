<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}

echo "	<DIV ID='loading'
				STYLE=\"
					display: none;
					z-index: 100;
					POSITION: fixed;
					TOP: 0;
					LEFT: 0;
					WIDTH: 100%;
					HEIGHT: 2;
					BACKGROUND-COLOR: #17176b;//863d3d
					border-bottom: 1px solid #1616d5;//702424
				\"
			>
				<TABLE ID='loaded'
					STYLE=\"
						WIDTH: 0%;
						HEIGHT: 100%;
						BACKGROUND-COLOR: #7bb3ff;//8d2626
						transition: all 0.25s ease-in-out;
						box-shadow-bottom:	0px 0px 2px 0px rgba(0, 255, 255, 1);
						-webkit-box-shadow: 0px 0px 2px 0px rgba(0, 255, 255, 1); 
						-moz-box-shadow: 	0px 0px 2px 0px rgba(0, 255, 255, 1); 
					\"
				>
					<TR>
						<TD>
							<DIV></DIV>
						</TD>
					</TR>
				</TABLE>
			</DIV>
";

?>
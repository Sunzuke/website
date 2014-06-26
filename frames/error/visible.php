<?php
if(!defined('Pascal Salesch')) {	exit;	} else {	$filelist[] = __FILE__;	}
//===============================================================================================
echo "<meta http-equiv='refresh' content='5; URL=".$base."'>";
echo "
	<TABLE WIDTH='100%' HEIGHT='100%'>
		<TR valign='top'>
			<TD align='center'
				style=\"
					padding-top: 50px;
					padding-left: 50px;
				\"
			>
				<TABLE WIDTH='100%'>
					<TR valign='top'>
						<TD align='left'>";
							if($s[2] == "403") {
								echo "
									<div style='font-size: 70pt;'>Error: 403</div>
									<BR>
									<b>
										You don't have the permissions to visit this content.<br>
										You will be redirected to the index in a few seconds.
									</b>
								";
							} else {
								echo "
									<div style='font-size: 70pt;'>Error: 404</div>
									<BR>
									<b>
										This URL does not have any content or is expired.<br>
										Please update your bookmarks or clear your cookies.<br>
										You will be redirected to the index in a few seconds.
									</b>
								";
							}
echo "						<br><br>Debug Filelist:
							<ul>";
								foreach($filelist as $phpfile) echo "$phpfile<br>";
echo "						</ul>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>";

?>
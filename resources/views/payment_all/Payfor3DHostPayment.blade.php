@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

<section>
		<?php
		// if (($_POST["3DStatus"] == "1")) {
		?>
			<h2><b>3D User Authentication Successful</b></h2>
		<?php
		// } else {
		?>
			<!-- <h2><b>3D User Authentication Failed</b></h2> -->
		<?php
		// }
		?>
		<?php
		// if (($_POST["ProcReturnCode"] == "00")) {
		?>
			<!-- <h2><b>Payment Successful</b></h2> -->
		<?php
		// } else {
		?>
			<!-- <h2><b>Payment Failed</b></h2> -->
		<?php
		// }
		?>
		<table class="tableClass">
			<tr>
				<td colspan="2">
					<h1>PayFor - Return Paramters</h1>
				</td>
			</tr>
			<tr>
				<td style="text-align: right"><b>Parameter Name</b></td>
				<td style="text-align: left"><b>Paramter Value</b></td>
			</tr>
			<?php
			// $odemeparametreleri = array("AuthCode", "Response", "HostRefNum", "ProcReturnCode", "TransId", "ErrorMessage");
			// foreach ($_POST as $key => $value) {
			// 	if ($key == "AuthCode" or $key == "Response" or $key == "HostRefNum" or $key == "ProcReturnCode" or $key == "TransId" or $key == "ErrorMessage")
			// 		echo "<tr><td style='text-align: right'>" . $key . "</td><td style='text-align: left'>" . $value . "</td></tr>";
			// 	else
			// 		echo "<tr><td style='text-align: right'>" . $key . "</td><td style='text-align: left'>" . $value . "</td></tr>";
			// }
			?>
		</table>
</section>

@endsection
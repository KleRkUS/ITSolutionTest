<div class="wrapper">
	<form action="" method="post">
		<label for="real__url">Input URL here</label>
		http://<input type="text" name="real__url" oninput='checkURL(this)' data-type="full" id="input_full">
		<span id="full"></span>
		<label for="offer">You can change shortened url if you want</label>
		http://link/su/<input type="text" name="offer"  oninput="checkURL(this)" data-type="short" id="input_short"><br>
		<span id="short"></span>
		<input type="button" onclick="saveURL()" value="Short it">
		<span id="res"></span>
	</form>
</div>
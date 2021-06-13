
<body>
<form method="post">
<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
    <div class="item-box">
	<label for="name">name</label>
	<input id="name" type="text" name="name" value="<?php if(!empty($_POST['name'])){
    echo $_POST['name'];}?>">
	</div>
	<div class="item-box">
	<label for="tel">tel</label>
	<input id="tel" type="tel" name="tel" value="<?php if(!empty($_POST['tel'])){
    echo $_POST['tel'];}?>">
	</div>
	<div class="item-box">
	<label for="mail">mail</label>
	<input id="mail" type="mail" name="mail" value="<?php if(!empty($_POST['mail'])){
    echo $_POST['mail'];}?>">
	</div>
	<div class="item-box">
	<label for="year">year</label>
	<input id="year" type="year" name="year" value="<?php if(!empty($_POST['year'])){
    echo $_POST['year'];}?>">
	</div>
	<div class="item-box">
        <input type="submit" name="change"  class="btn btn-success" value="更新">
</form>
<a class="btn_cancel" href="edit">キャンセル</a>


</body>
</html>
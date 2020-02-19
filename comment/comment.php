<?php
/*评论功能
*/
$disabled=' disabled="disabled"';
?>
<div class="card">
	<div class="card-body border-bottom">
		<form>
			<label class="text-muted">邮箱或网站*</label>
			<input type="email" class="form-control" name="email"<?php echo $disabled; ?>>
			<label class="text-muted">评论</label>
			<textarea class="form-control rounded-0" name="comment"<?php echo $disabled; ?>></textarea>
			<br/>
			<button type="submit" class="btn btn-dark"<?php echo $disabled; ?>>发表评论</button>
		</form>
	</div>
	<div class="card-body">
	<p></p>
	</div>
</div>
<br/><br/><br/>
<h3>sample shortcode example</h3>
<p>{{$sample}}</p>


<form action="{{ admin_url('admin-ajax.php') }}" method="post" data-form="ajax" data-cb="ajax_cb">
	<div><input type="text" name="fname"></div>
	<div><input type="text" name="lname"></div>
	<input type="hidden" name="action" value="sample_action">
	{{ submit_button() }}
</form>
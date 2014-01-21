<h2>Create a person</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('person/create') ?>

	<label for="pname">Person Name</label>
	<input type="input" name="pname" /><br/><br/>
	<input type="submit" name="submit" value="Submit" />

</form>
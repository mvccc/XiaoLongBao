<h2>Persons</h2>

<table border="1">
<?php
foreach ($persons as $person)
{
  echo "<tr><td>{$person['PId']}</td><td>{$person['PName']}</td></tr>";
}
?>
</table>
<br/>
<a href="<?php echo site_url(); ?>/person/create"><button>Create a person</button></a>

<?php
/*
Template Name: Import Json
*/
?>

<?php
$json = file_get_contents('http://steverudolfi.com/json');
$obj = json_decode($json);

foreach($obj as $mer){
	foreach($mer as $key=>$flarm){
		$type = $flarm->type;
		$remote = 0;
		if( $type == "Conference (remote)" ){
			$type = "Conference";
			$remote = 1;
		}
		$post_data = array(
			'post_title'	=> $flarm->title,
			'post_status'	=> 'publish',
			'post_type'		=> 'event',
			'post_date'		=> $flarm->start . ' 12:00:00'
		);  

		$field_data = array(
			'start'			=> $flarm->start,
			'end'			=> $flarm->end,
			'type'			=> $type,
			'remote'		=> $remote,
			'affiliation'	=> $flarm->affil,
			'link'			=> $flarm->link,
			'blog_link'		=> $flarm->blog
		);
		CFS()->save($field_data, $post_data);
	
	}
}

echo( '<pre>' );
	var_dump( $obj );
echo( '</pre>' );

?>
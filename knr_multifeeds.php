<?php
/*
Plugin Name: KNR Multi-Feed
Description: A plugin for displaying feeds from multiple sources
Version: 0.1
Author: Nitin Reddy Katkam
*/

include(dirname(__FILE__).'/'.'nitin_feedreader.php');

class KnrMultiFeeds extends WP_Widget {
	public function KnrMultiFeeds() {
		parent::WP_Widget(false, 'KNR Multi-Feed');
	}
	
	public function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		
		$title = apply_filters('widget_title', $instance['title']);
		if ($title) $title = (trim($title) == '') ? null : $title;
		if ($title) echo $before_title.$title.$after_title;
		
		$urllines = $instance['urllines'];
		$itemlimit = $instance['itemlimit'];
		
		if (isset($urllines) && strlen($urllines)>0) {
			$itemArray = array();
			
			foreach(split("\n", $urllines) as $iterUrl) {
				$iterFr = new FeedReader(trim($iterUrl));
				$iterFr->fetchItems();
				$itemArray = array_merge($itemArray,
					//array_slice(
						$iterFr->getItems()
					//,0,$itemlimit)
				);
			}
			
			shuffle($itemArray);
			$itemArray = array_slice($itemArray, 0, $itemlimit);
			FeedReader::renderAsList($itemArray);
		}
		
		/*
		$fr = new FeedReader();
		$fr->fetchItems();
		$fr->shuffleItems();
		$fr->truncateItemArray(5);
		$fr->renderItems();
		*/
		
		echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['urllines'] = strip_tags($new_instance['urllines']);
		$instance['itemlimit'] = strip_tags($new_instance['itemlimit']);
		
		return $instance;
	}
		
	public function form($instance) {
		$title = esc_attr($instance['title']);		
		$title_fieldId = $this->get_field_id('title');
		$title_fieldName = $this->get_field_name('title');

		$urllines = esc_attr($instance['urllines']);
		$urllines_fieldId = $this->get_field_id('urllines');
		$urllines_fieldName = $this->get_field_name('urllines');

		$itemlimit = esc_attr($instance['itemlimit']);
		$itemlimit_fieldId = $this->get_field_id('itemlimit');
		$itemlimit_fieldName = $this->get_field_name('itemlimit');

		
		echo "
<p>
	<label>Title</label>
	<input type=\"text\" name=\"${title_fieldName}\" id=\"${title_fieldId}\" value=\"${title}\" />
</p>
<p>
	<label>URLs (1 per line)</label>
	<textarea name=\"${urllines_fieldName}\" id=\"${urllines_fieldId}\">${urllines}</textarea>
</p>
<p>
	<label>No. of Items To Display</label>
	<input type=\"text\" name=\"${itemlimit_fieldName}\" id=\"${itemlimit_fieldId}\" value=\"${itemlimit}\" />
</p>
";
	}
}

add_action('widgets_init', create_function('', 'return register_widget(\'KnrMultiFeeds\');'));

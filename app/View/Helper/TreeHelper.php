<?php

/*

This code is from:
http://bakery.cakephp.org/articles/MrRio/2006/09/24/threaded-lists

<!-- This will give you a <select> with <option> values displayed in a hierarchical manner -->
<h3>Drop down hierarchical select menu</h3>
<?php echo $html->selectTag('Section/parent_id', $tree->show('Section/name', $data, 'options'));?>

<!-- This will give you a basic list as per the original tutorial -->
<h3>Basic hierarchical list</h3>
<?php echo $tree->show('Section/name', $data); ?>

<!-- This will give you a list of sections and edit/delete links next to
section name as per tutorial comment  posted Mon, Apr 2nd 2007, 15:49 by sam -->
<h3>Basic hierarchical list with admin links</h3>
<?php echo $tree->show('Section/name', $data, 'admin'); ?>

<!-- This will turn the section name into a link
as per tutorial comment  posted Mon, Apr 2nd 2007, 15:49 by sam -->
<h3>Basic hierarchical list with name as link</h3>
<?php echo $tree->show('Section/name', $data, 'link'); ?>
*/

class TreeHelper extends AppHelper {
	var $tab = "	";
	var $helpers = array('Html');

	// Main Function
	function show($name, $data, $style='') {
		list($modelName, $fieldName) = explode('/', $name);
		if ($style=='options') {
			$output = $this->selecttag_options_array($data, $modelName, $fieldName, $style, 0);
		} else {
			//$style='';
			$output = $this->list_element($data, $modelName, $fieldName, $style, 0);
		}
		return $this->output($output);
	}

	// This creates a list with optional links attached to it
	function list_element($data, $modelName, $fieldName, $style, $level) {
		$tabs = "\n" . str_repeat($this->tab, $level * 2);
		$li_tabs = $tabs . $this->tab;

		if ($level == 0) {
			$output = $tabs. '<ul class="tree">';
		} else {
			$output = $tabs. '<ul>';
		}
		foreach ($data as $key=>$val) {
			$output .= $li_tabs . "<li>".$this->style_print_item($val[$modelName], $modelName, $style);
			if(isset($val['children'][0]))
			{
				$output .= $this->list_element($val['children'], $modelName, $fieldName, $style, $level+1);
				$output .= $li_tabs . "</li>";
			}
			else
			{
				$output .= "</li>";
			}
		}
		$output .= $tabs . "</ul>";
		return $output;
	}

	// this handles the formatting of the links if there necessary
	function style_print_item($item, $modelName, $style='') {
		switch ($style) {
			case "link":
				$output = $this->Html->link($item['name'], array('controller' => strtolower(Inflector::pluralize($modelName)), 'action' => 'view', $item['id']))." ({$item['item_count']})";
			break;

			case "admin":
				$output = $item['name'];
				$output .= $this->Html->link(" edit", "edit/".$item['id']);
				$output .= " ";
				$output .= $this->Html->link(" del", "delete/".$item['id']);
			break;

			default:
				$output = $item['name'];
		}
	return $output;
	}

	// recursively reduces deep arrays to single-dimensional arrays
	// $preserve_keys: (0=>never, 1=>strings, 2=>always)
	// Source: http://php.net/manual/en/function.array-values.php#77671
	function array_flatten($array, $preserve_keys = 1, &$newArray = Array()) {
		foreach ($array as $key => $child) {
			if (is_array($child)) {
				$newArray =& $this->array_flatten($child, $preserve_keys, $newArray);
			}
			elseif ($preserve_keys + is_string($key) > 1) {
				$newArray[$key] = $child;
			} else {
				$newArray[] = $child;
			}
		}
		return $newArray;
	}

	// for formatting selecttag options into an associative array (id, name)
	function selecttag_options_array($data, $modelName, $fieldName, $style, $level) {
		// html code does not work here
		// tried using " " and it didn't work
		$tabs = "-";

		foreach ($data as $key=>$val) {
			$output[] = array($val[$modelName]['id'] => str_repeat($tabs, $level*2) . ' ' . $val[$modelName]['name']);

			if(isset($val['children'][0])) {
				$output[] = $this->selecttag_options_array($val['children'], $modelName, $fieldName, $style, $level+1);
			}
		}

		$output = $this->array_flatten($output, 2);
		return $output;
	}
}
?>

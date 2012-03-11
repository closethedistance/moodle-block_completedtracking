<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
 
/**
 * Reports activities and resources that have been completed by user
 *
 * @package   block_completedtracking
 * @copyright 2012
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_completedtracking extends block_base {
	public function init() {
		$this->title = get_string('completedtracking', 'block_completedtracking');
	}

	public function get_content() {
		global $COURSE, $DB, $USER;
		
		if ($this->content !== null) {
			return $this->content;
		}		

		$this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

		// Query section names and how many activites or resources have been marked complete for each section
		$conditions = array('course'=>$COURSE->id,'visible'=>1);
		if ($records = $DB->get_records('course_sections', $conditions, null, $fields='*')) {
			$total = 0;
			$credits = 0;
			$report = '<div style="margin-bottom: 8px;">You have marked the following resources as complete:</div><ul style="list-style: none; margin: 0;">';
			foreach ($records as $record) {
				$completed = $DB->count_records_sql('SELECT COUNT(c.id) FROM {course_modules_completion} AS c INNER JOIN {course_modules} AS m ON c.coursemoduleid = m.id WHERE m.section = ? AND c.userid = ? AND c.completionstate = ?', array($record->id, $USER->id, 1));
				if ($completed > 0 and $record->name !== NULL) {
					// $activities = $DB->count_records('course_modules', array('course'=>$COURSE->id, 'section'=>$record->id, 'visible'=>'1', 'completion'=>'1'));
					if ($record->name == 'Articles') {
						$credits = $completed * 0.25;
					} else if ($record->name == 'Books') {
						$credits = $completed * 2;
					} else {
						$credits = $completed;
					}
					$total = $total + $credits;
					$report .= '<li>' . $completed . ' ' . $record->name . ' (' . $credits . ' credits)</li>';
				}
			}
			if ($total > 0) {
				$report .= '</ul><div style="border-top: 1px solid #000000;">Total Credits: ' . $total . '</div>';
				
			} else if ($total == 0 and $DB->count_records('course_modules', array('course'=>$COURSE->id, 'visible'=>'1', 'completion'=>'1')) > 0) {
				$report = '<div>You have not yet marked any resources as complete.</div>';
			} else {
				$report = '';
			}
		}
	
			
		// Add custom text before and after the list of completed activities
		if (!empty($this->config->text)) {
			$this->content->text = $this->config->text . $report;
		} else {
			$this->content->text = $report;
		}
		if (!empty($this->config->footer)) {
			$this->content->footer = $this->config->footer;
		}	
		
		return $this->content;
	}
	
	public function html_attributes() {
		$attributes = parent::html_attributes();
		$attributes['class'] .= ' block_' . $this->name();
		return $attributes;
	}
	
	public function applicable_formats() {
		return array(
			'course-view' => true,
			'course-view-social' => false);
	}
	
	public function specialization() {
		if (!empty($this->config->title)) {
			$this->title = $this->config->title;
		} else {
			$this->config->title = $this->title;
		}
		if (empty($this->config->text)) {
			$this->config->text = '';
		}    
		if (empty($this->config->footer)) {
			$this->config->footer = '';
		}    
	}
	
	public function instance_config_save($data) {
		if(get_config('completedtracking', 'Allow_HTML') == '1') {
			$data->text = strip_tags($data->text);
		}
		return parent;;instance_config_save($data);
	}	
	
}
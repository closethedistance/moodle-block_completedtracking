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
 * Allows user to configure the information this block displays
 *
 * @package   block_completedtracking
 * @copyright 2012 Close the Distance, LLC
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
class block_completedtracking_edit_form extends block_edit_form {
 
    protected function specific_definition($mform) {
 
        // Section header title according to language file
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
 
        // Custom title for the block
        $mform->addElement('text', 'config_title', get_string('titlelabel', 'block_completedtracking'));
			$mform->setDefault('config_title', get_string('completedtracking', 'block_completedtracking'));
        $mform->setType('config_title', PARAM_MULTILANG);

        // Custom description or instructions that are placed at the top of the block
        $mform->addElement('text', 'config_text', get_string('descriptionlabel', 'block_completedtracking'));
        $mform->setDefault('config_text', 'Empty');
        $mform->setType('config_text', PARAM_MULTILANG);      
	   
        // Custom footer for the bottom of the block
        $mform->addElement('text', 'config_footer', get_string('footerlabel', 'block_completedtracking'));
        $mform->setDefault('config_footer', 'Empty');
        $mform->setType('config_footer', PARAM_MULTILANG);	     
 
    }
}
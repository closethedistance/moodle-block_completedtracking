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
 * Global configuration of 'completedtracking' block
 *
 * @package   block_completedtracking
 * @copyright 2012
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
 $settings->add(new admin_setting_heading(
            'completedtracking/headerconfig',
            get_string('configlabel', 'block_completedtracking'),
            get_string('configdescription', 'block_completedtracking')
        ));
 
$settings->add(new admin_setting_configcheckbox(
            'completedtracking/Allow_HTML',
            get_string('allowhtmllabel', 'block_completedtracking'),
            get_string('allowhtmldescription', 'block_completedtracking'),
            '0'
        ));
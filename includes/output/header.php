<?php
/*
connectedwebproject/wordpress
Copyright (C) 2018  Fabio Endrizzi (jcte02)

This file is part of connectedwebproject/wordpress.

connectedwebproject/wordpress is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

connectedwebproject/wordpress is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with connectedwebproject/wordpress.  If not, see <http://www.gnu.org/licenses/>.
*/

defined('ABSPATH') or die();

header('Cache-Control: public, must-revalidate');
header('Last-Modified: ' . get_lastpostmodified('gmt') . ' GMT');

require_once('encode.php');

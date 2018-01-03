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

include('includes/output/header.php');

require_once('includes/blog.php');
require_once('includes/post.php');
require_once('includes/connectedweb/connectedweb.php');

$feed = new Feed(get_blog_feed());
$contents = [];

while (have_posts()) {
    the_post();
    $contents[] = get_content(get_the_ID());
}

$feed->contents = $contents;
$json = encode($feed);

include('includes/output/json_output.php');

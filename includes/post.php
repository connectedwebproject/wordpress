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

require_once('attachment.php');
require_once('connectedweb/connectedweb.php');
require_once('connectedweb/DomWalker.php');
function get_content($id)
{
    $post = get_post($id);
    $dom = new DOMWalker();

    return new Content([
        'author' => get_author($post->author),
        'url' => get_permalink($id),
        'title' => $post->post_title,
        'description' => $post->post_excerpt,
        'body' => $dom->parse(get_the_content_feed()),
        'pubDate' => intval(get_the_date('U', $id)),
        'img' => get_thumbnail($id),
    ]);
}

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

require_once('connectedweb/connectedweb.php');

function id_from_url($url)
{
    return attachment_url_to_postid($url) ? : url_to_postid($url);
}

function get_author($id = false)
{
    return new Author([
        'name' => get_the_author_meta('display_name', $id),
        'type' => get_the_author_meta('user_type', $id),
        'url' => get_the_author_meta('url', $id),
        'age' => intval(get_the_author_meta('user_age', $id)),
        'gender' => get_the_author_meta('user_gender', $id)
    ]);
}

function get_attachment($id, $callback = false, $not = array())
{
    $post = get_post($id);
    $lastmodified = $post->post_modified_gmt;

    $data = array(
        // 'author' => get_author($post->post_author),
        'url' => wp_get_attachment_url($post->ID),
        'title' => $post->post_title,
        'caption' => $post->post_excerpt,
        'description' => $post->post_content,
        'type' => $post->post_mime_type
    );

    foreach ($not as $key) {
        unset($data[$key]);
    }

    if (is_callable($callback)) {
        $callback($data, wp_get_attachment_metadata($id), get_attached_file($id));
    }

    return $data;
}

function get_image_object($id)
{
    return get_attachment($id, function (&$data, $metadata, $dir) {
        $data['size'] = filesize($dir);
        $data['width'] = $metadata['width'];
        $data['height'] = $metadata['height'];

        $data['resolutions'] = array();

        $basedir = dirname($dir);
        $baseurl = dirname($data['url']);

        foreach ($metadata['sizes'] as $name => $resolution) {
            $data['resolutions'][$resolution['width']] = array(
                'width' => $resolution['width'],
                'height' => $resolution['height'],
                'type' => $resolution['mime-type'],
                'url' => $baseurl . '/' . $resolution['file'],
                'size' => filesize($basedir . '/' . $resolution['file'])
            );
        }
    }, ['title', 'description']);
}

function get_thumbnail($id)
{
    if (has_post_thumbnail($id)) {
        return new ImageObject(get_image_object($id));
    }

    return null;
}

<?php
/*
	Plugin Name: PictoBrowser
	Plugin URI: http://blog.endlich-wochenen.de/?p=343
	Description: Display slideshows from Picasa and Flickr in Wordpress using PictoBrowser
	Author: Mathias Krueger
	Version: 0.3.1
	Author URI: http://blog.endlich-wochenen.de/

	Copyright (c) 2009, Mathias Krueger

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
	
	@session_start();

	if (!class_exists("PictoBrowser")) {
		class PictoBrowser {
			var $PLUGIN_URL;
		
			//constructor
			function PictoBrowser() {
				$this->type        = "flickr";
				$this->width       = get_option("PICTOBROWSER_WIDTH");
				$this->height      = get_option("PICTOBROWSER_HEIGHT");
				$this->bgcolor     = get_option("PICTOBROWSER_BACKGROUND");
				$this->uid_flickr  = get_option("PICTOBROWSER_FLICKR_USER");
				$this->uid_picasa  = get_option("PICTOBROWSER_PICASA_USER");
				$this->titles      = get_option("PICTOBROWSER_SHOW_TITLES");
				$this->notes       = get_option("PICTOBROWSER_SHOW_NOTES");
				$this->autohide    = get_option("PICTOBROWSER_AUTOHIDE");
				$this->size        = get_option("PICTOBROWSER_IMAGESIZE");
				$this->align       = get_option("PICTOBROWSER_VALIGN");
				$this->zoom        = get_option("PICTOBROWSER_SHOW_ZOOM");
				$this->scale       = get_option("PICTOBROWSER_INIT_SCALE");
				$this->transparent = get_option("PICTOBROWSER_TRANSPARENCY");
				
				$this->PLUGIN_URL  = WP_PLUGIN_URL."/pictobrowser-gallery";
			}
		
			function pictobrowser_shortcode($atts, $content = null ) {
				$flashsrc = "";
				$flashvar = "";
                extract( shortcode_atts( array(
                    "type"    => $this->type,
                    "userid"  => "",
                    "albumid" => ""), $atts ) );
                
                if (empty($userid))
                {
                    $userid = ($type == "flickr") ? $this->uid_flickr : $this->uid_picasa;
                }
                
                if (empty($userid) || empty($albumid))
                {
                    // error
                    return "<p>Error in PictoBrowser variables</p>";
                }
                
				if ($type == "flickr")
				{
					$flashsrc = "http://www.db798.com/pictobrowser.swf";
					$flashvar = "ids=". $albumid ."&userId=". $userid ."&source=sets";
				}
				else if ($type == "picasa")
				{
					$flashsrc = "http://www.db798.com/pictobrowserp.swf";
					$flashvar = "albumId=". $albumid ."&userName=". $userid ."&source=album";
				}
				else
				{
                    // error
                    return "<p>Error in PictoBrowser variables</p>";
				}
				$flashvar .= "&titles=". $this->titles ."&displayNotes=". $this->notes ."&thumbAutoHide=". $this->autohide ."&imageSize=". $this->size ."&vAlign=". $this->align ."&displayZoom=". $this->zoom ."&initialScale=". $this->scale ."&bgAlpha=". $this->transparent ."&vertOffset=0";
				
				$content  = "<p style=\"text-align: center;\">\n";
				$content .= "<object width=\"". $this->width ."\" height=\"". $this->height ."\" align=\"middle\">\n";
				$content .= "<param name=\"FlashVars\" VALUE=\"". $flashvar ."\" />\n";
				$content .= "<param name=\"PictoBrowser\" value=\"". $flashsrc ."\" />\n";
				$content .= "<param name=\"scale\" value=\"noscale\">\n";
				$content .= "<param name=\"bgcolor\" value=\"". $this->bgcolor ."\"></param>\n";
				$content .= "<embed src=\"". $flashsrc ."\" FlashVars=\"". $flashvar ."\" loop=\"false\" scale=\"noscale\" bgcolor=\"". $this->bgcolor ."\" width=\"". $this->width ."\" height=\"". $this->height ."\" name=\"PictoBrowser\" align=\"middle\"></embed>\n";
				$content .= "</object>\n";
				$content .= "</p>\n";
				
				return $content;
			}
			
			/* Utility Functions */
		
			function setDefaults() {
				add_option("PICTOBROWSER_WIDTH", "500");
				add_option("PICTOBROWSER_HEIGHT", "500");
				add_option("PICTOBROWSER_BACKGROUND", "#ffffff");
				add_option("PICTOBROWSER_FLICKR_USER", "");
				add_option("PICTOBROWSER_PICASA_USER", "");
				add_option("PICTOBROWSER_SHOW_TITLES", "on");
				add_option("PICTOBROWSER_SHOW_NOTES", "on");
				add_option("PICTOBROWSER_AUTOHIDE", "on");
				add_option("PICTOBROWSER_IMAGESIZE", "medium");
				add_option("PICTOBROWSER_VALIGN", "mid");
				add_option("PICTOBROWSER_SHOW_ZOOM", "off");
				add_option("PICTOBROWSER_INIT_SCALE", "off");
				add_option("PICTOBROWSER_TRANSPARENCY", "50");
			}

			/* Wordpress Settings */
		
			function addOptions() {
				$this->setDefaults();
			}

			function removeOptions() {
				delete_option("PICTOBROWSER_WIDTH");
				delete_option("PICTOBROWSER_HEIGHT");
				delete_option("PICTOBROWSER_BACKGROUND");
				delete_option("PICTOBROWSER_FLICKR_USER");
				delete_option("PICTOBROWSER_PICASA_USER");
				delete_option("PICTOBROWSER_SHOW_TITLES");
				delete_option("PICTOBROWSER_SHOW_NOTES");
				delete_option("PICTOBROWSER_AUTOHIDE");
				delete_option("PICTOBROWSER_IMAGESIZE");
				delete_option("PICTOBROWSER_VALIGN");
				delete_option("PICTOBROWSER_SHOW_ZOOM");
				delete_option("PICTOBROWSER_INIT_SCALE");
				delete_option("PICTOBROWSER_TRANSPARENCY");
			}
		
			function addOptionsPage() {
				add_options_page(
					"PictoBrowser Configuration",
					"PictoBrowser",
					9,
					"pictobrowser-gallery/options-page.php"
				);	
			}
		
			function updateOptions($post) {
				if (is_array($post)) {
					update_option("PICTOBROWSER_WIDTH",        $post["pictoBrowserWidth"]);
					update_option("PICTOBROWSER_HEIGHT",       $post["pictoBrowserHeight"]);
					update_option("PICTOBROWSER_BACKGROUND",   $post["pictoBrowserBackground"]);
					update_option("PICTOBROWSER_FLICKR_USER",  $post["pictoBrowserFlickrUser"]);
					update_option("PICTOBROWSER_PICASA_USER",  $post["pictoBrowserPicasaUser"]);
					update_option("PICTOBROWSER_SHOW_TITLES",  $post["pictoBrowserShowTitles"]);
					update_option("PICTOBROWSER_SHOW_NOTES",   $post["pictoBrowserShowNotes"]);
					update_option("PICTOBROWSER_AUTOHIDE",     $post["pictoBrowserAutohide"]);
					update_option("PICTOBROWSER_IMAGESIZE",    $post["pictoBrowserImagesize"]);
					update_option("PICTOBROWSER_VALIGN",       $post["pictoBrowserVAlign"]);
					update_option("PICTOBROWSER_SHOW_ZOOM",    $post["pictoBrowserShowZoom"]);
					update_option("PICTOBROWSER_INIT_SCALE",   $post["pictoBrowserInitScale"]);
					update_option("PICTOBROWSER_TRANSPARENCY", $post["pictoBrowserTransparency"]);
				}
			}
		
			function addTinyMCEButton() {
				if ( get_user_option("rich_editing") == "true") {
					add_filter("mce_external_plugins", array(&$this, "addTinyMCEPlugin"));
					add_filter("mce_buttons", array(&$this, "registerTinyMCEButton"));
				} 
			}

			function registerTinyMCEButton($buttons) {
			   array_push($buttons, "separator", "pictoBrowser");

			   return $buttons;
			}

			function addTinyMCEPlugin($plugin_array) {
			   $plugin_array["pictoBrowser"] = $this->PLUGIN_URL."/tinymce3/editor_plugin.js";

			   return $plugin_array;
			}

		}
	}

	$pictoBrowser = new PictoBrowser();

	// add plugin actions
    add_shortcode("pictobrowser", array(&$pictoBrowser, "pictobrowser_shortcode"));
	
	// register option hooks
	register_activation_hook(__FILE__,   array(&$pictoBrowser, "addOptions"));
	register_deactivation_hook(__FILE__, array(&$pictoBrowser, "removeOptions"));

	// add options page
	add_action("admin_menu", array(&$pictoBrowser, "addOptionsPage"));

	// add tinymce buttons
	add_action("init", array(&$pictoBrowser, "addTinyMCEButton"));
?>

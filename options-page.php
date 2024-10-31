<?php
/**
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
	$location = $_SERVER["PHP_SELF"]."?page=".$_GET['page']; // Form Action URI

	/* Check form submission and update options */
	if ('process' == $_POST['stage']) {
		include_once('pictobrowser.php');
		
		$pictoBrowser = new PictoBrowser();
		$pictoBrowser->updateOptions($_POST);
	}

	/* Get options for form fields */
	$pictoBrowserWidth        = stripslashes(get_option("PICTOBROWSER_WIDTH"));
	$pictoBrowserHeight	      = stripslashes(get_option("PICTOBROWSER_HEIGHT"));
	$pictoBrowserBackground   = stripslashes(get_option("PICTOBROWSER_BACKGROUND"));
	$pictoBrowserFlickrUser   = stripslashes(get_option("PICTOBROWSER_FLICKR_USER"));
	$pictoBrowserPicasaUser   = stripslashes(get_option("PICTOBROWSER_PICASA_USER"));
	$pictoBrowserShowTitles   = stripslashes(get_option("PICTOBROWSER_SHOW_TITLES"));
	$pictoBrowserShowNotes    = stripslashes(get_option("PICTOBROWSER_SHOW_NOTES"));
	$pictoBrowserAutohide     = stripslashes(get_option("PICTOBROWSER_AUTOHIDE"));
	$pictoBrowserImagesize    = stripslashes(get_option("PICTOBROWSER_IMAGESIZE"));
	$pictoBrowserVAlign    	  = stripslashes(get_option("PICTOBROWSER_VALIGN"));
	$pictoBrowserShowZoom     = stripslashes(get_option("PICTOBROWSER_SHOW_ZOOM"));
	$pictoBrowserInitScale    = stripslashes(get_option("PICTOBROWSER_INIT_SCALE"));
	$pictoBrowserTransparency = stripslashes(get_option("PICTOBROWSER_TRANSPARENCY"));				
?>

<div class="wrap"> 
  <h2>PictoBrowser Options:</h2> 
  <form name="pictobrowser-form" method="post" action="<?php echo $location ?>&amp;updated=true">
  	<input type="hidden" name="stage" value="process" />

    <table width="100%" cellpadding="5" class="form-table"> 
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserFlickrUser">Default Flickr ID:</label></th>
        <td>
          <input name="pictoBrowserFlickrUser" type="text" class="small-text" style="width: 100px" id="pictoBrowserFlickrUser" value="<?php echo $pictoBrowserFlickrUser ?>"/>
          <span class="setting-description">Default setting which Flickr User ID is used by PictoBrowser if none is specified</span>
  	    </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pictoBrowserPicasaUser">Default Picasa ID:</label></th>
        <td>
          <input name="pictoBrowserPicasaUser" type="text" class="small-text" style="width: 100px" id="pictoBrowserPicasaUser" value="<?php echo $pictoBrowserPicasaUser ?>"/>
          <span class="setting-description">Default setting which Picasa User ID is used by PictoBrowser if none is specified</span>
  	    </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserWidth">Width (px):</label></th>
        <td>
          <input name="pictoBrowserWidth" type="text" class="small-text" id="pictoBrowserWidth" value="<?php echo $pictoBrowserWidth ?>"/>
  	    </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pictoBrowserHeight">Height (px):</label></th>
        <td>
          <input name="pictoBrowserHeight" type="text" class="small-text" id="pictoBrowserHeight" value="<?php echo $pictoBrowserHeight ?>"/>
  	    </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pictoBrowserBackground">Background color:</label></th>
        <td>
          <input name="pictoBrowserBackground" type="text" class="small-text" id="pictoBrowserBackground" value="<?php echo $pictoBrowserBackground ?>"/>
  	    </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pictoBrowserTransparency">Background tranparency:</label></th>
        <td>
          <input name="pictoBrowserTransparency" type="text" class="small-text" id="pictoBrowserTransparency" value="<?php echo $pictoBrowserTransparency ?>"/>
  	    </td>
      </tr>
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserShowTitles">Show Image Titles:</label></th>
        <td>
		  <select name="pictoBrowserShowTitles" id="pictoBrowserTransparency" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserShowTitles == "on") echo "selected"; ?> value="on">on</option>
			<option <?php if ($pictoBrowserShowTitles == "off") echo "selected"; ?> value="off">off</option>
		  </select>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserShowNotes">Show Image Notes:</label></th>
        <td>
		  <select name="pictoBrowserShowNotes" id="pictoBrowserShowNotes" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserShowNotes == "on") echo "selected"; ?> value="on">on</option>
			<option <?php if ($pictoBrowserShowNotes == "off") echo "selected"; ?> value="off">off</option>
			<option <?php if ($pictoBrowserShowNotes == "always") echo "selected"; ?> value="always">always</option>
		  </select>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserShowZoom">Show Zoom:</label></th>
        <td>
		  <select name="pictoBrowserShowZoom" id="pictoBrowserShowZoom" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserShowZoom == "on") echo "selected"; ?> value="on">on</option>
			<option <?php if ($pictoBrowserShowZoom == "off") echo "selected"; ?> value="off">off</option>
		  </select>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserAutohide">Autohide Thumbnails:</label></th>
        <td>
		  <select name="pictoBrowserAutohide" id="pictoBrowserAutohide" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserAutohide == "on") echo "selected"; ?> value="on">on</option>
			<option <?php if ($pictoBrowserAutohide == "off") echo "selected"; ?> value="off">off</option>
		  </select>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserInitScale">Initial Scale:</label></th>
        <td>
		  <select name="pictoBrowserInitScale" id="pictoBrowserInitScale" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserInitScale == "on") echo "selected"; ?> value="on">on</option>
			<option <?php if ($pictoBrowserInitScale == "off") echo "selected"; ?> value="off">off</option>
		  </select>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserImagesize">Image size:</label></th>
        <td>
		  <select name="pictoBrowserImagesize" id="pictoBrowserImagesize" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserImagesize == "medium") echo "selected"; ?> value="medium">medium</option>
			<option <?php if ($pictoBrowserImagesize == "large") echo "selected"; ?> value="large">large</option>
		  </select>
          <span class="setting-description">Large Images in Flickr are only available if user is pro user</span>
  	    </td>
      </tr>	  
	  
      <tr valign="top">
        <th scope="row"><label for="pictoBrowserVAlign">Vertical Align:</label></th>
        <td>
		  <select name="pictoBrowserVAlign" id="pictoBrowserVAlign" size="1" style="width: 100px" >
			<option <?php if ($pictoBrowserVAlign == "top") echo "selected"; ?> value="top">top</option>
			<option <?php if ($pictoBrowserVAlign == "mid") echo "selected"; ?> value="mid">mid</option>
			<option <?php if ($pictoBrowserVAlign == "center") echo "selected"; ?> value="center">center</option>
			<option <?php if ($pictoBrowserVAlign == "bottom") echo "selected"; ?> value="bottom">bottom</option>
		  </select>
  	    </td>
      </tr>	 	  

    </table>
    
    <p class="submit">
      <input type="submit" class="button-primary" name="Submit" value="Save Options &raquo;" />
    </p>
  </form> 
</div>
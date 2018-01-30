<?php
defined('_VIDMIZER_') or die();

class TriggeredSetting {
    private static $edit_page = false;
    private static $page_id = 0;
    public static function page_type() {
        if(isset($_REQUEST['page_id']) && $_REQUEST['page_id'] != '') {
            self::$edit_page = true;
            self::$page_id = $_REQUEST['page_id'];
        }
    }
    public static function start_setting_form() {
        $page_title = 'Add Triggered Campaign';
        if(self::$edit_page)
            $page_title = 'Edit Campaign';
        $save_path = plugins_url("inc/SaveSetting.php", dirname(__FILE__));
        $s_form = <<< FRM
            <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <br/><br/>
                        <h2>$page_title</h2>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-12 tabssss" >
                        <ul>
                          <li onclick="viewTab(1)">General Setting</li>
                          <li onclick="viewTab(2)">Content Setting</li>
                          <li onclick="viewTab(3)">Timer Setting</li>
                          <li onclick="viewTab(4)">Button Setting</li>
                          <li class="slider"></li>
                        </ul>
                        
                    </div>
                </div>
            </div>

            <script>
                jQuery("ul li").click(function(e) {

                  // make sure we cannot click the slider
                  if (jQuery(this).hasClass('slider')) {
                    return;
                  }

                  /* Add the slider movement */

                  // what tab was pressed
                  var whatTab = jQuery(this).index();

                  // Work out how far the slider needs to go
                  var howFar = 220 * whatTab;

                  jQuery(".slider").css({
                    left: howFar + "px"
                  });

                  /* Add the ripple */

                  // Remove olds ones
                  jQuery(".ripple").remove();

                  // Setup
                  var posX = jQuery(this).offset().left,
                      posY = jQuery(this).offset().top,
                      buttonWidth = jQuery(this).width(),
                      buttonHeight = jQuery(this).height();

                  // Add the element
                  jQuery(this).prepend("<span class='ripple'></span>");

                  // Make it round!
                  if (buttonWidth >= buttonHeight) {
                    buttonHeight = buttonWidth;
                  } else {
                    buttonWidth = buttonHeight;
                  }

                  // Get the center of the element
                  var x = e.pageX - posX - buttonWidth / 2;
                  var y = e.pageY - posY - buttonHeight / 2;

                  // Add the ripples CSS and start the animation
                  jQuery(".ripple").css({
                    width: buttonWidth,
                    height: buttonHeight,
                    top: y + 'px',
                    left: x + 'px'
                  }).addClass("rippleEffect");
                });



                
            </script>

            <script>
                function viewTab(tab){

                    if(tab == 1){
                        jQuery("#tabbb1").show();
                        jQuery("#tabbb2").hide();
                        jQuery("#tabbb3").hide();
                        jQuery("#tabbb4").hide();
                      /* 
                        jQuery(".tabb1").css("background-color", "rgb(24, 172, 224)");
                        jQuery(".tabb2").css("background-color", "transparent");
                        jQuery(".tabb3").css("background-color", "transparent");
                        jQuery(".tabb4").css("background-color", "transparent");*/
                    } else if(tab == 2) {
                        jQuery("#tabbb1").hide();
                        jQuery("#tabbb2").show();
                        jQuery("#tabbb3").hide();
                        jQuery("#tabbb4").hide();

                        /*jQuery(".tabb1").css("background-color", "transparent");
                        jQuery(".tabb2").css("background-color", "rgb(24, 172, 224)");
                        jQuery(".tabb3").css("background-color", "transparent");
                        jQuery(".tabb4").css("background-color", "transparent");*/
                    } else if(tab == 3) {
                        jQuery("#tabbb1").hide();
                        jQuery("#tabbb2").hide();
                        jQuery("#tabbb3").show();
                        jQuery("#tabbb4").hide();

                        /*jQuery(".tabb1").css("background-color", "transparent");
                        jQuery(".tabb2").css("background-color", "transparent");
                        jQuery(".tabb3").css("background-color", "rgb(24, 172, 224)");
                        jQuery(".tabb4").css("background-color", "transparent");*/
                    } else if(tab == 4) {
                        jQuery("#tabbb1").hide();
                        jQuery("#tabbb2").hide();
                        jQuery("#tabbb3").hide();
                        jQuery("#tabbb4").show();

                        /*jQuery(".tabb1").css("background-color", "transparent");
                        jQuery(".tabb2").css("background-color", "transparent");
                        jQuery(".tabb3").css("background-color", "transparent");
                        jQuery(".tabb4").css("background-color", "rgb(24, 172, 224)");*/
                    } 

                }
            </script>
                    <form id="vidmizer_add_setting_form" onsubmit="event.preventDefault(); vidmizer_save_triggered_setting();" action="$save_path">
FRM;
        echo $s_form;
    }
    public static function end_setting_form() {
        $redirect = admin_url('admin.php?page=wp-vidmizer');
        $e_form = <<< FRM
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-md-12" style="text-align: center;">
                            <input type="hidden" name="setting_type" id="setting_type" value="trigger">
                            <input type="hidden" name="redirect" id="redirect" value="$redirect">
                            <input type="submit" class="button-3d" name="vidmizer_add_setting_button" id="vidmizer_add_setting_button" value="Save">
                        </div>
                    </div>
                </div>
                        </form>
FRM;
        echo $e_form;
    }
    public static function setting_title() {

        $section = <<< SEC
        <div  id="tabbb1" class="tabb1">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <h3>General Setting</h3><hr/>
                    </div>
                </div>
            </div>
SEC;
        echo $section;
        
    }
    public static function general_settings() {
        $setting_title = '';
        if(self::$edit_page)
            $setting_title = get_option('vidmizer_'.self::$page_id.'_setting_title');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setting_title">Campaign Name</label>
                            <input type="text" name="setting_title" id="setting_title" value="$setting_title" required>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
        //self::video_position();
        //self::video_width();
        //self::video_border();
        //self::video_close();
        self::text_alignment();
        self::select_page();
        self::video_length();
        echo '</div>';
    }
    public static function title_settings() {
        $section = <<< SEC
        <div id="tabbb2" class="tabb2" style="display: none;">
            <div class="container-fluid" >
                <div class="row-fluid">
                    <div class="col-md-6">
                        <h3>Content Setting</h3><hr/>
                    </div>
                </div>
            </div>
SEC;
        echo $section;
        //self::video_title();
        //self::video_title_background();
        //self::video_title_color();
        //self::video_title_font_family();
        //self::video_title_font_size();
        self::content_trigger_time();
        echo '</div>';
    }
    public static function timer_settings() {
        $section = <<< SEC
        <div id="tabbb3" class="tabb3" style="display: none;">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <h3>Timer Setting</h3><hr/>
                    </div>
                </div>
            </div>
SEC;
        echo $section;
        self::timer_style();
        self::timer_type();
//        self::timer_hour();
//        self::timer_minute();
//        self::timer_second();
        self::timer_color();
        self::timer_trigger_time();
        echo '</div>';
    }
    public static function button_settings() {
        $section = <<< SEC
        <div id="tabbb4" class="tabb4" style="display: none;">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <h3>Button Setting</h3><hr/>
                    </div>
                </div>
            </div>
SEC;
        echo $section;
        self::button_width();
        self::button_height();
        self::button_color();
        self::button_text();
        self::button_link();
        self::button_text_color();
        self::button_text_size();
        self::button_window();
        self::button_enable();
        self::button_trigger_time();
        echo '</div>';
    }
    public static function select_page() {
        $page_id = self::$page_id;
        $page_ids = get_option("vidmizer_pages");
        $page_ids = explode(",", $page_ids);
        $select = <<< SEL
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select_page">Select Page/Post</label>
                            <select name="select_page" id="select_page" style="width:250px;margin-right:15px;">
SEL;
        $pages = get_all_page_ids();
        $select .= '<option selected value="">Select Page</option>';
        $select .= '<optgroup label="Pages">';
        foreach($pages as $page) {
            if($page == $page_id)
                $select .= '<option value="'.$page.'" selected>'.get_the_title($page).'</option>';
            elseif(in_array($page, $page_ids))
                $select .= '<option value="'.$page.'" disabled>'.get_the_title($page).'</option>';
            else
                $select .= '<option value="'.$page.'">'.get_the_title($page).'</option>';
        }
        $select .= '</optgroup>';
        $select .= '</select>';
        $select .= '<b>or</b>';
        $select .= '<select name="select_post" id="select_post" style="width:250px;margin-left:15px;">';
        $select .= '<option selected value="">Select Post</option>';
        $posts = get_posts(array('fields' => 'ids', 'posts_per_page'  => -1));
        $select .= '<optgroup label="Posts">';
        foreach($posts as $post) {
            if($post == $page_id)
                $select .= '<option value="'.$post.'" selected>'.get_the_title($post).'</option>';
            elseif(in_array($post, $page_ids))
                $select .= '<option value="'.$post.'" disabled>'.get_the_title($post).'</option>';
            else
                $select .= '<option value="'.$post.'">'.get_the_title($post).'</option>';
        }
        $select .= '</optgroup>';
        $select .= '</select>';
        $select .= '<i href="#" style="margin-left:15px;font-size:21px;position: relative;top: 5px;cursor: pointer;" data-toggle="tooltip" class="glyphicon glyphicon-info-sign" title="Page/Post can not be same for Sticky Campaign & Triggered Campaign"></i>';
        $select .= <<< SEL
                        </div>
                    </div>
                </div>
            </div>
SEL;
        echo $select;
    }
    public static function video_position() {
        $video_position = 'top-left';
        if(self::$edit_page)
            $video_position = get_option('vidmizer_'.self::$page_id.'_video_position');
        if($video_position == 'top-left')
            $options = '<option value="top-left" selected>Top - Left</option>';
        else
            $options = '<option value="top-left">Top - Left</option>';
        if($video_position == 'top-right')
            $options .= '<option value="top-right" selected>Top - Right</option>';
        else
            $options .= '<option value="top-right">Top - Right</option>';
        if($video_position == 'bottom-left')
            $options .= '<option value="bottom-left" selected>Bottom - Left</option>';
        else
            $options .= '<option value="bottom-left">Bottom - Left</option>';
        if($video_position == 'bottom-right')
            $options .= '<option value="bottom-right" selected>Bottom - Right</option>';
        else
            $options .= '<option value="bottom-right">Bottom - Right</option>';

        $position = <<< POSITION
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_position">Sticky video position</label>
                            <select name="video_position" id="video_position" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
POSITION;
        echo $position;
    }
    public static function video_width() {
        $video_width = 360;
        if(self::$edit_page)
            $video_width = get_option('vidmizer_'.self::$page_id.'_video_width');
        $width = <<< WIDTH
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_width">Sticky video width</label>
                            <input type="number" name="video_width" id="video_width" value="$video_width" required> px
                        </div>
                    </div>
                </div>
            </div>
WIDTH;
        echo $width;
    }
    public static function video_border() {
        $video_border = '#000';
        if(self::$edit_page)
            $video_border = get_option('vidmizer_'.self::$page_id.'_video_border');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_border">Video border color</label>
                            <input type="text" class="spectrum_color_picker" name="video_border" id="video_border" value="$video_border" required>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function video_close() {
        $video_close = '#fff';
        if(self::$edit_page)
            $video_close = get_option('vidmizer_'.self::$page_id.'_video_close');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_close">Close button color</label>
                            <input type="text" class="spectrum_color_picker" name="video_close" id="video_close" value="$video_close" required>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function text_alignment() {
        $text_alignment = 'left';
        if(self::$edit_page)
            $text_alignment = get_option('vidmizer_'.self::$page_id.'_text_alignment');
        if($text_alignment == 'left')
            $options = '<option value="left" selected>Left</option>';
        else
            $options = '<option value="left">Left</option>';
        if($text_alignment == 'center')
            $options .= '<option value="center" selected>Center</option>';
        else
            $options .= '<option value="center">Center</option>';
        if($text_alignment == 'right')
            $options .= '<option value="right" selected>Right</option>';
        else
            $options .= '<option value="right">Right</option>';
        $align = <<< ENABLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text_alignment">Text align</label>
                            <select name="text_alignment" id="text_alignment" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
ENABLE;
        echo $align;
    }
    public static function video_length() {
        $video_length = '00:00:00';
        if(self::$edit_page)
            $video_length = get_option('vidmizer_'.self::$page_id.'_video_length');
        $length = <<< LENGTH
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_length">Video Length</label>
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" name="video_length" id="video_length" value="$video_length" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-hourglass"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
LENGTH;
        echo $length;        
    }
    public static function content_trigger_time() {
        $content_trigger_time = '00:00:00';
        if(self::$edit_page)
            $content_trigger_time = get_option('vidmizer_'.self::$page_id.'_content_trigger_time');
        $content = <<< CONTENT
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_trigger_time">Content Trigger Time</label>
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" name="content_trigger_time" id="content_trigger_time" value="$content_trigger_time" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-hourglass"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
CONTENT;
        echo $content;        
    }
    public static function video_title() {
        $video_title = '';
        if(self::$edit_page)
            $video_title = get_option('vidmizer_'.self::$page_id.'_video_title');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_title">Sticky video title</label>
                            <input type="text" name="video_title" id="video_title" value="$video_title" placeholder="Video Title" required>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function video_title_background() {
        $video_title_background = '#fff';
        if(self::$edit_page)
            $video_title_background = get_option('vidmizer_'.self::$page_id.'_video_title_background');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_title_background">Title background</label>
                            <input type="text" class="spectrum_color_picker" name="video_title_background" id="video_title_background" value="$video_title_background">
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function video_title_color() {
        $video_title_color = '#000';
        if(self::$edit_page)
            $video_title_color = get_option('vidmizer_'.self::$page_id.'_video_title_color');
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_title_color">Title color</label>
                            <input type="text" class="spectrum_color_picker" name="video_title_color" id="video_title_color" value="$video_title_color" required>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function video_title_font_family() {
        $video_title_font_family = 'Arial';
        if(self::$edit_page)
            $video_title_font_family = get_option('vidmizer_'.self::$page_id.'_video_title_font_family');
        if($video_title_font_family == 'Arial')
            $options = '<option value="Arial" selected>Arial</option>';
        else
            $options = '<option value="Arial">Arial</option>';
        if($video_title_font_family == 'Helvetica')
            $options .= '<option value="Helvetica" selected>Helvetica</option>';
        else
            $options .= '<option value="Helvetica">Helvetica</option>';
        if($video_title_font_family == 'Times New Roman')
            $options .= '<option value="Times New Roman" selected>Times New Roman</option>';
        else
            $options .= '<option value="Times New Roman">Times New Roman</option>';
        if($video_title_font_family == 'Times')
            $options .= '<option value="Times" selected>Times</option>';
        else
            $options .= '<option value="Times">Times</option>';
        if($video_title_font_family == 'Courier New')
            $options .= '<option value="Courier New" selected>Courier New</option>';
        else
            $options .= '<option value="Courier New">Courier New</option>';
        if($video_title_font_family == 'Courier')
            $options .= '<option value="Courier" selected>Courier</option>';
        else
            $options .= '<option value="Courier">Courier</option>';
        if($video_title_font_family == 'Verdana')
            $options .= '<option value="Verdana" selected>Verdana</option>';
        else
            $options .= '<option value="Verdana">Verdana</option>';
        if($video_title_font_family == 'Georgia')
            $options .= '<option value="Georgia" selected>Georgia</option>';
        else
            $options .= '<option value="Georgia">Georgia</option>';
        if($video_title_font_family == 'Arial Black')
            $options .= '<option value="Arial Black" selected>Arial Black</option>';
        else
            $options .= '<option value="Arial Black">Arial Black</option>';
        $title = <<< TITLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_title_font_family">Title font type</label>
                            <select name="video_title_font_family" id="video_title_font_family" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
TITLE;
        echo $title;
    }
    public static function video_title_font_size() {
        $video_title_font_size = 21;
        if(self::$edit_page)
            $video_title_font_size = get_option('vidmizer_'.self::$page_id.'_video_title_font_size');
        $width = <<< WIDTH
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_title_font_size">Title font size</label>
                            <input type="number" name="video_title_font_size" id="video_title_font_size" value="$video_title_font_size" required> px
                        </div>
                    </div>
                </div>
            </div>
WIDTH;
        echo $width;
    }
    public static function timer_style() {
        $timer_style = 'flip_clock';
        if(self::$edit_page)
            $timer_style = get_option('vidmizer_'.self::$page_id.'_timer_style');
        if($timer_style == 'flip_clock')
            $options = '<option value="flip_clock" selected>Flip - Timer</option>';
        else
            $options = '<option value="flip_clock">Flip - Timer</option>';
        if($timer_style == 'box_clock')
            $options .= '<option value="box_clock" selected>Box - Timer</option>';
        else
            $options .= '<option value="box_clock">Box - Timer</option>';
        if($timer_style == 'simple_clock')
            $options .= '<option value="simple_clock" selected>Simple - Timer</option>';
        else
            $options .= '<option value="simple_clock">Simple - Timer</option>';
        if($timer_style == 'digital_clock')
            $options .= '<option value="digital_clock" selected>Digital - TImer</option>';
        else
            $options .= '<option value="digital_clock">Digital - Timer</option>';

        $timer = <<< TIMER
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_style">Timer Style</label>
                            <select name="timer_style" id="timer_style" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
TIMER;
        echo $timer;        
    }
    public static function timer_type() {
        $timer_type = 'cookie';
        if(self::$edit_page)
            $timer_type = get_option('vidmizer_'.self::$page_id.'_timer_type');
        if($timer_type == 'cookie')
            $options = '<option value="cookie" selected>Cookie - Timer</option>';
        else
            $options = '<option value="cookie">Cookie - Timer</option>';
        if($timer_type == 'evergreen')
            $options .= '<option value="evergreen" selected>Evergreen - Timer</option>';
        else
            $options .= '<option value="evergreen">Evergreen - Timer</option>';

        $timer = <<< TIMER
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_type">Timer Type</label>
                            <select name="timer_type" id="timer_type" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
TIMER;
        echo $timer;        
    }
    public static function timer_hour() {
        $timer_hour = 0;
        if(self::$edit_page)
            $timer_hour = get_option('vidmizer_'.self::$page_id.'_timer_hour');
        $hour = <<< HOUR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_hour">Timer hour</label>
                            <select name="timer_hour" id="timer_hour" required>
HOUR;
        $i = 0;
        while($i < 24) {
            if($timer_hour == $i)
                $hour .= '<option value='.$i.' selected>'.$i++.'</option>';
            else
                $hour .= '<option value='.$i.'>'.$i++.'</option>';
        }
        $hour .= <<< HOUR
                            </select>
                        </div>
                    </div>
                </div>
            </div>
HOUR;
        echo $hour;
    }
    public static function timer_minute() {
        $timer_minute = 0;
        if(self::$edit_page)
            $timer_minute = get_option('vidmizer_'.self::$page_id.'_timer_minute');
        $hour = <<< HOUR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_minute">Timer minute</label>
                            <select name="timer_minute" id="timer_minute" required>
HOUR;
        $i = 0;
        while($i < 60) {
            if($timer_minute == $i)
                $hour .= '<option value='.$i.' selected>'.$i++.'</option>';
            else
                $hour .= '<option value='.$i.'>'.$i++.'</option>';
        }
        $hour .= <<< HOUR
                            </select>
                        </div>
                    </div>
                </div>
            </div>
HOUR;
        echo $hour;
    }
    public static function timer_second() {
        $timer_second = 0;
        if(self::$edit_page)
            $timer_second = get_option('vidmizer_'.self::$page_id.'_timer_second');
        $hour = <<< HOUR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_second">Timer second</label>
                            <select name="timer_second" id="timer_second" required>
HOUR;
        $i = 0;
        while($i < 60) {
            if($timer_second == $i)
                $hour .= '<option value='.$i.' selected>'.$i++.'</option>';
            else
                $hour .= '<option value='.$i.'>'.$i++.'</option>';
        }
        $hour .= <<< HOUR
                            </select>
                        </div>
                    </div>
                </div>
            </div>
HOUR;
        echo $hour;
    }
    public static function timer_color() {
        $timer_color = '#000';
        if(self::$edit_page)
            $timer_color = get_option('vidmizer_'.self::$page_id.'_timer_color');
        $color = <<< COLOR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_color">Timer color</label>
                            <input type="text" class="spectrum_color_picker" name="timer_color" id="timer_color" value="$timer_color" required>
                        </div>
                    </div>
                </div>
            </div>
COLOR;
        echo $color;
    }
    public static function timer_trigger_time() {
        $timer_trigger_time = '00:00:00';
        if(self::$edit_page)
            $timer_trigger_time = get_option('vidmizer_'.self::$page_id.'_timer_trigger_time');
        $timer = <<< TIMER
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_trigger_time">Timer Trigger Time</label>
                            <div class="input-group date" id="datetimepicker3">
                                <input type="text" name="timer_trigger_time" id="timer_trigger_time" value="$timer_trigger_time" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-hourglass"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
TIMER;
        echo $timer;        
    }
    public static function button_width() {
        $button_width = 80;
        if(self::$edit_page)
            $button_width = get_option('vidmizer_'.self::$page_id.'_button_width');
        $width = <<< WIDTH
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_width">Button width</label>
                            <input type="number" name="button_width" id="button_width" value="$button_width" required> px
                        </div>
                    </div>
                </div>
            </div>
WIDTH;
        echo $width;
    }
    public static function button_height() {
        $button_height = 42;
        if(self::$edit_page)
            $button_height = get_option('vidmizer_'.self::$page_id.'_button_height');
        $height = <<< HEIGHT
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_height">Button height</label>
                            <input type="number" name="button_height" id="button_height" value="$button_height" required> px
                        </div>
                    </div>
                </div>
            </div>
HEIGHT;
        echo $height;
    }
    public static function button_color() {
        $button_color = '#FF6347';
        if(self::$edit_page)
            $button_color = get_option('vidmizer_'.self::$page_id.'_button_color');
        $color = <<< COLOR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_color">Button color</label>
                            <input type="text" class="spectrum_color_picker" name="button_color" id="button_color" value="$button_color" required>
                        </div>
                    </div>
                </div>
            </div>
COLOR;
        echo $color;
    }
    public static function button_text() {
        $button_text = 'Click!';
        if(self::$edit_page)
            $button_text = get_option('vidmizer_'.self::$page_id.'_button_text');
        $text = <<< TEXT
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_text">Button text</label>
                            <input type="text" name="button_text" id="button_text" value="$button_text" required>
                        </div>
                    </div>
                </div>
            </div>
TEXT;
        echo $text;
    }
    public static function button_link() {
        $button_link = '#';
        if(self::$edit_page)
            $button_link = get_option('vidmizer_'.self::$page_id.'_button_link');
        $link = <<< LINK
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_link">Button link</label>
                            <input type="text" name="button_link" id="button_link" value="$button_link" required>
                        </div>
                    </div>
                </div>
            </div>
LINK;
        echo $link;
    }
    public static function button_text_color() {
        $button_text_color = '#fff';
        if(self::$edit_page)
            $button_text_color = get_option('vidmizer_'.self::$page_id.'_button_text_color');
        $color = <<< COLOR
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_text_color">Button text color</label>
                            <input type="text" class="spectrum_color_picker" name="button_text_color" id="button_text_color" value="$button_text_color" required>
                        </div>
                    </div>
                </div>
            </div>
COLOR;
        echo $color;
    }
    public static function button_text_size() {
        $button_text_size = 17;
        if(self::$edit_page)
            $button_text_size = get_option('vidmizer_'.self::$page_id.'_button_text_size');
        $size = <<< SIZE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_text_size">Button text size</label>
                            <input type="number" name="button_text_size" id="button_text_size" value="$button_text_size" required> px
                        </div>
                    </div>
                </div>
            </div>
SIZE;
        echo $size;
    }
    public static function button_window() {
        $button_window = '_blank';
        if(self::$edit_page)
            $button_window = get_option('vidmizer_'.self::$page_id.'_button_window');
        if($button_window == '_blank')
            $options = '<option value="_blank" selected>Open link in new window</option>';
        else
            $options = '<option value="_blank">Open link in new window</option>';
        if($button_window == '_self')
            $options .= '<option value="_self" selected>Open link in same window</option>';
        else
            $options .= '<option value="_self">Open link in same window</option>';
        $window = <<< WINDOW
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_window">Link target</label>
                            <select name="button_window" id="button_window" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
WINDOW;
        echo $window;
    }
    public static function button_enable() {
        $button_enable = 'yes';
        if(self::$edit_page)
            $button_enable = get_option('vidmizer_'.self::$page_id.'_button_enable');
        if($button_enable == 'yes')
            $options = '<option value="yes" selected>Enable button after countdown stops</option>';
        else
            $options = '<option value="yes">Enable button after countdown stops</option>';
        if($button_enable == 'no')
            $options .= '<option value="no" selected>Disable button after countdown stops</option>';
        else
            $options .= '<option value="no">Disable button after countdown stops</option>';
        $enable = <<< ENABLE
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_enable">Enable button</label>
                            <select name="button_enable" id="button_enable" required>
                                $options
                            </select>
                        </div>
                    </div>
                </div>
            </div>
ENABLE;
        echo $enable;
    }
    public static function button_trigger_time() {
        $button_trigger_time = '00:00:00';
        if(self::$edit_page)
            $button_trigger_time = get_option('vidmizer_'.self::$page_id.'_button_trigger_time');
        $button = <<< BUTTON
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_trigger_time">Button Trigger Time</label>
                            <div class="input-group date" id="datetimepicker4">
                                <input type="text" name="button_trigger_time" id="button_trigger_time" value="$button_trigger_time" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-hourglass"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
BUTTON;
        echo $button;        
    }
}
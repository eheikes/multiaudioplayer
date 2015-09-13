<?php
/*
Plugin Name: Multi-Audio Player
Plugin URI: https://github.com/eheikes/multiaudioplayer
Description: Multiple-track audio player.
Author: Eric Heikes
Author URI: http://ericheikes.com/
Version: 1.0.0
License: Apache-2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0
*/

define('SOUNDMANAGER_VERSION', '2.97a.20150601');

class MultiAudioPlayer {
  public static function init() {
    add_shortcode('multiaudio', array(__CLASS__, 'createPlayer'));

    self::registerAssets();
    add_action('wp_enqueue_scripts', array(__CLASS__, 'addScripts'));
    wp_enqueue_style('bar-ui');
    add_action('wp_print_scripts', array(__CLASS__, 'runScripts'));
  }

  public static function addScripts() {
    wp_enqueue_script('multiaudioplayer');
  }

  public static function compileTemplate($templateFile, $data) {
    $addMustaches = function($value) {
      return '{{' . $value . '}}';
    };

    $template = file_get_contents($templateFile);
    $templateTags = array_map($addMustaches, array_keys($data));
    $templateVals = array_values($data);
    return str_replace($templateTags, $templateVals, $template);
  }

  public static function createPlayer($attrs, $content = '') {
    $opts = shortcode_atts(array(
      'bgcolor' => '#2288cc',
      'fullwidth' => true,
      'playlist' => true,
      'text' => 'light', // dark or light
      'texture' => 'transparent', // color or url()
      'theme' => 'standard', // standard or flat
    ), $attrs);

    // Wordpress can't do boolean attributes. >:(
    if (!in_array('fullwidth', $attrs)) { $opts['fullwidth'] = false; }
    if (!in_array('playlist', $attrs)) { $opts['playlist'] = false; }

    // Compile the list of CSS classes for the player.
    $classes = array();
    if ($opts['fullwidth']) { $classes[] = 'full-width'; }
    if ($opts['playlist']) { $classes[] = 'playlist-open'; }
    if ($opts['text'] == 'dark') { $classes[] = 'dark-text'; }
    if ($opts['texture'] != 'transparent') { $classes[] = 'textured'; }
    if ($opts['theme'] == 'flat') { $classes[] = 'flat'; }

    // Wordpress adds </p>...<p> around shortcode content >:(
    $content = preg_replace('/^\\s*<\/p>/', '', $content);
    $content = preg_replace('/<p>\\s*$/', '', $content);

    // Return the player HTML.
    $templateData = array(
      'bgcolor' => $opts['bgcolor'],
      'classes' => join(' ', $classes),
      'content' => $content,
      'texture' => $opts['texture'],
    );
    return self::compileTemplate(__DIR__ . '/player.html', $templateData);
  }

  public static function registerAssets() {
    wp_register_script(
      'soundmanager',
      plugins_url('/js/soundmanager2.js',  __FILE__),
      array('jquery'),
      SOUNDMANAGER_VERSION
    );
    wp_register_script(
      'bar-ui',
      plugins_url('/js/bar-ui.js',  __FILE__),
      array('soundmanager'),
      SOUNDMANAGER_VERSION
    );
    wp_register_style(
      'bar-ui',
      plugins_url('/css/bar-ui.css', __FILE__),
      array(),
      SOUNDMANAGER_VERSION
    );
    wp_register_script(
      'multiaudioplayer',
      plugins_url('/js/multiaudioplayer.js',  __FILE__),
      array('bar-ui'),
      '1.0'
    );
  }

  public static function runScripts() {
    $pluginPath = plugins_url('/', __FILE__);
    echo <<<SETPLUGINPATH
<script type='text/javascript'>
  var multiAudioPlayerPath = '$pluginPath';
</script>
SETPLUGINPATH;
  }
}

add_action('init', array('MultiAudioPlayer', 'init'));

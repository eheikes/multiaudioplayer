# Multi-track audio player for WordPress

Audio player for WordPress, based on the [SoundManager 2](http://www.schillmania.com/projects/soundmanager2/) [Bar UI](http://www.schillmania.com/projects/soundmanager2/demo/bar-ui/).

## Installation

Download the player files and [manually install them](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) into the `wp-content/plugins` folder of your website.

## Usage

Use the `multiaudio` shortcode to embed the player in your page/post. The contents of the shortcode should be a list of audio files.

```html
[multiaudio full-width playlist-open]
<ul>
  <li><a href="http://freshly-ground.com/data/audio/sm2/SonReal%20-%20People%20Asking.mp3"><b>SonReal</b> - People Asking <span class="label">Explicit</span></a></li>
  <li><a href="http://freshly-ground.com/data/audio/sm2/SonReal%20-%20Already%20There%20Remix%20ft.%20Rich%20Kidd%2C%20Saukrates.mp3"><b>SonReal</b> - Already There Remix ft. Rich Kidd, Saukrates <span class="label">Explicit</span></a></li>
</ul>
[/multiaudio]
```

Shortcode options:

* `bg-color` -- background color of the player (e.g. `#2288cc` or `red`)
* `full-width` -- makes the player take the full width of the container
* `playlist-open` -- starts with the playlist open
* `text` -- color of the player's text (`dark` or `light`)
* `texture` -- background texture (color or `url(...)`), defaults to `transparent`
* `theme` -- general appearance of the player (`standard` or `flat`)

# License

Copyright 2015 Eric Heikes.

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at [http://www.apache.org/licenses/LICENSE-2.0](http://www.apache.org/licenses/LICENSE-2.0).

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.

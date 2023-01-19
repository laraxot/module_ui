@php
Theme::add($comp_ns . '/js/plupload.full.min.js');
Theme::add($comp_ns . '/js/moxie.js');
Theme::add($comp_ns . '/js/plupload.dev.js');
Theme::add($comp_ns . '/js/plupload.js');
@endphp

<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
    <a id="pickfiles" href="javascript:;">[Select files]</a>
    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
</div>

<br />
<pre id="console"></pre>

<template>
    <video :id="id" controls preload="none" ref="video-player" class="video-js vjs-big-play-centered">
        <source :src="src" type="video/mp4" />
    </video>
</template>

<script>
/**
 * @link https://www.programmersought.com/article/79514297198/
 * @link https://stackoverflow.com/questions/56345835/videojs-marker-how-can-i-customize-a-special-marker-rather-than-using-general
 * @link https://codepen.io/jnwng/pen/KKMWbq
 */
import videojs from "video.js";
//import "videojs-markers-plugin/dist/videojs-markers-plugin.js";
import 'videojs-markers-plugin';
import $ from "jquery";
import _ from "lodash";
//import 'livewire-vue';

export default {
    name: 'VideoJs',
    props: ["src", "id", "currentTime", "markers"],
    /*
    props: {
    title: String,
    likes: Number
    }
    */
    data() {
        return {
            player: null,
            options: {
                controls: true,
            },
        };
    },
    mounted() {
        //console.log('videojs mounted');
        //console.log('videojs '+Livewire);
        //console.log('videojs '+window.Livewire);
        //console.log('videojs '+window.livewire);
        //document.addEventListener('livewire:load', event => {
        console.log('videojs livewire:load');
        const element = this.$refs['video-player'];
        //console.log(this.markers);
        //var markers= JSON.parse(this.markers);
        //console.log(markers);
        this.player = videojs(element, {
            fluid: true,
            controls: true,
            autoplay: false,
            controlBar: {
                playToggle: true,
                liveDisplay: false,
                pictureInPictureToggle: true,
                muteToggle: false,
                seekToLive: false
            }

        });
        var myPlayer = this.player;
        //console.log(this.markers);
        //load the marker plugin
        if (Array.isArray(this.markers)) {
            myPlayer.markers({
                markerStyle: {
                    'width': '8px',
                    'border-radius': '30%',
                    'background-color': 'yellow'
                },
                markers: this.markers,
                markerTip: {
                    display: true,
                    text: function (marker) {
                        return marker.text + ': ' + marker.time
                    },
                    //time: function(marker) {
                    //return marker.time;
                    //    return null;
                    //}
                },
                onMarkerReached: function (marker) {
                    //console.log("marker reached: " + marker.text )
                },
            });
        }

        myPlayer.ready(function () {
            console.log('myPlayer.ready');
            myPlayer.controlBar.show();
            myPlayer.controlBar.removeClass('vjs-fade-out');

            myPlayer.userActive(true);

            $('.subitem').on('click', function (e) {
                var time = this.getAttribute('data-start');
                myPlayer.currentTime(time);
                console.log('videojs set time ', time);
            });

            anchorator();


        });

        Livewire.on('setNewMark', function () { anchorator() });

        function anchorator(event) {
           $('.subitem')./*removeClass('highlight').*/removeClass('text-white').removeClass('bg-primary').removeClass('fw-bolder');

            // deve farlo anche quando chiami l'url dalle citazioni
            let anchor_id = $(location).attr('hash');

            console.log('anchor id', anchor_id);
            if (anchor_id !== '') {
                anchor_id = anchor_id.substr(1);
                let target = $('[name="' + anchor_id + '"]').next('span')[0];
                let data_start = target.getAttribute('data-start');
                $('[data-start="' + data_start + '"]')./*addClass('highlight').*/addClass('text-white').addClass('bg-primary').addClass('fw-bolder');
                console.log('anchor start time', data_start);
                myPlayer.currentTime(data_start);
                $(target).click();
            }
        }

        Livewire.on('setVideoMarkers', ($markers) => {
            //console.log('---------------setVideoMarkers--------------');
            //console.log($markers);
            if (Array.isArray($markers)) {
                myPlayer.markers.reset($markers);
            }
        });
        /*
        myPlayer.on('playing', function() {
            console.log('playing');
            console.log(this.currentTime());
        });
        */

        myPlayer.on("loadedmetadata", function () {
            //console.log('loadedmetadata');
            //console.log(myPlayer.duration());
            Livewire.emit('setSliderMinMax', 0, myPlayer.duration());

        });
        myPlayer.on('timeupdate', function () {
            console.log('timeupdate');
            var time = this.currentTime();
            Livewire.emit('setVideoCurrentTime', time);
            $('.subitem').each(function () {
                var start = $(this).data('start') * 0.9999;
                var end = $(this).data('end') * 1.0001;
                var find = _.inRange(time, start, end);
                if (find) {
                    $(this).addClass(" highlight text-white bg-primary fw-bolder py-1 px-1 rounded");
                } else {
                    $(this).removeClass(" highlight text-white bg-primary fw-bolder py-1 px-1 rounded");
                }
            });
        });
        //});
    }
};
</script>

<style>
@import 'video.js';
@import 'videojs-markers-plugin/dist/videojs.markers.plugin.css';

/*
    .video-js .vjs-big-play-button {
        display: none;
    }
    */
.video-js .vjs-control-bar {
    display: flex;
}

.vjs-tip {
    font-size: 15px;
}

.vjs-tip .vjs-tip-inner {
    color: black;
    background-color: yellow;
}

.vjs-tip .vjs-tip-arrow {
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAAXNSR0IArs4c6QAAAENJREFUGBmNzlEKACAIA9Dt/oc2DGZLQuqncC8VaCcC0UqgFxyQJyvkQB8FN3oBh5xAwXxMMEf+76S23lFLK7tuhwoWU/Ya/y97IuIAAAAASUVORK5CYII=") bottom left no-repeat;
}

.video-js .vjs-big-play-button {
    background-color: rgba(96, 93, 186, 0.45);
    font-size: 3.5em;
    border-radius: 50%;
    height: 2em !important;
    line-height: 2em !important;
    margin-top: -1em !important;
}

.video-js .vjs-menu-button-inline.vjs-slider-active,
.video-js .vjs-menu-button-inline:focus,
.video-js .vjs-menu-button-inline:hover,
.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 10em
}

.video-js .vjs-controls-disabled .vjs-big-play-button {
    display: none !important
}

.video-js .vjs-control {
    width: 3em
}

.video-js .vjs-menu-button-inline:before {
    width: 1.5em
}

.vjs-menu-button-inline .vjs-menu {
    left: 3em
}

.vjs-paused.vjs-has-started.video-js .vjs-big-play-button,
.video-js.vjs-ended .vjs-big-play-button,
.video-js.vjs-paused .vjs-big-play-button {
    display: block
}

.video-js .vjs-load-progress div,
.vjs-seeking .vjs-big-play-button,
.vjs-waiting .vjs-big-play-button {
    display: none !important
}

.video-js .vjs-mouse-display:after,
.video-js .vjs-play-progress:after {
    padding: 0 .4em .3em !important
}

.video-js.vjs-ended .vjs-loading-spinner {
    display: none;
}

.video-js.vjs-ended .vjs-big-play-button {
    display: block !important;
}

.video-js *,
.video-js:after,
.video-js:before {
    box-sizing: inherit;
    font-size: inherit;
    color: inherit;
    line-height: inherit
}

.video-js.vjs-fullscreen,
.video-js.vjs-fullscreen .vjs-tech {
    width: 100% !important;
    height: 100% !important
}

.video-js {
    font-size: 14px;
    overflow: hidden
}

.video-js .vjs-control {
    color: inherit
}

.video-js .vjs-menu-button-inline:hover,
.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 8.35em
}

.video-js .vjs-volume-menu-button.vjs-volume-menu-button-horizontal:hover .vjs-menu .vjs-menu-content {
    height: 3em;
    width: 6.35em
}

.video-js .vjs-control:focus:before,
.video-js .vjs-control:hover:before {
    text-shadow: 0 0 1em #fff, 0 0 1em #fff, 0 0 1em #fff
}

.video-js .vjs-spacer,
.video-js .vjs-time-control {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-flex: 1 1 auto;
    -moz-box-flex: 1 1 auto;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

.video-js .vjs-time-control {
    -webkit-box-flex: 0 1 auto;
    -moz-box-flex: 0 1 auto;
    -webkit-flex: 0 1 auto;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    width: auto
}

.video-js .vjs-time-control.vjs-time-divider {
    width: 14px
}

.video-js .vjs-time-control.vjs-time-divider div {
    width: 100%;
    text-align: center
}

.video-js .vjs-time-control.vjs-current-time {
    margin-left: 1em
}

.video-js .vjs-time-control .vjs-current-time-display,
.video-js .vjs-time-control .vjs-duration-display {
    width: 100%
}

.video-js .vjs-time-control .vjs-current-time-display {
    text-align: right
}

.video-js .vjs-time-control .vjs-duration-display {
    text-align: left
}

.video-js .vjs-play-progress:before,
.video-js .vjs-progress-control .vjs-play-progress:before,
.video-js .vjs-remaining-time,
.video-js .vjs-volume-level:after,
.video-js .vjs-volume-level:before,
.video-js.vjs-live .vjs-time-control.vjs-current-time,
.video-js.vjs-live .vjs-time-control.vjs-duration,
.video-js.vjs-live .vjs-time-control.vjs-time-divider,
.video-js.vjs-no-flex .vjs-time-control.vjs-remaining-time {
    display: none
}

.video-js.vjs-no-flex .vjs-time-control {
    display: table-cell;
    width: 4em
}

.video-js .vjs-progress-control {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    height: .5em;
    top: -.5em
}

.video-js .vjs-progress-control .vjs-load-progress,
.video-js .vjs-progress-control .vjs-play-progress,
.video-js .vjs-progress-control .vjs-progress-holder {
    height: 100%
}

.video-js .vjs-progress-control .vjs-progress-holder {
    margin: 0
}

.video-js .vjs-progress-control:hover {
    height: 1.5em;
    top: -1.5em
}

.video-js .vjs-control-bar {
    -webkit-transition: -webkit-transform .1s ease 0s;
    -moz-transition: -moz-transform .1s ease 0s;
    -ms-transition: -ms-transform .1s ease 0s;
    -o-transition: -o-transform .1s ease 0s;
    transition: transform .1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-control-bar,
.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-control-bar,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-control-bar,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar,
.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar {
    visibility: visible;
    opacity: 1;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateY(3em);
    -moz-transform: translateY(3em);
    -ms-transform: translateY(3em);
    -o-transform: translateY(3em);
    transform: translateY(3em);
    -webkit-transition: -webkit-transform 1s ease 0s;
    -moz-transition: -moz-transform 1s ease 0s;
    -ms-transition: -ms-transform 1s ease 0s;
    -o-transition: -o-transform 1s ease 0s;
    transition: transform 1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control,
.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control {
    height: .25em;
    top: -.25em;
    pointer-events: none;
    -webkit-transition: height 1s, top 1s;
    -moz-transition: height 1s, top 1s;
    -ms-transition: height 1s, top 1s;
    -o-transition: height 1s, top 1s;
    transition: height 1s, top 1s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active.vjs-fullscreen .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active.vjs-fullscreen .vjs-progress-control,
.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,
.video-js.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control {
    opacity: 0;
    -webkit-transition: opacity 1s ease 1s;
    -moz-transition: opacity 1s ease 1s;
    -ms-transition: opacity 1s ease 1s;
    -o-transition: opacity 1s ease 1s;
    transition: opacity 1s ease 1s
}

.video-js.vjs-live .vjs-live-control {
    margin-left: 1em
}

.video-js .vjs-big-play-button {
    top: 50%;
    left: 50%;
    margin-left: -1em;
    margin-top: -1em;
    width: 2em;
    height: 2em;
    line-height: 2em;
    border: none;
    border-radius: 50%;
    font-size: 3.5em;
    background-color: rgba(0, 0, 0, .45);
    color: #fff;
    -webkit-transition: border-color .4s, outline .4s, background-color .4s;
    -moz-transition: border-color .4s, outline .4s, background-color .4s;
    -ms-transition: border-color .4s, outline .4s, background-color .4s;
    -o-transition: border-color .4s, outline .4s, background-color .4s;
    transition: border-color .4s, outline .4s, background-color .4s
}

.video-js .vjs-menu-button-popup .vjs-menu {
    left: -3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-content {
    background-color: transparent;
    width: 12em;
    left: -1.5em;
    padding-bottom: .5em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item,
.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-title {
    background-color: #151b17;
    margin: .3em 0;
    padding: .5em;
    border-radius: .3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item.vjs-selected {
    background-color: #2483d5
}

.video-js {
    border-radius: 15px;
}

.video-js .vjs-big-play-button {
    background-color: #605dba;
    font-size: 3em;
    border-radius: 50%;
    height: 2em !important;
    line-height: 2em !important;
    margin-top: -1em !important
}

.video-js:hover .vjs-big-play-button,
.video-js .vjs-big-play-button:focus,
.video-js .vjs-big-play-button:active {
    background-color: rgba(96, 93, 186, 0.52)
}

.video-js .vjs-loading-spinner {
    border-color: #6360c2
}

.video-js .vjs-control-bar2 {
    background-color: #000000
}

.video-js .vjs-control-bar {
    background-color: rgba(0, 0, 0, 0.48) !important;
    color: #ffffff;
    font-size: 15px
}

.video-js .vjs-play-progress,
.video-js .vjs-volume-level {
    background-color: #605dba
}
</style>

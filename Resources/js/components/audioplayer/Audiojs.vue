<template>
    <audio :id="id" controls preload="auto" ref="audio-player" class="video-js vjs-big-play-centered">
        <source :src="src" type="audio/mpeg" />
    </audio>
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

export default {
    props: ["src","id","currentTime","markers"],
    /*
    props: {
    title: String,
    likes: Number
    }
    */
    data(){
        return {
            player: null,
            options: {
                controls: true,
            },
        };
    },
    mounted(){
        document.addEventListener('livewire:load',  event => {
        const element=this.$refs['video-player'];
        //console.log(this.markers);
        //var markers= JSON.parse(this.markers);
        //console.log(markers);
        this.player = videojs(element,{
            fluid:true,
            controls: true,
            autoplay: false,
            controlBar: {
                playToggle: true,
                liveDisplay: false,
                pictureInPictureToggle: true,
                muteToggle: true,
                seekToLive: false 
            }
        });

        var myPlayer=this.player;
        //console.log(this.markers);
        //load the marker plugin
        if(Array.isArray(this.markers)){
            myPlayer.markers({
                markerStyle: {
                    'width':'8px',
                    'border-radius': '30%',
                    'background-color': 'yellow'
                },
                markers : this.markers,
                markerTip:{
                    display: true,
                    text: function(marker) {
                        return marker.text + ': ' +marker.time
                    },
                    //time: function(marker) {
                        //return marker.time;
                    //    return null;
                    //}
                },
                onMarkerReached: function(marker) {
                    //console.log("marker reached: " + marker.text )
                },
            });
        }

        myPlayer.ready(function() {
            myPlayer.controlBar.show();
            myPlayer.controlBar.removeClass('vjs-fade-out'); 
            
            myPlayer.userActive(true);

            $('.subitem').on('click', function(e) {
                var time = this.getAttribute('data-start');
                myPlayer.currentTime(time);
            });
        });

        Livewire.on('setVideoMarkers',($markers) =>{
            //console.log('---------------setVideoMarkers--------------');
            //console.log($markers);
            if(Array.isArray($markers)){
                myPlayer.markers.reset($markers);
            }
        });
        /*
        myPlayer.on('playing', function() {
            console.log('playing');
            console.log(this.currentTime());
        });
        */
        
        myPlayer.on("loadedmetadata", function() {
            //console.log('loadedmetadata');
            //console.log(myPlayer.duration());
            Livewire.emit('setSliderMinMax',0,myPlayer.duration());
            
        });
        myPlayer.on('timeupdate', function() {
            //console.log('timeupdate');
            var time = this.currentTime();
            Livewire.emit('setVideoCurrentTime',time);
            $('.subitem').each(function(){
                var start=$(this).data('start')*0.9999;
                var end=$(this).data('end')*1.0001;
                var find = _.inRange(time,start,end);
                if(find){
                    $(this).addClass( "text-decoration-underline highlight text-primary" );
                }else{
                    $(this).removeClass( "text-decoration-underline highlight text-primary" );
                }
            });
        });
        });
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
</style>

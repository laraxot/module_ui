<template>
    <video :id="id" controls preload="auto" ref="video-player" class="video-js vjs-big-play-centered">
        <source :src="src" type="video/mp4" />
    </video>

    <div class="col-md-6 col-xs-12">
            <div class="btn-group" role="group" aria-label="...">
               <button class="dynamic-demo-prev btn btn-default" type="button">Prev</button>
               <button class="dynamic-demo-next btn btn-default" type="button">Next</button>
               <button class="dynamic-demo-add-random btn btn-default" type="button">Add random</button>
               <button class="dynamic-demo-shift btn btn-default" type="button">Shift 1 sec</button>
               <button class="dynamic-demo-remove-first btn btn-default" type="button">Remove 1st</button>
               <button class="dynamic-demo-remove-all btn btn-default" type="button">Remove all</button>
               <button class="dynamic-demo-destroy btn btn-default" type="button">Destroy</button>
            </div>
            <hr>
            <ul class="dynamic-demo-events list-group">
              <li class="list-group-item"><b>Marker events:</b></li>

           <li class="list-group-item">Marker reached: 9.5</li><li class="list-group-item">Marker reached: 16</li></ul>
         </div>
</template>

<script>
import videojs from "video.js";
import $ from "jquery";
import _ from "lodash";

export default {
    props: ["src","id"],
    data(){
        return {
            player: null,
            options: {
                controls: true,
            },
        };
    },
    mounted(){

        const element=this.$refs['video-player'];

        this.player = videojs(element,{
            fluid:true,
        });
        var myPlayer=this.player;
        myPlayer.ready(function() {
            $('.subitem').on('click', function(e) {
                var time = this.getAttribute('data-start');
                myPlayer.currentTime(time);
            });
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
                var start=$(this).data('start')*0.998;
                var end=$(this).data('end')*1.002;
                var find = _.inRange(time,start,end);
                if(find){
                    $(this).addClass( "text-decoration-underline highlight text-primary" );
                }else{
                    $(this).removeClass( "text-decoration-underline highlight text-primary" );
                }
            });
        });

        //markers
        // http://sampingchuang.com/videojs-markers
        myPlayer.markers({
            breakOverlay:{
                display: true
            },
            onMarkerClick: function(marker){
                $('.dynamic-demo-events').append('<li class="list-group-item">Marker click: '+marker.time+'</li>');
            },
            onMarkerReached: function(marker){
                $('.dynamic-demo-events').append('<li class="list-group-item">Marker reached: '+marker.time+'</li>');
            },
            markers: [
                {time: 9.5, text: "this", overlayText: "1"},
                {time: 16,  text: "is", overlayText: "2"},
                {time: 23.6,text: "so", overlayText: "3"},
                {time: 28,  text: "cool", overlayText: "4"}
            ]
        });

        // setup control handlers
        $(".dynamic-demo-prev").click(function(){
            myPlayer.markers.prev();
        });
        $(".dynamic-demo-next").click(function(){
            myPlayer.markers.next();
        });
        $(".dynamic-demo-add-random").click(function(){
            var randomTime = Math.floor((Math.random() * parseInt(player.duration())) + 1);

            // come up with a random time
            myPlayer.markers.add([{
                time: randomTime,
                text: "I'm new",
                overlayText: "I'm new"
            }]);
        });
        $(".dynamic-demo-shift"). click(function(){
        var markers = myPlayer.markers.getMarkers();
        for(var i = 0; i < markers.length; i++) {
            markers[i].time += 1;
        }
        myPlayer.markers.updateTime();
        });
        $(".dynamic-demo-remove-first").click(function(){
        myPlayer.markers.remove([0]);
        });
        $(".dynamic-demo-remove-all").click(function(){
        myPlayer.markers.removeAll();
        });
        $(".dynamic-demo-destroy").click(function(){
        myPlayer.markers.destroy();
        });

    }
};
</script>

<style>
    @import 'video.js';
</style>

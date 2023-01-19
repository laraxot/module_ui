<template>
    <video :id="id" controls preload="auto" ref="video-player" class="video-js vjs-big-play-centered">
        <source :src="src" type="video/mp4" />
    </video>

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
        myPlayer.on('timeupdate', function() {
            //console.log('timeupdate');
            var time = this.currentTime();
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

    }
};
</script>

<style>
    @import 'video.js';
</style>

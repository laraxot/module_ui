<template>
    <{{ $row->type }}-js controls preload="auto" ref="video-player" class="video-js vjs-big-play-centered">
        <source :src="src" type="video/mp4" />
    </{{ $row->type }}-js>

</template>

<script>
import videojs from "video.js";

export default {
    props: ["src"],
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
    }
};
</script>

<style>
    @import 'video.js';
</style>

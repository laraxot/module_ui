<template>
    <div>
        <div :id="id" ref="slider" class=""></div>
        <span>
            AAAAAAAAAAAAAAAAAAAAAAAAAA
        </span>
    </div>
</template>

<script>
import noUiSlider from "nouislider";
import $ from "jquery";
import _ from "lodash";

export default {
    props: ["id"],
    data() {
        return {
            slider: null,
            options: {
                controls: true,
            },
        };
    },
    mounted() {
        const range = this.$refs['slider'];
        console.log('slider');
        console.log(this.options);
        this.slider = noUiSlider.create(range, {
            range: {
                'min': 0,
                'max': 100
            },
            // Display colored bars between handles
            connect: true,

        });


    }
};
</script>

<style>

</style>

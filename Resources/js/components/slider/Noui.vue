<template>
    <div>
        <div :id="id" ref="slider" class=""></div>
        <span>
        </span>
    </div>
</template>

<script>
import noUiSlider from "nouislider";
import $ from "jquery";
import _ from "lodash";
//import 'livewire-vue';


export default {
    name: 'Noui',
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
        //console.log('noui mounted');
        //console.log(Livewire);
        //console.log(window.Livewire);
        //console.log(window.livewire);
        const range = this.$refs['slider'];
        //console.log('slider');
        //console.log(this.options);
        this.slider = noUiSlider.create(range, {
            start: [0, 1000],
            connect: true,
            tooltips: true,
            range: {
                'min': 0,
                'max': 1000
            }

        });
        

        //document.addEventListener('livewire:load',  event => {
            //console.log('noui livewire:load');
            //console.log(Livewire);
            this.slider.on('change', function(values, handle) {
                //@this.updateValues(values);
                //console.log(values);
                Livewire.emit('updateSliderValues',values);
            });

            Livewire.on('setSliderMinMax',(from,to) =>{
                console.log('nouivue - setSliderMinMax ['+from+' ; '+to +']');
                //console.log(from+ ': '+to);
                this.slider.updateOptions({
                    range: {
                        'min': from,
                        'max': to
                    }
                });
            });

            Livewire.on('setSliderValues',(from,to) =>{
                //console.log('nouivue - setSliderValues ['+from+' ; '+to +']');
                this.slider.updateOptions({
                    start: [from,to]
                });
            });


            /*
            window.addEventListener('setSliderMinMax', event => {
                console.log('aaaa');
                range.noUiSlider.updateOptions({
                    range: {
                        'min': event.detail.min,
                        'max': event.detail.max
                    }
                });
            });

            window.addEventListener('setSliderValues', event => {
                console.log('bbb');
                range.noUiSlider.updateOptions({
                    start: event.detail.values,
                });
            });
            */
        //});
        


    }
};
</script>

<style>
   @import "nouislider/dist/nouislider.css";

   .noUi-connect {
    background: #605dba;
}

.noUi-tooltip {
    display: none;
}

.noUi-target {
    background: #f2f2f2;
    border-radius: 50px;
    border: none;
    box-shadow: none;
}

.noUi-handle:before, .noUi-handle:after {
    content: "";
    display: none;
}

.noUi-horizontal .noUi-handle {
    width: 25px;
    height: 25px;
    right: -17px;
    top: -4px;
}

.noUi-handle {
    border: 1px solid #f2f2f2;
    border-radius: 65px;
    background: #FFF;
    cursor: default;
    box-shadow: 0 3px 6px -3px #BBB;
}


</style>

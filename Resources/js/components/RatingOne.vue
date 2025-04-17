<template>
	<div class="text-center mt-12">
        <h4>{{ this.title }}</h4>
        <v-rating
            v-model="rating"
            background-color="orange lighten-3"
            color="purple"
            empty-icon="far fa-star fa-2x"
            full-icon="fas fa-star fa-2x"
            half-icon="fas fa-star-half-alt fa-2x"
            half-increments
            hover
            @click.native="ratingSave()"

            ></v-rating>

    <span class="font-weight-bold">
        <input type="hidden" :name="name" :value="rating">
      </span>
    </div>
</template>
<script>
	export default {
	    name: 'rating-one',
	    props: ['name','value','title'],
	    data: () => ({
            rating:null,
        }),
        computed: {
            rating1(){
                return parseFloat(this.value);
            }
        },
        mounted(){
            this.rating=parseFloat(this.value);
        },
        methods: {
            ratingSave: function () {
               //alert('preso'+ this.rating);
            },
        }

	   }
</script>

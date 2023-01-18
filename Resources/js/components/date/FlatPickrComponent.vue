<template>
  <input />
</template>

<script>
import "flatpickr";

import "flatpickr/dist/l10n/it.js";


export default {
    mounted: function(){
        $(this.$el).datepicker();
    }
}
</script>

<style>

</style>
<template>
    <div id="app">
     <editor
       api-key="no-api-key"
       :init="{
         height: 500,
         menubar: true,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
     />
   <input id="content" type="hidden" :name="inputname" v-model="content" />
   </div>
 </template>

<script>

 import Editor from '@tinymce/tinymce-vue'

 export default {
   props: ["inputvalue", "inputname"],
   name: 'app',
   components: {
     'editor': Editor
   },
   data() {
    return {
     content: this.inputvalue
    }
   },
    mounted() {
        //console.log('Component mounted.');

    }
 }

 //tinymce.activeEditor.setContent(content);
 </script>

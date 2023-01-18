<template>
  <div class="editor">
    <editor v-model="editorValue" :init="init"></editor>
  </div>
</template>
<script>
import tinymce from "tinymce/tinymce";
import "tinymce/skins/ui/oxide/skin.min.css";
import "tinymce/themes/silver";
import "tinymce/icons/default/icons";
import "tinymce/plugins/image";
//import "tinymce/plugins/axupimgs/plugin.js";
import Editor from "@tinymce/tinymce-vue";
export default {
  components: {
    Editor
  },
  props: {
    value: {
      type: String,
      default: ""
    },
    baseUrl: {
      type: String,
      default: ""
    },
    disabled: {
      type: Boolean,
      default: false
    },
    plugins: {
      type: [String, Array],
      default: "image axupimgs"
    },
    toolbar: {
      type: [String, Array],
      default:
        " bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify|bullist numlist |outdent indent blockquote | undo redo | axupimgs | removeformat"
    }
  },
  data() {
    return {
      init: {
        language_url: "/tinymce/langs/zh_CN.js",
        language: "zh_CN",
        height: 500,
        menubar: false,
        skin: "oxide",
        plugins: this.plugins,
        toolbar: this.toolbar,
        branding: false,
        images_upload_url: "/demo/upimg.php",
        images_upload_base_path: "",
        images_upload_handler: (blobInfo, succFun) => {
          var formData;
          var file = blobInfo.blob();
          formData = new FormData();
          formData.append("pic", file, file.name);
          this.$api.upload(formData).then(res => {
            succFun(res.url);
          });
        }
      },
      editorValue: this.value
    };
  },
  mounted() {
    tinymce.init({});
  },
  watch: {
    value(newValue) {
      this.editorValue = newValue;
    },
    editorValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  methods: {}
};
</script>

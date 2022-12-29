<template>
  <div>
    <Editor
      :tools="tools"
      :content-style="{
        height: '690px',
      }"
      :default-content="content"
    />
  </div>
</template>

<script>
/**
 * @link https://www.telerik.com/kendo-vue-ui/components/editor/
 */

import { Editor } from "@progress/kendo-vue-editor";

export default {
  components: {
    Editor,
  },
  data() {
    return {
      tools: [
        ["Bold", "Italic", "Underline", "Strikethrough"],
        ["Subscript", "Superscript"],
        ["AlignLeft", "AlignCenter", "AlignRight", "AlignJustify"],
        ["Indent", "Outdent"],
        ["OrderedList", "UnorderedList"],
        "FontSize",
        "FontName",
         "FormatBlock",
        ["Undo", "Redo"],
        ["Link", "Unlink", "InsertImage", "ViewHtml"],
        ["InsertTable"],
        ["AddRowBefore", "AddRowAfter", "AddColumnBefore", "AddColumnAfter"],
        ["DeleteRow", "DeleteColumn", "DeleteTable"],
        ["MergeCells", "SplitCell"],
      ],
      content: content,
    };
  },
};
</script>

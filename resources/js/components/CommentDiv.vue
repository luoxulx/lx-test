<template>
  <div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
      <form>
        <div class="form-group" id="markdown-editor">
          <textarea :value="textarea" @input="update" class="form-control" rows="3"></textarea>
          <!--<div v-html="compiledMarkdown"></div>-->
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
  import 'marked'
  export default {
    name: "CommentDiv",
    components: {},
    data() {
      return {
        textarea: '# test'
      }
    },
    // computed: {
    //   compiledMarkdown: function () {
    //     return marked(this.textarea, { sanitize: true })
    //   }
    // },
    methods: {
      update() {
        _.debounce(function (e) {
          this.textarea = e.target.value
        }, 300)
      }
    }
  }
</script>

<style scoped>

  html, body, #markdown-editor {
    height: 100%;
    font-family: 'Helvetica Neue', Arial, sans-serif;
    color: #333;
  }

  textarea, #markdown-editor div {
    display: inline-block;
    width: 100%;
    height: 100%;
    vertical-align: top;
    box-sizing: border-box;
    padding: 0 20px;
  }

  textarea {
    border: none;
    border-right: 1px solid #ccc;
    resize: none;
    outline: none;
    background-color: #fffff5;
    font-size: 14px;
    font-family: 'Monaco', courier, monospace;
    padding: 20px;
  }

  code {
    color: #f66;
  }
</style>
